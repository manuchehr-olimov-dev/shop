<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\SignInFormRequest;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;

class SignInController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        return view('auth.index');
    }


    public function handle(SignInFormRequest $request): RedirectResponse
    {
        if (!Auth::attempt($request->validated())) {
            return back()->withErrors([
                'email' => 'The provided credentials do not match our records.',
            ]);
        }
        flash()->info("Вы успешно вошли в аккаунт.");

        $request->session()
            ->regenerate();

        return redirect()
            ->intended(route('home'));
    }

    public function logout(): RedirectResponse
    {
        auth()->logout();

        flash()->info("Вы успешно вышли с аккаунта.");

        request()->session()->invalidate();

        request()->session()->regenerateToken();

        return redirect()->route('home');
    }

}
