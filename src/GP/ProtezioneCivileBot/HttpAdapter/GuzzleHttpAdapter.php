<?php

/**
 * This file is part of the ProtezioneCivileBot package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license MIT License
 */

namespace GP\ProtezioneCivileBot\HttpAdapter;

use GuzzleHttp\Client;
use \Exception;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Psr\Log\LoggerInterface;

/**
 * @author Giovanni Pirrotta <giovanni.pirrotta@gmail.com>
 */
class GuzzleHttpAdapter implements HttpAdapterInterface
{
    private $client;
    private $contents;
    private $logger;

    public function __construct(LoggerInterface $logger = null)
    {
        $this->client = new Client();

        if (null === $logger) {
            $this->logger = new Logger("GuzzleHttpAdapter");
            $this->logger->pushHandler(new StreamHandler(__DIR__.'/../../../../prot-civ.log', Logger::DEBUG));
        } else {
            $this->logger = $logger;
        }
    }
    
    public function getContents($url)
    {
        try {
            $response = $this->client->get($url);
            $this->contents =  $response->getBody()->getContents();
        }
        catch (Exception $e) {
            $this->contents = "";
            $this->logger->error("Problem in Http Client with URI:".$url." - ".$e->getMessage());
        }

        return $this->contents;
    }
}

