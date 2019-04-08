<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use DB;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id=Auth::id();
        $users = Chat::select('chats.*','U.name')
            ->from(DB::raw('(SELECT MAX(id) AS id
                             FROM chats
                             WHERE user_to_id = '. $user_id .' OR user_from_id = '. $user_id .' GROUP BY conversation_id) as tmp'))
            ->join('chats', 'tmp.id', '=', 'chats.id')
            ->join('users as U', function() {})
            ->whereRaw(
                '(
                    CASE 
                         WHEN chats.user_from_id = ' . auth()->user()->id . ' THEN chats.user_to_id ELSE chats.user_from_id
                    END
                ) = U.id'
            )
            ->orderBy('created_at','desc')
            ->paginate(5);

        return view('chat.inbox',compact('users','user_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'user_from_id' => 'required',
            'user_to_id' => 'required',
            'chat' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json(false, 403);
        }

        $chat = new Chat;
        $chat->user_from_id = $request->user_from_id;
        $chat->user_to_id = $request->user_to_id;
        $chat->chat = $request->chat;
        $chat->seen = 1;
        $chat->conversation_id = $request->user_to_id + $request->user_from_id;
        $chat->save();
        return response()->json(true, 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function show(Chat $chat,$id)
    {   
        $user = User::find($id);
        $name=$user->name;
        $self=Auth::id();
        $friend_id=$id;
        $messages = Chat::where(function($query) use ($id){
            $query->where('user_to_id','=', Auth::id())->where('user_from_id', '=',$id);
        })->orWhere(function ($query) use ($id){
            $query->where('user_to_id','=', $id)->where('user_from_id', '=',Auth::id());
        })->orderBy('created_at');

        $messagess=$messages->get();
        $update=$messages->where('user_to_id',$self)->update(array('seen' => 0));
    
        return view('chat.dialog',compact('messagess','self','friend_id','name'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function edit(Chat $chat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Chat $chat)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Chat  $chat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Chat $chat)
    {
        //
    }
}
