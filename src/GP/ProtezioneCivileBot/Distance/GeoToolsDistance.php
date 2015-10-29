<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Distance;

use League\Geotools\Geotools;
use League\Geotools\Coordinate\Coordinate;
use GP\ProtezioneCivileBot\Model\Vertex;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class GeoToolsDistance implements DistanceInterface
{
    public function __construct()
    {
        $this->geotools = new Geotools();
    }
    
    public function distance(Vertex $from, Vertex $to)
    {
        $coordFrom = new Coordinate([$from->getLatitude(), $from->getLongitude()]);
        $coordTo = new Coordinate([$to->getLatitude(), $to->getLongitude()]);
        $distanceCalculator = $this->geotools->distance()->setFrom($coordFrom)->setTo($coordTo);

        return $distanceCalculator->in('km')->haversine();
    }
} 