@props(['dir'])
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{$dir ? 'rtl' : 'ltr'}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{env('APP_NAME')}} Travel Agency</title>

    @php
        $user = auth()->user();
    @endphp

    @if ($user && $user->user_type === 'admin')
        @include('Admin.dashboard._head')
    @elseif ($user && $user->user_type === 'user')
        @include('User.dashboard._head')
    @endif
</head>
<body>
    @if ($user && $user->user_type === 'admin')
        @include('Admin.dashboard._body')
    @elseif ($user && $user->user_type === 'user')
        @include('User.dashboard._body')
    @endif
</body>


</html>
