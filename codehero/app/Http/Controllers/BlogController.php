<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;
use App\CategoryBlog;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
session_start();
class BlogController extends Controller
{
    public function add_blog()
    {
    	$data = CategoryBlog::all()->toArray();
    	return view("admin.add_blog")->with("data",$data);
    }
    public function insert_blog(Request $request) {
    $data = new Blog;
    $this->validate($request, [
        'img_upload' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    if ($request->hasFile('img_upload')) {
        $image = $request->file('img_upload');
        $name_img = rand(11111, 99999).time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images');
        $dir_img="/images/".$name_img;
        $image->move($destinationPath, $name_img);
        $data->title_blog = $request->title_blog;
        $data->content_blog = $request->content_blog;
        $data->cate_parent = $request->cate_parent;
        $data->img_blog = $dir_img;
        $data->rate_blog = 5;
        $data->view_blog = 0;
        $data->auth = Session::get('id');
        $data->save();
        return back()->with('success','Đăng bài thành công');
    }
    }
    public function accept_blog($id)
    {
        $data = Blog::find($id);
        $data->stt_blog=0;
        $data->save();
        return back();
    }
    public function deny_blog($id)
    {
        $data = Blog::find($id);
        $data->stt_blog=1;
        $data->save();
        return back();
    }
    public function del_blogs(Request $r)
    {
        $arr = $r->id;
        foreach ($arr as $key => $value) {
            $data = Blog::find($value);
            if($data){
            $data->delete();
            }
        }
    }
    public function access_blogs(Request $r)
    {
        $arr = $r->id;
        $data;
        foreach ($arr as $key => $value) {
            $data = Blog::find($value);
            if($data){
            $data->stt_blog=0;
            $data->save();   
            } 
        }
    }
    public function deny_blogs(Request $r)
    {
        $arr = $r->id;
        $data;
        foreach ($arr as $key => $value) {
            $data = Blog::find($value);
            if($data){
            $data->stt_blog=1;
            $data->save();   
            } 
        }
    }
}
