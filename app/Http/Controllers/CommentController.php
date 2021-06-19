<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Comment::orderBy('item_id', 'DESC')->get();
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
        $newComment = new Comment;
        $newComment->content = $request->Comment["content"];
        $newComment->item_id = $request->Comment["item_id"];
        $newComment->save();

        return $newComment;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($item_id)
    {
        $item_comments = Comment::where('item_id', $item_id)->get();
        if(!$item_comments){
            return ['status' => 'error', 'message' => 'There are no results with id '. $item_id];
        }else{
            ['status' => 'success', 'data' => $item_id];
        }
        return $item_comments;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        $existingComment = Comment::find( $id );

        if( $existingComment ){
            $existingComment->content = $request->Comment['content'];
            $existingComment->save();
            return $existingComment;
        }

        return "Item not found.";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingComment = Comment::find( $id );

        if( $existingComment ){
            $existingComment->delete();
            return "Item successfully deleted";
        }

        return "Item not found";
    }
}
