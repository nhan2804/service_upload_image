<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CateForum;
class CateForumController extends Controller
{
    public function index()
    {
    	$data= CateForum::all()->toArray();
    	return view('admin.cate_forum')->with('data',$data);

    }
    public function insert_cate(Request $req)
    {
    	$name_cate= $req->name_cate;
    	$data = new CateForum;
    	$data->name_cate= $name_cate;
    	$data->save();
    	return back();
    }
}
