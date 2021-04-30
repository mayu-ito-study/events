@extends('layouts.app')

@section('content')
{{ Auth::user()->name }}
<hr>
    <div class="text-center">
        <h1>投稿修正</h1>
    </div>
    
    <div class="row">
        <div class="col-sm-6 offset-sm-3">
            {!! Form::model($event, ['route' => ['events.update', $event->id], 'method' => 'put', 'files' => true]) !!}
                <div class="form-group">
                    <div class="mx-auto" style="max-width: 343px; max-height: 230px;">
                        <img src="https://mayu-ito-events.s3.ap-northeast-1.amazonaws.com/{{ $event->image }}" class="card-img-top" style="object-fit: contain;" alt="{{ $event->title }}">
                    </div>
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
                                {!! Form::checkbox('tags[]', $tag->id, $event->tag, ['class' => 'form-check-input', 'id' => $tag->id]) !!}
                                {!! Form::label($tag->id, $tag->name, ['class' => 'mr-4']) !!}
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="text-center">
                <!--更新ボタン-->
                {!! Form::submit('更新', ['class' => 'btn btn-primary m-5']) !!}
                </div>
            {!! Form::close() !!}
            <!--削除ボタン-->
            <div class="text-center mb-5">
                {!! Form::model($event, ['route' => ['events.destroy', $event->id], 'method' => 'delete']) !!}
                    {!! Form::submit('投稿を削除する', ['class' => "btn text-white", 'style' => "background-color: #e57373;"]) !!}
                {!! Form::close() !!}
            </div>
         </div>
    </div>
@endsection