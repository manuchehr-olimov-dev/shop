<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignUpRequest;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\DTOs\NewUserDTO;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;

class SignUpController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        return view('auth.sign-up');
    }


    public function handle(SignUpRequest $request, RegisterNewUserAction $action): RedirectResponse
    {
        $action(NewUserDTO::fromRequest($request));

        return redirect()
            ->intended(route('home'));
    }

}
