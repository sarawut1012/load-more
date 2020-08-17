<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Posts;

class PostController extends Controller
{
    public function index(Request $request)
    {
        return view('posts');
    }

    public function blog(Request $request)
    {
        return view('blog');
    }


    public function getData(Request $request)
    {
        $limit = $request->get('limit');
        $start = $request->get('start');

        $posts = Posts::offset($start)
            ->limit($limit)->get();
        $data = '';
        foreach ($posts as $post) {
            {
                $data .= '
                    <div class="card">
                        <h2> ' . $post->title . '</h2>
                        <h5> Created ' . date("d/M/Y", strtotime($post->created_at)) . '</h5>
                          <div class="w3-quarter">
                          <a href="' . url('/') . '/storage/images/' . $post->image . '" class="lazy-load replace">
                            <img  src="' . url('/') . '/storage/images/' . $post->image . '" class="preview" alt="Steak" />
                           </a> 
                           </div>
                        <p>By - ' . $post->auther_name . '</p>
                        <p>' . $post->description . '</p>
                    </div>
                ';
            }
        }
        return $data;
    }
}
