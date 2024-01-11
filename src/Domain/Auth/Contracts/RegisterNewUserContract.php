<?php

namespace Domain\Auth\Contracts;

use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Http\RedirectResponse;

interface RegisterNewUserContract
{
    public function __invoke(NewUserDTO $data);
}
