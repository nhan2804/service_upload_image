
@extends('welcome')
@section('title',"Diễn đàn")
@section('content')
<br>
<br>
<br>
<br>
<div style="padding: 0" class="container">
	@if(Session::get('id'))
	<div style="display: flex;justify-content: center;">
		<a href="blog/create-forum" style="border: 2px solid #007bff" class="btn "><i class="fas fa-plus"></i> Thảo luận</a>
	</div>
	@endif
	<br>
	<br>
	<div class="row">
		<div class="col-lg-8">
			<div class="row">
				<div class="col-lg-12">
					<div style="border-radius: unset;outline: none;width: 200px" class=" btn btn-primary"><i class="far fa-newspaper"></i> Mới nhất</div>
				</div>
				
				@foreach($data as $key=>$value)
				<?php
					$title_forum = $value->title_post;
					if(strlen($title_forum)>85){
						$title_forum = substr($title_forum, 0, 85).'...';
					}


				?>
				<div class="col-lg-12">
					<div class="item_forum" style="display: flex;padding: 10px 0;margin:10px 0;border-top-left-radius: 20px;border-bottom-right-radius: 20px">
						<div style="background: url({{asset($value->avatar)}});background-position: center;background-size: cover;width: 80px;height: 80px;border-radius: 50%;margin-left: 8px"></div>
						<div style="height: 80px;flex: 1;margin-left: 8px;position: relative;">
							<div style="display: flex;font-size: .8rem;">
								<span style="display: block;background:{{$value->color_cate}};padding: 0 4px;border-radius: 10px;color: white">{{$value->name_cate}}</span>
								<span style="margin-left: 8px">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
							</div>
							<a class="link_forum" style="display: block;font-size: 1.1rem;" href="{{URL::to('blog/'.$value->id_post.'/'.$value->slug_forum.'.html')}}">{{$title_forum}}</a>
							<div style="align-items: flex-end;position: absolute;bottom: 0">
								<span style="font-size: 0.8rem"><i  class="fas fa-heart icon_heart"></i>{{$value->like_post}}</span>
								<span><i style="font-size: 0.8rem" class="far fa-comment-dots"> {{$value->comments}}</i></span>
								<span><i style="font-size: 0.8rem" class="far fa-eye"> {{$value->views}}</i></span>
								<i style="font-size: 0.8rem" class="fas fa-user"></i><a class="link_user" username="{{$value->id}}" status="false" href="#">{{$value->user}}<div class="user_name"></div></a>
							</div>
						</div>
					</div>
				</div>
				@endforeach
			</div>
			<div>
				{{$data->links()}}
			</div>
		</div>
		<div class="col-lg-4">
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;background: #574BFC" class="heading-new btn btn-primary">Top thảo luận</div>
			</div>
			<br>
			@foreach($data_new as $key => $value)
				<?php
					$title_forum = $value->title_post;
					if(strlen($title_forum)>40){
						$title_forum = substr($title_forum, 0, 40).'...';
					}
				?>
				<div class="p-0">
					<div class="item_forum" style="display: flex;padding: 10px 0;margin:10px 0;border-top-left-radius: 20px;border-bottom-right-radius: 20px">
						<div style="background: url({{asset($value->avatar)}});background-position: center;background-size: cover;width: 80px;height: 80px;border-radius: 50%;margin-left: 4px"></div>
						<div style="height: 80px;flex: 1;margin-left: 8px;position: relative;">
							<div style="display: flex;font-size: .8rem;">
								<span style="display: block;background:{{$value->color_cate}};padding: 0 4px;border-radius: 10px;color: white">{{$value->name_cate}}</span>
								<span style="margin-left: 8px">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
							</div>
							<a class="link_forum" style="display: block;font-size: 1.1rem;" href="{{URL::to('blog/'.$value->id_post.'/'.$value->slug_forum.'.html')}}">{{$title_forum}}</a>
							<div style="align-items: flex-end;position: absolute;bottom: 0">
								<span style="font-size: 0.8rem"><i  class="fas fa-heart icon_heart"></i>{{$value->like_post}}</span>
								<span><i style="font-size: 0.8rem" class="far fa-comment-dots"> {{$value->comments}}</i></span>
								<span><i style="font-size: 0.8rem" class="far fa-eye"> {{$value->views}}</i></span>
								<i style="font-size: 0.8rem" class="fas fa-user"></i><a class="link_user" username="{{$value->id}}" status="false" href="#">{{$value->user}}<div class="user_name"></div></a>
							</div>
						</div>
					</div>
				</div>
			@endforeach
			<br>
			<div class="under_line">
				<div style="border-radius: unset;outline: none;" class="heading-new btn btn-danger">Chủ đề</div>
			</div>
			<br>
			<ul class="list__cate--forum">
			@foreach($cate_forum as $key => $value)
				<li class="item__cate--forum">
					<a href="{{URL::to('blog/thread/'.$value->id_cate)}}">{{$value->name_cate}}</a>
					<span>Tổng bài viết :{{$value->sum_post}} </span>
					<span>Mới nhất :{{$value->title_post}} </span>
				</li>
			@endforeach
			</ul>
			
		</div>
	</div>
	
</div>
<script type="text/javascript">
	$('.item_forum').each(function(i, el) {
	   if (i % 2 === 0) {

	   	$(this).addClass('blue_light');
	   }else{
	   	$(this).addClass('gray_light');
	   }
});
</script>
@endsection