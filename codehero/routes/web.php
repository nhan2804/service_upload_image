<?php

use Illuminate\Support\Facades\Route;


// Route::fallback(function () {
// 	return redirect('error404.php');
    
// });
Route::get('error404.php',function()
{
	return view('errors.404');
});
// Route::get('admin',function()
// {
// 	return view('admin/dashboard');
// });

Route::group(['prefix' => 'me'], function() {
	Route::get('/course','ProfileController@course');
	Route::get('/logout','ProfileController@logout');
	Route::get('/post','ProfileController@post');
	Route::get('/','ProfileController@index');
});



Route::get('/','HomeController@index');
Route::get('/home','HomeController@index');

// Route::any('/','HomeController@index');
Route::post('/get-profile','AdminController@get_profile');
Route::post('/notify','NotifyController@notify');
Route::post('/list-notify','NotifyController@list_notify');
Route::post('/set-notify','NotifyController@set_notify');
Route::group(['prefix' => 'forum'], function() {
	Route::get('/','ForumController@index');
	Route::post('/see-more','ForumController@see_more');
	Route::get('/post/{id}','ForumController@view_post'); 
	Route::post('/search-post','ForumController@search_post'); 
	Route::post('/post/cmt-blog','ForumController@cmt_blog'); 




	//error
	
});

Route::group(['prefix' => 'document'], function() {
	Route::get('/','DocumentController@add_docs');
});
Route::group(['prefix' => 'blog'], function() {
	Route::get('/','BlogHomeController@index');
	Route::get('/thread/{id}','BlogHomeController@view_cate');
	Route::get('/{id}/{slug}','BlogHomeController@view_forum');
	Route::post('/{id}/delete-cmt-forum','BlogHomeController@delete_cmt');
	Route::get('/create-forum','BlogHomeController@create_forum');
	Route::post('/insert-forum','BlogHomeController@insert_forum');
	Route::post('/{id}/react','BlogHomeController@react_forum');
	Route::post('/{id}/cmt-forum','BlogHomeController@cmt_forum');
	Route::post('/{id}/reply-cmt','BlogHomeController@reply_cmt');
});
Route::group(['prefix' => 'document'], function() {
	Route::get('/','DocumentController@index');
	Route::get('/get-doc','DocumentController@get_doc');
});
Route::group(['prefix' => 'course'], function() {
	Route::get('/{id}','ForumController@view_post'); 
	Route::get('/','HomeController@course'); 
	Route::get('/post/{id}','HomeController@course_detail'); 
	Route::post('/post/buy-course','HomeController@buy_course');
	Route::post('/post/rate-course','HomeController@rate_course');  
	Route::post('/post/rate-detail','HomeController@rate_detail'); 
	Route::get('/category/{id_course}','HomeController@cate_course');
});

//admin
//'middleware' => ['admin']]


Route::post('/check-login','AdminController@check_login'); 
Route::post('/check-reg','AdminController@check_reg'); 
Route::group(['prefix' => 'admin','middleware' => ['admin']], function() {
   Route::get('/dashboard','AdminController@dashboard'); 
	Route::group(['prefix' => 'blog'], function() {
		Route::get('/','CategoryBlogController@view_cate');
	   Route::post('/add-cate-blog','CategoryBlogController@add_cate_blog');
	   Route::get('/add-blog','BlogController@add_blog');
	   Route::get('/accept/{id}','BlogController@accept_blog');
	   Route::get('/deny/{id}','BlogController@deny_blog');
	   Route::post('/insert-blog','BlogController@insert_blog');
	   Route::post('/del-blogs','BlogController@del_blogs');
	   Route::post('/access-blogs','BlogController@access_blogs');
	   Route::post('/deny-blogs','BlogController@deny_blogs');

	});
   Route::group(['prefix' => 'course'], function() {
		Route::get('/','CourseController@index'); 
		Route::get('/add-course','CourseController@add_course');
		Route::post('/add-cate-course','CourseController@add_cate_course');
		Route::post('/insert-course','CourseController@insert_course');
		Route::get('/add-lesson/{id}','CourseController@add_lesson');
		Route::post('/insert-lesson','CourseController@insert_lesson');
});
   Route::group(['prefix' => 'forum'], function() {
		Route::get('/','CateForumController@index'); 
		Route::post('/insert-cate-forum','CateForumController@insert_cate');
});
   Route::group(['prefix' => 'document'], function() {
	Route::get('/','DocumentController@add_docs');
	Route::put('/insert-docs','DocumentController@insert_docs');
	Route::post('/insert-cate-docs','DocumentController@insert_cate');
});

   
});
