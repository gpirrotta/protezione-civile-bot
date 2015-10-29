<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Model;

use League\Geotools\Geotools;
use League\Geotools\Coordinate\Coordinate;

use GP\ProtezioneCivileBot\Distance\DistanceInterface;
use GP\ProtezioneCivileBot\Distance\GeoToolsDistance;


/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class Vertex 
{
    private $latitude;
    private $longitude;
    private $distance = null;
    private $distanceCalculator = null;

    public function __construct($latitude, $longitude, DistanceInterface $distanceCalculator = null)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;

        $this->distanceCalculator = (null === $distanceCalculator) ? new GeoToolsDistance() : $distanceCalculator;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function distanceFrom(Vertex $vertex)
    {
        $this->distance =  $this->distanceCalculator->distance($vertex, $this);

        return $this->distance;
    }


    /**
     * @return null
     */
    public function getDistance()
    {
        return $this->distance;
    }
}