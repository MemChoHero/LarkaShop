<?php

namespace App\Services\Telegram;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;

final class TelegramBotApi
{
    private const HOST = 'https://api.telegram.org/bot';

    /**
     * @throws ConnectionException
     */
    public static function sendMessage(string $token, int $chat_id, string $text): void
    {
        Http::get(self::HOST . $token . '/sendMessage', [
            'chat_id' => $chat_id,
            'text' => $text,
        ]);
    }
}
