
@auth
    @if (Auth::user()->is_favorite($event->id))
        {{-- お気に入り解除ボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.unfavorite', $event->id], 'method' => 'delete']) !!}
            {!! Form::submit('お気に入り解除', ['class' => "btn text-white", 'style' => "background-color: #e57373;"]) !!}
        {!! Form::close() !!}
    @else
        {{-- お気に入りボタンのフォーム --}}
        {!! Form::open(['route' => ['favorites.favorite', $event->id]]) !!}
            {!! Form::submit('お気に入り', ['class' => "btn text-white", 'style' => "background-color: #4db5ab;"]) !!}
        {!! Form::close() !!}
    @endif
@endauth
