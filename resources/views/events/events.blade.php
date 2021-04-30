

@if ($events->count() > 0)
    @foreach ($events as $event)
        <div class="card mt-5" style="width: 21.6rem;">
            <div>
                <img src="https://mayu-ito-events.s3.ap-northeast-1.amazonaws.com/{{ $event->image }}" class="card-img-top" style="object-fit: contain;" alt="{{ $event->title }}">
            </div>
            <div class="card-body">
                <!--ここにタグが入る-->
               {{-- @dd($event->tags) --}}    
                @foreach ($event->tags as $tag)
                    <p class="d-inline-block px-2 rounded-pill" style="background-color:{{ $tag->color }}; color:#fff; font-size:12px;">{{ $tag->name }}</p>
                @endforeach

                
                <p>{!! link_to_route('events.show', $event->title, ['event' => $event->id], ['class' => 'card-title font-weight-bold']) !!}</p>
                開催日：{{ $event->date }}
                @auth
                <div class="text-center">
                   <!--お気に入りと修正ボタン-->
                    <div class="d-flex justify-content-center mt-5">
                        @include('user_favorite.favorite_button')
                        @if($event->user->id === Auth::user()->id)
                            {!! link_to_route('events.edit', '修正', ['event' => $event->id], ['class' => 'btn btn-light ml-3']) !!}
                        @endif
                    </div>
                </div>
                @endauth
            </div>
        </div>
    @endforeach
@endif