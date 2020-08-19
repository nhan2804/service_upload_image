@extends('admin_home')
@section('admin_content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-8">
			<form action="{{URL::to('admin/course/insert-course')}}" method="post" enctype="multipart/form-data">
				{{csrf_field()}}
				<div class="form-group">
					<label>Tên khóa học</label>
					<input class="form-control" type="text"  name="title_course">
				</div>
				<div class="form-group">
					<label>Ảnh cho khóa học</label>
					<input type="file" name="img_upload" id="img_upload" accept="image/*">
				</div>
				<div class="form-group">
					<label>Tên khóa học</label>
					<textarea id="edit_post" class="form-control" name="content_course" ></textarea>
				</div>
				<div class="form-group">
					<label>Giá khóa học</label>
					<input class="form-control" type="text"  name="coin">
				</div>
				<div class="form-group">
					<label>Chọn chương trình khóa học</label>
					<select name="cate_course" class="form-control">
						@foreach($data as $key=>$value)
						<option value="{{$value['id_cate']}}">{{$value['name']}}</option>
						@endforeach
					</select>
				</div>
				<input class="btn btn-success" type="submit" name="add_course" value="Thêm mới">
			</form>
		</div>
		<div class="col-md-4">
			<form method="POST" action="{{URL::to("/admin/course/add-cate-course")}}">
				{{csrf_field()}}
				<div class="form-group">
					<label>Tên Chương Trình Đào Tạo</label>
					<?php
					if (Session::get('success')) {
						echo '<div class="alert alert-success">'.Session::get('success').'</div>';
					}
					?>
					<input class="form-control" type="text" name="name_cate">
					<br>
					<input class="btn btn-success" type="submit" name="" value="Thêm">
				</div>
			</form>
			<div class="table-responsive">
				<table class="table-striped">
					<th>
						<tr>
						<td>ID Chương trình</td>
						<td>Tên</td>
						<td>Chức năng</td>
						</tr>
					</th>
					<tbody>
						@foreach($data as $key=>$value)
						<tr>
						<td>{{$value['id_cate']}}</td>
						<td>{{$value['name']}}</td>
						<td>
							<a href="#" class="btn btn-info">Sửa</a>
							<a href="#" class="btn btn-danger">Xóa</a>
						</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
    config = {};
    config.entities_latin = false;
    config.language = "vi";
    CKEDITOR.replace("edit_post", config);
</script> 
@endsection