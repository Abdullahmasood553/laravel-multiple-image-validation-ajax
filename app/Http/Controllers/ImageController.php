<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Post;
use DB;
use File;

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
            $post->screenshot = $compPic;
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

    public function delete_post($id) {
        $post = Post::findOrFail($id);
        if(Storage::exists('public/users/'.str_replace('./storage/users/', '', $post->screenshot))){
            Storage::delete('public/users/'.str_replace('./storage/users/', '', $post->screenshot));
        }

        if ($post->delete()) {
            return ['status' => true, 'message' => 'Deleted Successful'];
        } else {
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    } 

    public function update_image($id) {
        $post = Post::find($id);
        return view('update_image')->with('post', $post);
    }


    // public function update_post(Request $request) {
    //     if($request->hasFile('post_updating_id')){
    //         $completeFileName = $request->file('screenhot')->getClientOriginalName();
         
    //         $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
    //         $extension = $request->file('donee_pic_edit')->getClientOriginalExtension();
    //         $doneePic = str_replace(' ', '_', $fileNameOnly).'_'.time().'.'.$extension;
    //         $path = $request->file('donee_pic_edit')->storeAs('public/donee', $doneePic);
    //         $old_pic = DB::table('donee_managment')->where('id', $request->donee_id)->first();
    //         $pic_name = explode('/', $old_pic->picture);
    //         $test = $pic_name[3];
    //         if(Storage::exists('public/donee/'.$pic_name[3])){
    //             Storage::delete('public/donee/'.$pic_name[3]);
    //         } 
    //      }
    // }

    public function update_post(Request $request, $id) {
            
        $post = Post::find($id);
        if($request->hasfile('screenshot')) {
            $completeFileName = $request->file('screenshot')->getClientOriginalName();
            $fileNameOnly = pathinfo($completeFileName, PATHINFO_FILENAME);
            $extension = $request->file('screenshot')->getClientOriginalExtension();
            $compPic = str_replace(' ', '_', $fileNameOnly).'-'. rand() .'_'.time().'.'.$extension;
            $path = $request->file('screenshot')->storeAs('public/users', $compPic);
            $post->screenshot = $compPic;
        }
        if ($post->save()) {
            return ['status' => true, 'message' => 'Image Updated Successful'];
        } else {
            return ['status' => false, 'message' => 'Something went wrong'];
        }
    }
}
