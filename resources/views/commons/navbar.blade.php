        <header class="mb-4">
            <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
                {{-- トップページへのリンク --}}
                <a class="navbar-brand" href="/">Events</a>
                
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#nav-bar">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="nav-bar">
                    <ul class="navbar-nav mr-auto"></ul>
                    <ul class="navbar-nav">
                        @if (Auth::check())
                             <li class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}</a>
                                <ul class="dropdown-menu dropdown-menu-right">
                                    {{-- ユーザ詳細ページへのリンク --}}
                                    <li class="dropdown-item">{!! link_to_route('users.user_events', '投稿一覧', ['id' => Auth::id()]) !!}</li>
                                    <li class="dropdown-item">{!! link_to_route('users.favorites', 'お気に入り一覧', ['id' => Auth::id()]) !!}</li>
                                    {{-- フォロー一覧ページへのリンク --}}
                                    <li class="dropdown-item">{!! link_to_route('users.followings', 'フォロー一覧', ['id' => Auth::id()]) !!}</li>
                                    <li class="dropdown-item">{!! link_to_route('events.create', '新規投稿', []) !!}</li>
                                    <li class="dropdown-divider"></li>
                                    {{-- ログアウトへのリンク --}}
                                    <li class="dropdown-item">{!! link_to_route('logout.get', 'ログアウト') !!}</li>
                                </ul>
                            </li>
                        @else
                            {{-- ログインページへのリンク --}}
                            {!! link_to_route('login', 'ログイン', [], ['class' => 'nav-link']) !!}
                            {{-- ユーザ登録ページへのリンク --}}
                            {!! link_to_route('signup.get', '新規ユーザー登録', [], ['class' => 'nav-link btn btn-primary ml-5']) !!}
                        @endif
                    </ul>
                </div>
            </nav>
        </header>