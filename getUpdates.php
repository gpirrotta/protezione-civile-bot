<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */

//Show all errors
error_reporting(E_ALL);
ini_set('display_errors', '1');

$config = require __DIR__ . '/config/protezione-civile-config-blank.php';

date_default_timezone_set($config['timezone']);
$token = $config['token'];
$geoJSONFilename = $config['geoJSONFilename'];


require 'vendor/autoload.php';

use GP\ProtezioneCivileBot\ProtezioneCivileBot;

$protezioneCivileBot = new ProtezioneCivileBot($token, $geoJSONFilename);
// If use webook
// $protezioneCivileBot->withWebHook();

$protezioneCivileBot->run();





