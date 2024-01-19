<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\SignUpController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Notification;
use Tests\TestCase;

class AuthControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_store_success(): void
    {
        Notification::fake();
        Event::fake();

        $request = [
            'name' => "nqwdqwld",
            'email' => "info123@gmail.com",
            'password' => '12345678',
            'password_confirmation' => '12345678'
        ];

        $response = $this->post(
            action([SignUpController::class, 'handle']),
            $request
        );

        $response
            ->assertValid()
            ->assertRedirect(route('home'));
    }
}
