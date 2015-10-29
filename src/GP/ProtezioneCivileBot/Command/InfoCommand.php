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
class InfoCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = "❔";

    /**
     * @var string Command Description
     */
    protected $description = "Informazioni BOT";

    /**
     * @inheritdoc
     */
    public function handle($arguments)
    {

        $text = <<<BOT
Protezione Civile Palermo BOT (Beta)

Trova l'area di accoglienza più vicina a te

Dati OpenData CC BY 4.0 IT
Fonte: http://umap.openstreetmap.fr/it/map/mappa-piano-protezione-civile-palermo-2014_16328#12/38.1190/13.3422

Ideato da Ciro Spataro (@cirospat)
Sviluppato da Giovanni Pirrotta (@gpirrotta)

App non ufficiale, si declina ogni tipo di responsabilità
BOT;

        $this->replyWithMessage($text);
        $this->triggerCommand('start');
   }
}