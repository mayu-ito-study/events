@extends('layouts.app')

@section('content')
{{ Auth::user()->name }}
<hr>
<div class="text-center">
    <h1>フォロー一覧</h1>
</div>
<div class="d-flex justify-content-between flex-wrap mb-5">
    @include('users.users')
</div>
@endsection
