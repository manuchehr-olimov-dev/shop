<?php

namespace Domain\Auth\DTOs;


use App\Http\Requests\SignUpRequest;
use Illuminate\Support\Facades\Request;

class NewUserDTO
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password
    ) {

    }

    public static function fromRequest(SignUpRequest $request): NewUserDTO
    {
        return new self(
            $request->get('name'),
            $request->get('email'),
            $request->get('password')
        );
    }

}
