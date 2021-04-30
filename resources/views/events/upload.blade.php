<h2>S3アップロードテスト</h1>

{!! Form::open(['url' => '/upload', 'method' => 'post', 'class' => 'form', 'files' => true]) !!}

<div class="form-group">
{!! Form::label('myfile', 'Upload a file') !!}
{!! Form::file('myfile', null) !!}
</div>

<div class="form-group">
{!! Form::submit('Upload') !!}
</div>

{!! Form::close() !!}

@if (session('s3url'))
    <h1>いまアップロードしたファイル</h1>
    <img src="{{ session('s3url') }}">
@endif
