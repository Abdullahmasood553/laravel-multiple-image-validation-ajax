<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;

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
}
