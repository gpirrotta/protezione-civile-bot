<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Distance;

use GP\ProtezioneCivileBot\Model\Vertex;
/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
interface DistanceInterface
{
    public function distance(Vertex $from, Vertex $to);
}

