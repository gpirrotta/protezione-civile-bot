<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\Command;

use Telegram\Bot\Commands\Command;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class StartCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "start";

    /**
     * @var string Command Description
     */
    protected $description = "ProtezioneCivile PA Palermo Menu";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $keyboard = [
            ['❔ Informazioni']
        ];

        $reply_markup = $this->telegram->replyKeyboardMarkup($keyboard, true, true);

        $text = "Per conoscere l'area di accoglienza della Protezione Civile più vicina a te clicca sulla graffetta (📎) e invia la tua posizione";
        $this->replyWithMessage($text, false, null, $reply_markup);

    }
}