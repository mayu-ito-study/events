@extends('layouts.app')

@section('content')

    <div class="text-center">
    <h1 class="font-weight-bold mt-5">Events</h1>
    <p>暮らしに役立つ地域のお役立ち情報共有サイト</p>
    <!--ここにソート用のタブが入る-->
    
    {!! Form::open(['route' => 'events.index', 'name' => 'event-search-form', 'method' => 'get']) !!}
    <ul class="d-flex justify-content-center flex-wrap">
        <li class="nav-item nav-link dropdown">タグで絞り込む
            {!! Form::select('tag', [0 => '全て'] + $tagArray, request('tag'), ['class' => 'form-control']) !!}
        </li>
        <li class="nav-item nav-link">開催日で絞り込む
            <div class="d-flex">
                {!! Form::date('date_from', request('date_from'), ['class' => 'form-control']) !!}
                <p class="my-auto">　〜　</p>
                {!! Form::date('date_to', request('date_to'), ['class' => 'form-control']) !!}
            </div>
        </li>
        <li class="nav-item nav-link">
             {!! Form::submit('検索', ['class' => 'btn btn-primary mt-4']) !!}
        </li>
    </ul>
    {!! Form::close() !!}
    
    <hr>
        <div class="d-flex justify-content-between flex-wrap mb-5">
            @include('events.events')
        </div>

@endsection