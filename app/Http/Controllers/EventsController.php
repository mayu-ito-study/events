<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

use App\Event;    // 追加

use App\Tag;    // 追加

use App\User;    // 追加

class EventsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでevents/にアクセスされた場合の「一覧表示処理」
    public function index(Request $request)
    {
        // イベント一覧を取得降順で表示
        //$events = Event::orderBy('id', 'desc')->paginate(15);
        $events = Event::query();
        $tags = Tag::all();
        $tagArray = Tag::all()->pluck('name', 'id')->toArray();
        
        // 検索
        
        // tagが選択されていたら
        if ($request->filled('tag') && $request->input('tag') !== '0') {
            $events->whereHas('tags', function (Builder $query) use ($request){
                $query->where('event_tag.tag_id', $request->input('tag'));
            });
        }
        
        // 日付が選択されていたら
        if ($request->filled('date_to','date_from')) {
            //dd($request->input('date'));
            $events->whereBetween('date', [$request->input('date_to'), $request->input('date_from')])->get();
            // $events->whereDate('date', '=', $request->input('date_to'));
            // dd($events->whereDate('date_to', '=', $request->input('date'))->toSql());
        }else {
            $now = now()->format('Y-m-d H:i:s');
            $events->whereDate('date', '>=', $now);
        }
        
        //$events->orderBy('id', 'desc')->paginate(15);

        // イベント一覧ビューでそれを表示
        return view('events.index', [
            'events' => $events->orderBy('id', 'desc')->paginate(15),
            'tags' => $tags,
            'tagArray' => $tagArray,
        ]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     // getでevents/にアクセスされた場合の「一覧表示処理」
    public function user_events($id)
    {
        // イベント一覧を取得降順で表示
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // idの値でユーザーを検索して取得
            $user = User::findOrFail($id);
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $events = $user->events()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'events' => $events,
            ];
        }

        // Welcomeビューでそれらを表示
        return view('users.user_events', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event = new Event;
        $tags = Tag::all();
         
        // 新規投稿ビューを表示
        return view('events.create', [
            'event' => $event,
            'tags' => $tags,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $this->validate($request, [
            'image' => 'required|image',
            'title' => 'required',
            'content' =>'required',
            'date' => 'required',
            'place' => 'required'
            ]);

        $image = $request->file('image');

        /**
         * 自動生成されたファイル名が付与されてS3に保存される。
         * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
         */
        $path = \Storage::disk('s3')->putFile('myprefix', $image, 'public');
        //dd($path);
        /* 上記と同じ */
        // $path = $image->store('myprefix', 's3');

        /* 名前を付与してS3に保存する */
        // $filename = 'hoge.jpg';
        // $path = Storage::disk('s3')->putFileAs('myprefix', $image, $filename, 'public');

        /* ファイルパスから参照するURLを生成する */
        // $url = \Storage::disk('s3')->url($path);
        // dd($url);
        
        //dd($request->input('tags'));
        // メッセージを作成
        $event = new Event;
        $event->user_id = \Auth::id();
        $event->title = $request->title;
        $event->content = $request->content;
        $event->image = $path;
        $event->date = $request->date;
        $event->place = $request->place;
        $event->save();
        

        $event->tags()->sync($request->input('tags'));
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     // getでevents/idにアクセスされた場合の「取得表示処理」
    public function show($id)
    {
        // idの値でイベントを検索して取得
        $event = Event::findOrFail($id);

        // メッセージ詳細ビューでそれを表示
        return view('events.show', [
            'event' => $event,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // idの値で投稿を検索して取得
        $event = Event::findOrFail($id);
        $tags = Tag::all();
        
        // 自分の投稿の場合編集画面へ
        if (\Auth::id() === $event->user_id ) {
        return view('events.edit', [
            'event' => $event,
            'tags' => $tags,
        ]);
            
        } else {
            // 自分以外の投稿の場合はトップへリダイレクト
            return redirect('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required',
            'content' =>'required',
            'date' => 'required',
            'place' => 'required'
            ]);
          
        if($request->image !== null) {
            $event = \App\Event::findOrFail($id);
            if ($event->image !== $request->image) {
                $disc = \Storage::disk('s3')->delete($event->image);
            }
            $image = $request->file('image');
            /**
             * 自動生成されたファイル名が付与されてS3に保存される。
             * 第三引数に'public'を付与しないと外部からアクセスできないので注意。
             */
            $path = \Storage::disk('s3')->putFile('myprefix', $image, 'public');
        }    

        // idの値でメッセージを検索して取得
        $event = Event::findOrFail($id);
        // 投稿を更新
        $event->user_id = \Auth::id();
        $event->title = $request->title;
        $event->content = $request->content;
        if($request->image !== null) {
            $event->image = $path;
        }
        $event->date = $request->date;
        $event->place = $request->place;
        $event->save();

        $event->tags()->sync($request->input('tags'));
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // idの値で投稿を検索して取得
        $event = \App\Event::findOrFail($id);

        // 認証済みユーザ（閲覧者）がその投稿の所有者である場合は、投稿を削除
        if (\Auth::id() === $event->user_id) {
            $event->delete();
            $disc = \Storage::disk('s3')->delete($event->image);
        }

        // 前のURLへリダイレクトさせる
        return redirect('/');
    }
}
