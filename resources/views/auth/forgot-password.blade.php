@extends('layouts/auth')

@section('title', 'Забыли пароль пароль')

@section('content')
    <x-forms.auth-form
        title="Забыли пароль"
        action="{{ route('password.email') }}"
        method="POST"
    >
        @csrf

        <x-forms.text-input
            name="email"
            :isError="$errors->has('email')"
            type="email"
            placeholder="E-mail"
            required
        />

        @error('email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror



        <x-forms.primary-button> Отправить пароль </x-forms.primary-button>

        <x-slot:socialAuth > </x-slot:socialAuth>

        <x-slot:buttons>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('login') }}" class="text-white hover:text-white/70 font-bold">Войти в аккаунт</a></div>
            </div>
            <div class="space-y-3 mt-5">
                <div class="text-xxs md:text-xs"><a href="{{ route('signUp') }}" class="text-white hover:text-white/70 font-bold">Зарегестрироваться</a></div>
            </div>
        </x-slot:buttons>
    </x-forms.auth-form>
@endsection
