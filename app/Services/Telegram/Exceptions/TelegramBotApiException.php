<?php

namespace App\Services\Telegram\Exceptions;


use Illuminate\Http\Client\Request;

class TelegramBotApiException extends \Exception
{
    public function render()
    {
        return response()->json([
            'Hello' => 'World'
        ]);
    }
}
