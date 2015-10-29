<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Command;

use GP\ProtezioneCivileBot\Model\Map;
use GP\ProtezioneCivileBot\Model\Vertex;
use Telegram\Bot\Actions;
use GP\ProtezioneCivileBot\Builder\AreePiuVicineMessageBuilder;

use Telegram\Bot\Commands\Command;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class AreePiuVicineCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "";

    /**
     * @var string Command Description
     */
    protected $description = "Visualizza le aree di accoglienza più vicina alla tua posizione";

    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
    }

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {
        $parts = explode(" ", trim($arguments));
        $latitude = trim($parts[0]);
        $longitude = trim($parts[1]);

        $this->replyWithChatAction(Actions::TYPING);

        $builder = new AreePiuVicineMessageBuilder($latitude, $longitude, $this->filename);
        $message = $builder->build();

        $this->replyWithMessage($message->getMessageNearestArea());
        $this->replyWithLocation($message->getLatitude(), $message->getLongitude());
        $this->replyWithMessage($message->getMessageGoogleRouteLink());
        $this->triggerCommand('start');
    }

}