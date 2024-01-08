<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ForgotPassworFormdRequest;
use App\Http\Requests\SignUpRequest;
use Domain\Auth\Actions\RegisterNewUserAction;
use Domain\Auth\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{
    public function page(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application|RedirectResponse
    {
        return view('auth.forgot-password');
    }

    public function handle(ForgotPassworFormdRequest $request): RedirectResponse
    {

        $status = Password::sendResetLink(
            $request->only('email')
        );

        if($status === Password::RESET_LINK_SENT){
            flash()->info(__($status));
            return back();
        }

        return  back()->withErrors(['email' => __($status)]);

    }

}
