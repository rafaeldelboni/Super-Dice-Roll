# Telegram Bot: Super Dice Roll 
Super simple Telegram Bot for rolling dices using the new feature [InlineQuery](https://core.telegram.org/bots/api#inlinequery)
[Working version](https://telegram.me/superdiceroll_bot)

### Requirements

To use this project you need to install [Composer](https://getcomposer.org/)

### Installation

1. Install dependencies via Composer

    Navigate to the project folder and execute the following command:
    ```
    php composer.phar install
    ```
    Or if composer is installed as Global:
    ```
    composer install
    ```

2. Follow the [php-telegram-bot instructions](https://github.com/akalongman/php-telegram-bot#instructions)

3. Change the following variables (sethook.php and webhook.php):
    ```
    $API_KEY = '123456789:your_bot_api_key';
    $BOT_NAME = 'name_bot';
    $link = 'https://your.domain.com/SuperDiceRoll/webhook.php';
    ```

4. Execute the sethook.php and you are done :)

### Plugins
Super Dice Roll is currently extended with the following plugins:

- [akalongman/php-telegram-bot](https://github.com/akalongman/php-telegram-bot)

### Credits
Icon by [delapouite.com](http://delapouite.com)
Dice images by [Wikimedia](https://www.wikimedia.org/)

## License

Please see the [LICENSE](https://github.com/RafaelDelboni/Super-Dice-Roll/blob/master/LICENSE.md) included in this repository for a full copy of the MIT license, which this project is licensed under.