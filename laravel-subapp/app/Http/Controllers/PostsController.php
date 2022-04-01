<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Posts::all();
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
            'website_id' => 'required|exists:websites,id'
        ]);

        if (!$validator->fails())
        {
            $websiteName = DB::table('websites')->where('id', $request->input('website_id'))->get([
                'name'
            ])[0]->name;

            $users = DB::table('users')->where('website_id', $request->input('website_id'))->get([
                'name',
                'email'
            ]);

            // Checking for duplicate stories by title or content
            $duplicate = DB::table('posts')
            ->where('title', $request->input('title'))
            ->orWhere('content', $request->input('content'))
            ->first([
                'id'
            ]);

            if (!isset($duplicate->id))
            {
                foreach ($users as $user)
                {
                    Artisan::queue('emails:send', [
                        'username' => $user->name,
                        'websiteName' => $websiteName,
                        'email' => $user->email,
                        'subject' => 'New Post',
                        'title' => $request->input('title'),
                        'content' => $request->input('content')
                    ]);
                    Log::info("Sending email for {$user->name} to this email {$user->email}!");
                }
            }

            return Posts::create($request->all());
        }
        else return $validator->errors();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $post = Posts::find($id);
        $post->update($request->all());

        return $post;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return Posts::destroy($id);
    }

    /**
     * Search for a post by id
     * 
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function search($id)
    {
        return Posts::where('id', '=', $id)->get();
    }
}
