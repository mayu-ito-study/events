@extends('layouts.app')

@section('content')
{{ Auth::user()->name }}
<hr>
    <div class="text-center">
        <h1>お気に入り一覧</h1>
    </div>
    <div class="d-flex justify-content-between flex-wrap mb-5">
        @include('events.events')
    </div>
@endsection
