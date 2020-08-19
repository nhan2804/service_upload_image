@extends('admin_home')
@section('admin_content')
<form action="{{URL::to('admin/blog/insert-blog')}}" method="post" enctype="multipart/form-data">
	{{csrf_field()}}
	<?php
if (Session::get('success')) {
	echo Session::get('success');
}

?>
	<div class="form-group">
		<label>Tiêu đề bài viết</label>
		<input class="form-control" type="text" name="title_blog">
		<label>Ảnh bài viết</label>
		<input type="file" name="img_upload" id="img_upload" accept="image/*">
		<label>Nội dung bài viết</label>
		<textarea id="edit_post" class="form-control" name="content_blog" cols="80" rows="10"></textarea>
		<label>Chủ đề bài viết</label>
		<select name="cate_parent" class="form-control">
			@foreach($data as $key=>$value)
			<option value="{{$value['id']}}">{{$value['name']}}</option>
			@endforeach
		</select>
		<input type="submit" name="" class="btn btn-primary" value="Đăng bài">
	</div>
</form>
@if (count($errors) > 0)
     <div class = "alert alert-danger">
            <ul>
               @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
               @endforeach
            </ul>
         </div>
 @endif
<script>
    config = {};
    config.entities_latin = false;
    config.language = "vi";
    CKEDITOR.replace("edit_post", config);
</script> 
@endsection