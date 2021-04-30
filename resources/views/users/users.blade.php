@if (count($users) > 0)
    <ul class="list-unstyled">
        @foreach ($users as $user)
            <li class="media">
                <div class="media-body d-inline-block mb-3">
                    {{-- ユーザ詳細ページへのリンク --}}
                    <p class="d-inline-block mr-5">{!! link_to_route('users.user_events', $user->name, ['id' => $user->id]) !!}</p>
                    {{-- フォロー／アンフォローボタン --}}
                    <div class="d-inline-block">@include('user_follow.follow_button')</div>
                </div>
            </li>
        @endforeach
    </ul>
    </ul>
    {{-- ページネーションのリンク --}}
    {{ $users->links() }}
@endif