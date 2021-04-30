@extends('layouts.app')

@section('content')
{{-- $user->name --}}
    @if ($user->name === Auth::user())
        {{ Auth::user()->name }}
    @else
        <div class="d-inline-block mr-5">
        {{ $user->name }}
        </div>
        <div class="d-inline-block">
        {{-- フォロー／アンフォローボタン --}}
        @include('user_follow.follow_button')
        </div>
    @endif
<hr>
    <div class="text-center">
        <h1>投稿一覧</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap mb-5">
        @include('events.events')
    </div>
@endsection