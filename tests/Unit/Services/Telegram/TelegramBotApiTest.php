<?php

namespace Services\Telegram;

use Illuminate\Support\Facades\Http;
use Tests\TestCase;


class TelegramBotApiTest extends TestCase
{
    public function test_send_message_success(): void
    {
        Http::fake([
            TelegramBotApi::getHost() . "*" => Http::response(['ok' => true])
        ]);

        $result = TelegramBotApi::sendMessage('', 1, 'msg');

        $this->assertTrue($result);
    }
}
