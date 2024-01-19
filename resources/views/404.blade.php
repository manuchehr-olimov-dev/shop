@extends('layouts.app')

@section('content')
    <main class="md:min-h-screen md:flex md:items-center md:justify-center py-16 lg:py-20">
        <div class="container">

            <h1 class="text-2xl font-black text-center">Ошибка 404</h1>
            <h2 class="max-w-[720px] mx-auto mt-4 text-body text-center">
                {{ $message }}
            </h2>

            <div class="mt-8 text-center">
                <a href="{{ route('home') }}}" class="btn btn-pink" rel="home">Вернутся на главную</a>
            </div>

        </div>
    </main>
@endsection
