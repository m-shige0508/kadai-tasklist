<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //タスク一覧を取得
           $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザの投稿も取得するように変更しますが、現時点ではこのユーザの投稿のみ取得します）
            $tasks = $user->tasks()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'tasks' => $tasks,
            ];
        }
        
   
        

      
        //タスク一覧ビューでそれを表示
        
         return view('tasklist.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tasks = new Task;
    
        return view('tasklist.create',[
            'tasklist2' => $tasks,
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
                // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:255',
        ]);
        
        
                // タスクを作成
        $tasks = new Task;
        $tasks->status = $request->status;
        $tasks->content = $request->content;
        $tasks->user_id = auth()->id();
        
         
        $tasks->save();
        
        


        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
                // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        if (\Auth::user()->id != $tasks->user_id) {
            return redirect('/');
        }

        // タスク詳細ビューでそれを表示
        return view('tasklist.show', [
            'tasklist3' => $tasks,
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
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
     
        // タスク編集ビューでそれを表示
        return view('tasklist.edit', [
            'tasklist4' => $tasks,
        ]);
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
                
                // バリデーション
        $request->validate([
            'status' => 'required|max:10',   // 追加
            'content' => 'required|max:255',
        ]);

        
        // idの値でタスクを検索して取得
        $tasks = Task::findOrFail($id);
        // タスクを更新
        $tasks->status = $request->status;    // 追加
        $tasks->content = $request->content;
        $tasks->user_id = $request->user_id;
        
                
        
        $tasks->save();

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
                // idの値でメッセージを検索して取得
        $tasks = Task::findOrFail($id);
        // メッセージを削除
        $tasks->delete();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
}
