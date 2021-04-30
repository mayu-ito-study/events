@extends('layouts.app')

@section('content')
    @if ($user->name === Auth::user())
        {{ Auth::user()->name }}
    @else
        {{ $user->name }}
        {{-- フォロー／アンフォローボタン --}}
        @include('user_follow.follow_button')
    @endif
    <hr>
    <div class="text-center">
        <h1>投稿一覧</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap mb-5">
        @include('events.events')
    </div>
@endsection