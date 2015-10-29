<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Model;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class Map
{
    private $aree;

    public function __construct()
    {
        $this->aree = [];
    }

    public function addArea(Area $area)
    {
        $this->aree[] = $area;
    }

    public function loadFromGeoJSONFilename($filename)
    {
        $json = file_get_contents($filename);

        $json = json_decode($json);

        foreach($json->features as $feature) {

            $properties = $feature->properties;
            $area = new Area();

            if (property_exists($properties, 'name')) {
                $area->setName($properties->name);
            }

            if (property_exists($properties, 'description')) {
                $area->setDescription($properties->description);
            }

            foreach($feature->geometry->coordinates as $polygon) {
                foreach($polygon as $point) {
                    $area->addVertex(new Vertex($point[1], $point[0]));
                }
            }
            $this->addArea($area);
            unset($area);
        }
    }

    public function getNearestArea(Vertex $vertex)
    {
        $areaNearest = null;
        $distanceNearest = PHP_INT_MAX;
        foreach($this->aree as $areaAccoglienza) {
            $areaAccoglienza->calculateVertexNearest($vertex);
            $v = $areaAccoglienza->getVertexNearest();
            if ($v->getDistance() < $distanceNearest) {
                $distanceNearest = $v->getDistance();
                $areaNearest = $areaAccoglienza;
            }
        }

        return $areaNearest;
    }
}

