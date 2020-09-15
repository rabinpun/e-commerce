<?php

namespace App\Http\Controllers;

use App\likedPosts;
use App\User;
use Illuminate\Http\Request;
use TCG\Voyager\Models\Post;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts=Post::latest()->paginate(9);
        return view('main.blogs.blogs',compact('posts'));
    }
    
    public function likedblogs()
    {
        //$posts=Post::latest()->paginate(9);
        $uid=auth()->user()->id;
        
        $user=User::find($uid);
        $posts=$user->likedposts;
       // dd($posts);
        return view('main.blogs.likedblogs',compact('posts'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post=Post::find($id);
        if($this->likedcheck($post))//likedcheck is a method for checking if the shown post is liked or not if liked post then returns true else false
        {
            $like=true;
        }
        else{
            $like= false;
        }
        return view('main.blogs.blog',compact('post','like'));
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function like($id)
    {
        $uid=auth()->user()->id;
        $post=Post::find($id);
        if($this->likedcheck($post))//checking if it is already liked or not
        {
            $likedpivotpost=likedPosts::where('user_id',$uid)->where('post_id',$id)->first();
            $likedpivotpostid=$likedpivotpost->id;
            likedPosts::destroy($likedpivotpostid);//delete the pivot information we will do this with ajax so page doesnt reload
            return back();
        }
        else{
            likedPosts::create([
                'user_id'=>auth()->user()->id,
                'post_id'=>$id,
    
            ]);
            return back();
        }
        
    }
    public function likedcheck(Post $post){
        $uid=auth()->user()->id;
        $user=User::find($uid);
        $posts=$user->likedposts;
        foreach($posts as $item)
        {
            if($item->id==$post->id)
            {
                return true;
            }
        }
        return false;
    }
}
