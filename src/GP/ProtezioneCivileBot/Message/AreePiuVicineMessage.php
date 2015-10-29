<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Message;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class AreePiuVicineMessage
{
    private $googleRouteLink = "";
    private $name = "";
    private $distance = "";
    private $duration = "";

    private $latitude = 0;
    private $longitude = 0;



    public function getMessageNearestArea()
    {
        $message = "L'area di accoglienza più vicina a te è ".$this->name." a ".$this->distance. " km.";

        if ("" != $this->getDuration()) {
            $message.= "\nCirca " . $this->duration . " a piedi per raggiungerla";
        }

        return $message;
    }

    public function getMessageGoogleRouteLink()
    {
        return "Clicca sul link per vedere il percorso\n" . $this->googleRouteLink;
    }


    /**
     * @param string $distance
     */
    public function setDistance($distance)
    {
        $this->distance = $distance;
    }

    /**
     * @return string
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param string $googleRouteLink
     */
    public function setGoogleRouteLink($googleRouteLink)
    {
        $this->googleRouteLink = $googleRouteLink;
    }

    /**
     * @return string
     */
    public function getGoogleRouteLink()
    {
        return $this->googleRouteLink;
    }

    /**
     * @param int $latitude
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;
    }

    /**
     * @return int
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param int $longitude
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;
    }

    /**
     * @return int
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $duration
     */
    public function setDuration($duration)
    {
        $this->duration = $duration;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

   
} 