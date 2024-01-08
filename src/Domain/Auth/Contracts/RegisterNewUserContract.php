<?php

namespace Domain\Auth\Contracts;

use Illuminate\Http\RedirectResponse;

interface RegisterNewUserContract
{
    public function __invoke(array $data);
}
