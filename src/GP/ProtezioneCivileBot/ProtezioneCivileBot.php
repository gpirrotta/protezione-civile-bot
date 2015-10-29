<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot;

use Telegram\Bot\Api;

use GP\ProtezioneCivileBot\Command\StartCommand;
use GP\ProtezioneCivileBot\Command\AreePiuVicineCommand;
use GP\ProtezioneCivileBot\Command\InfoCommand;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class ProtezioneCivileBot
{
    private $telegram;
    private $webHook = false;
    private $jsonFilename;

    public function __construct($token, $jsonFilename)
    {
        $this->telegram = new Api($token);
        $this->jsonFilename = $jsonFilename;

        $this->init();
    }

    private function init()
    {
        $this->telegram->addCommand(new StartCommand());
        $this->telegram->addCommand(new AreePiuVicineCommand($this->jsonFilename));
        $this->telegram->addCommand(new InfoCommand());
    }

    public function withWebHook()
    {
        $this->webHook = true;
    }

    public function run()
    {
        try {
            $this->telegram->commandsHandler($this->webHook);
        }
        catch(\Exception $e) {
            // to implement Logger
            print $e->getMessage();
        }
       }

    public function webHookUp($getUpdatesHttpsURL)
    {
        try {
            $this->telegram->setWebhook($getUpdatesHttpsURL);
        }
        catch(\Exception $e) {
            // to implement Logger
            print $e->getMessage();
        }
    }

    public function webHookDown()
    {
        try {
            $this->telegram->removeWebhook();
        }
        catch(\Exception $e) {
            // to implement Logger
            print $e->getMessage();
        }
    }
}