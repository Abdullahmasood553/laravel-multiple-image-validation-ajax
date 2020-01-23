<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;

class ImageController extends Controller
{
    public function get_image() {
        return view('get_image');
    }


    public function completedOrderJobModal(Request $request)
    {
        $post = new Post;
        if ($request->hasFile('screenshot')) {
            
            $completeFileName = $request->file('screenshot')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('screenshot')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly).'-'. rand() .'_'.time().'.'.$extension;
            $path = $request->file('screenshot')->storeAs('public/users', $compPic);
            $post->screenshot = 'users/'.$compPic;
        }
        
        if ($post->save()) {
            return ['status' => true, 'message' => 'Image Completed Successful'];
        } else {
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }

    public function get_posts() {
        $posts = Post::all();
         echo json_encode($posts);
    }

    public function delete_post(Request $request) {
        $post = DB::table('posts')->where('id', $request->id);
        if ($post->delete()) {
            return ['status' => true, 'message' => 'Deleted Successful'];
        } else {
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    } 
}
