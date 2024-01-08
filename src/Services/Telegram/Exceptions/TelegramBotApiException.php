<?php

namespace Services\Telegram\Exceptions;


class TelegramBotApiException extends \Exception
{
    public function render()
    {
        return response()->json([
            'Hello' => 'World'
        ]);
    }
}
