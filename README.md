Protezione Civile Telegram BOT
=========
**NOT FOR PRODUCTION**

Installation
------------

Clone the github repo in your machine

``` bash
$ git clone https://github.com/gpirrotta/protezione-civile-bot.git
$ cd protezione-civile-bot
```

And run these two commands to install it:

``` bash
$ wget http://getcomposer.org/composer.phar
$ php composer.phar install
```

Now you can add the autoloader, and you will have access to the library:

``` php
<?php

require 'vendor/autoload.php';
```

You're done.

## Usage
Set and rename the **protezione-civile-config-blank.php** file you find in the config directory.

Se

``` php
<?php

    use GP\ProtezioneCivileBot\ProtezioneCivileBot;

    $config = require __DIR__ . '/config/protezione-civile-config.php';

    $token = $config['token'];
    $geoJSONFilename = $config['geoJSONFilename'];

    $protezioneCivileBot = new ProtezioneCivileBot($token, $geoJSONFilename);

    // If you use WebHook invoke the following method
    $protezioneCivileBot->withWebHook();

    $protezioneCivileBot->run();
```

## Requirements

- >= PHP 5.5

## Detail
* [Blog](http://giovanni.pirrotta.it/blog/2015/10/09/stazione-amat-di-palermo-ce-un-telegram-per-te/) (Italian)

## Demo

* [@ProtezioneCivilePABot] (https://telegram.me/ProtezioneCivilePABot)

## TODO

* Add Tests :-( *Sorry, I know they must be written before the code, TDD dixit*

## Credits

* Giovanni Pirrotta <giovanni.pirrotta@gmail.com>

## License

protezione-civile-bot package is released under the MIT License. See the bundled LICENSE file for
details.



