<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index', ['posts' => Post::all()->sortByDesc('id')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Gate::denies('isAdmin')) {
            return redirect('posts')->with('warning', 'You are not authorized to access this route.');
        }

        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $post = new Post();
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::user()->id;
            $post->save();

            Session::flash('success', 'Successfully created post!');

            return redirect('posts');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('posts.show', ['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        if (Gate::denies('isAdmin')) {
            return redirect('posts')->with('warning', 'You are not authorized to access this route.');
        }

        $rules = [
            'title' => 'required',
            'content' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        } else {
            $post->title = $request->input('title');
            $post->content = $request->input('content');
            $post->user_id = Auth::user()->id;
            $post->save();

            Session::flash('success', 'Successfully updated post!');

            return redirect('posts');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        if (Gate::denies('isAdmin')) {
            return redirect('posts')->with('warning', 'You are not authorized to access this route.');
        }

        if ($post->comments()) {
            $post->comments()->delete();
        }

        $post->delete();

        Session::flash('success', 'Successfully deleted the post!');

        return redirect('posts');
    }
}
