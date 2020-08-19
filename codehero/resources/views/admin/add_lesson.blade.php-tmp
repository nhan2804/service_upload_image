@extends('admin_home')
@section('admin_content')
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-4">
			<form action="{{URL::to('admin/course/insert-lesson')}}" method="post">
				{{csrf_field()}}
				<div class="form-group">
					<label>Tiêu đề bài học</label>
					<input type="text" class="form-control" name="title_lesson">
				</div>
				<div class="form-group">
					<label>Dán link vào để lấy khóa học</label>
					<input type="text" class="form-control" id="substring">
				</div>
				<div class="form-group">
					<label>Link khóa học</label>
					<input type="text" class="form-control" id="get_url" name="url_lesson">
				</div>
				<input type="hidden" value="{{$id_course}}" name="id_course">
				<input class="btn btn-success" type="submit" value="Thêm khóa học" name="">
			</form>
		</div>
		<div class="col-lg-8">
			<div class="table-responsive">
				<table class="table-striped table">
					<tr>
						<td>STT</td>
						<td>Tên bài</td>
						<td>Url</td>
						<td>Chức năng</td>
					</tr>
					@foreach($lessons as $key=>$value)
						<tr>
							<td>{{$value->num_lesson}}</td>
							<td>{{$value->title_lesson}}</td>
							<td>{{$value->url_lesson}}</td>
							<td>
								<a class="btn btn-warning" href="{{URL::to('admin/course/edit-lesson/'.$value->id_lesson)}}">Sửa</a>
								<a class="btn btn-danger" href="{{URL::to('admin/course/del-lesson/'.$value->id_lesson)}}">Xóa</a>
							</td>
						</tr>
					@endforeach
				</table>
			</div>
			{{ $lessons->links() }}
		</div>
	</div>
</div>
@endsection