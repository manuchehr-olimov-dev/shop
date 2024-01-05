@extends('layouts/auth')

@section('title', 'Сброс пароля')

@section('content')

    @dump(request())
    <x-forms.auth-form
        title="Сброс пароля"
        action="{{ route('password.update') }}"
        method="POST"
    >
        @csrf
        <input type="hidden" name = "token" value="{{$token}}">

        <x-forms.text-input
            name="email"
            :isError="$errors->has('email')"
            type="email"
            placeholder="E-mail"
            value="{{request('email')}}"
            required
        />

        @error('email')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password"
            :isError="$errors->has('password')"
            type="password"
            placeholder="Password"
            required
        />

        @error('password')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.text-input
            name="password_confirmation"
            :isError="$errors->has('password_confirmation')"
            type="password"
            placeholder="Confirm Password"
            required
        />

        @error('password_confirmation')
        <x-forms.error>
            {{ $message }}
        </x-forms.error>
        @enderror

        <x-forms.primary-button> Установить новый пароль </x-forms.primary-button>

        <x-slot:socialAuth></x-slot:socialAuth>
        <x-slot:buttons></x-slot:buttons>

    </x-forms.auth-form>

@endsection
