@extends('layouts.app')

@section('content')

<div class="mx-auto mt-5" style="max-width: 600px;">
    <div class="mb-5">
        <img src="https://mayu-ito-events.s3-ap-northeast-1.amazonaws.com/{{ $event->image }}" class="img-fluid" alt="{{ $event->title }}">
    </div>
    <!--タグ-->
    @foreach ($event->tags as $tag)
        <p class="d-inline-block px-2 rounded-pill" style="background-color:{{ $tag->color }}; color:#fff; font-size:12px;">{{ $tag->name }}</p>
    @endforeach
    <p class="font-weight-bold">開催日：{{ $event->date->format('Y年m月d日') }}</p>
    <p class="font-weight-bold">{{ $event->title }}</p>
    <hr>
    <p>{{ $event->content }}</p>
    <p>場所：{{ $event->place }}</p>
    <p>投稿者：{!! link_to_route('users.user_events', $event->user->name, ['id' => $event->user->id]) !!}</p>
    <p>投稿日：{{ $event->created_at->format('Y年m月d日') }}</p>
   <!--お気に入りと修正ボタン-->
   @auth
    <div class="d-flex justify-content-center my-5">
        @include('user_favorite.favorite_button')
        @if($event->user->id === Auth::user()->id)
            {!! link_to_route('events.edit', '修正', ['event' => $event->id], ['class' => 'btn btn-light ml-3']) !!}
        @endif
    </div>
    @endauth
</div>
@endsection