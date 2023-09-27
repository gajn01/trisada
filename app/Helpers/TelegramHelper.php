<?php

namespace App\Helpers;

use GuzzleHttp\Client;

class TelegramHelper
{
    public static function sendMessage($message,$key,$chatid)
    {
        $client = new Client();
        $client->get('https://api.telegram.org/bot'.$key.'/sendMessage?chat_id='.$chatid.'&text='.$message);
    }
}