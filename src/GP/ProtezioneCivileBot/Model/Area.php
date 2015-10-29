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
class Area
{
    private $vertices = [];
    private $name = "";
    private $description = "";
    private $vertexNearest;
    private $minDistance = 0;

    public function addVertex(Vertex $vertex)
    {
        $this->vertices[] = $vertex;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }


    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param array $vertices
     */
    public function setVertices($vertices)
    {
        $this->vertices = $vertices;
    }

    /**
     * @return array
     */
    public function getVertices()
    {
        return $this->vertices;
    }

    public function calculateVertexNearest(Vertex $position)
    {
        $minDistance = PHP_INT_MAX;
        $vertexNearest = null;
        foreach($this->vertices as $vertex) {
            $distance = $vertex->distanceFrom($position);

            if ($distance < $minDistance) {
                $minDistance = $distance;
                $this->minDistance = $minDistance;
                $this->vertexNearest = $vertex;
            }
        }
    }

    public function getNearestDistance()
    {
        return round($this->minDistance, 2);
        //return round($this->vertexNearest->getDistance(), 2);

    }

    public function getVertexNearest()
    {
        return $this->vertexNearest;
    }
}