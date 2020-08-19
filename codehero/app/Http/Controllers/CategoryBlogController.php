<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryBlog;
use App\Blog;
class CategoryBlogController extends Controller
{	
	public function view_cate()
	{
		$data = CategoryBlog::all()->toArray();
		$blog = Blog::paginate(10);
    	return view('admin.blog')->with('data',$data)->with('blog',$blog);
	}
	public function add_cate_blog(Request $req)
	{
		$data = new CategoryBlog;
		$data->name= $req->name_cate;
		$data->sort=0;
		$data->type=0;
		$data->parent_id=0;
		$data->save();
		return redirect('/admin/blog');
	}
}
