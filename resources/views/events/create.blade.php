@extends('layouts.app')

@section('content')
{{ Auth::user()->name }}
<hr>
    <div class="text-center">
        <h1>新規投稿</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::open(['route' => 'events.store', 'method' => 'post', 'files' => true]) !!}
                <div class="form-group">
                    {!! Form::label('image', '画像ファイル') !!}
                    {!! Form::file('image', ['class' => 'form-control-file']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('title', 'タイトル') !!}
                    {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('content', '本文') !!}
                    {!! Form::textarea('content', old('content'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('date', '開催日') !!}
                    {!! Form::date('date', old('date'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('place', '場所') !!}
                    {!! Form::text('place', old('place'), ['class' => 'form-control']) !!}
                </div>
                
                <div class="form-group">
                    <p>タグ</p>
                    <div class="pl-4">
                        @foreach ($tags as $tag)
                            <div class="d-inline-block">
                                {!! Form::checkbox('tags[]', $tag->id, false, ['class' => 'form-check-input', 'id' => $tag->id]) !!}
                                {!! Form::label($tag->id, $tag->name, ['class' => 'mr-4']) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                {!! Form::submit('投稿', ['class' => 'btn btn-primary m-5']) !!}
                </div>
            {!! Form::close() !!}
         </div>
    </div>
@endsection