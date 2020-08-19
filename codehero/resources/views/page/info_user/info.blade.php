@extends('welcome')
@section('title',"Thông tin của tôi")
@section('content')
<br>
<br>
<br>
<div class="container">
	<div style="background:url({{asset($data->cover_img)}});background-position: center;object-fit: cover;width: 100%;height: 200px;position: relative; ">
		<img style="position: absolute;width: 200px;height: 200px;border-radius: 50%;border: 3px solid #ccc" src="{{asset($data->avatar)}}" alt="">
	</div>
<br>
	<div class="card">
  <div class="card-header">
    Cập nhật thông tin
  </div>
  <div class="card-body">
    <div class="form-group">
		<label>Tên hiển thị</label>
		<input class="form-control" type="text" value="{{$data->displayname}}" name="">
	</div>
	<div class="form-group">
		<label>Số điện thoại</label>
		<input class="form-control" type="text" value="{{$data->phone}}" name="">
	</div>
  </div>
</div>
<br>
 <div class="btn_change" style="width: 200px;background: #C5BDBD">
 	Thay đổi mật khẩu
 </div>
 <div class="card hidden form_change">
  <div class="card-body">
    <div class="form-group">
		<label>Mật khẩu cũ</label>
		<input class="form-control" type="text"  name="">
	</div>
	<div class="form-group">
		<label>Mật khẩu mới</label>
		<input class="form-control" type="text" name="">
	</div>
	<div class="form-group">
		<label>Nhập lại mật khẩu</label>
		<input class="form-control" type="text" name="">
	</div>
  </div>
</div>
</div>
@endsection