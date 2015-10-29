<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Builder;

use GP\ProtezioneCivileBot\HttpAdapter\GuzzleHttpAdapter;
use GP\ProtezioneCivileBot\Message\AreePiuVicineMessage;
use GP\ProtezioneCivileBot\Model\Map;
use GP\ProtezioneCivileBot\Model\Vertex;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class AreePiuVicineMessageBuilder
{
    private $latitude;
    private $longitude;
    private $jsonFilename;
    private $httpClient;

    public function __construct($latitude, $longitude, $jsonFilename, HttpAdapterInterface $httpClient = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->jsonFilename = $jsonFilename;

        $this->httpClient = (null === $httpClient) ? new GuzzleHttpAdapter() : $httpClient;
    }

    public function build()
    {
        $message = new AreePiuVicineMessage();

        $map = new Map();
        $map->loadFromGeoJSONFilename($this->jsonFilename);
        $area = $map->getNearestArea(new Vertex($this->latitude, $this->longitude));

        $name = $area->getName();
        $message->setName($name);

        $distance = $area->getNearestDistance();
        $message->setDistance($distance);

        $vertexNearest = $area->getVertexNearest();

        $message->setLatitude($vertexNearest->getLatitude());
        $message->setLongitude($vertexNearest->getLongitude());

        $url = sprintf("https://maps.googleapis.com/maps/api/distancematrix/json?origins=%s,%s&destinations=%s,%s&mode=walking&language=it-IT", $this->latitude,$this->longitude,$vertexNearest->getLatitude(),$vertexNearest->getLongitude());

        $data = $this->httpClient->getContents($url);

        //$response = file_get_contents($url);;
        $response_a = json_decode($data, true);
        $duration = $this->extractDuration($data);

        $message->setDuration($duration);

        $googleRouteLink = sprintf("http://maps.google.com/maps?f=d&hl=en&saddr=%s,%s&daddr=%s,%s&ie=UTF8&0&om=0&output=kml",$this->latitude,$this->longitude,$vertexNearest->getLatitude(),$vertexNearest->getLongitude());
        $message->setGoogleRouteLink($googleRouteLink);

        return $message;
    }

    private function extractDuration($data)
    {
        $duration = "";
        $json = json_decode($data);

        if ((property_exists($json, 'rows')) and
            (is_array($json->rows)) and
            (property_exists($json->rows[0],'elements')) and
            (is_array($json->rows[0]->elements)) and
            (property_exists($json->rows[0]->elements[0], 'duration')) and
            (property_exists($json->rows[0]->elements[0]->duration, 'text'))) {

            $duration = $json->rows[0]->elements[0]->duration->text;
        }

        return $duration;
    }

}