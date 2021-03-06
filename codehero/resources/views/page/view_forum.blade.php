@extends('welcome')
@section('title',$data->title_post)
@section('content')
<br>
<br>
<br>
<br>
<div class="modal_popup_cmt hidden">
        <div class="layer"></div>
        <div class="popup_edit">
           <form class="form_edit">
           	<div class="heading_edit">
           		<h3>Chỉnh sửa bình luận</h3>
           		<i class="fas fa-times"></i>
           	</div>
           	<div class="text_edit">
           		<input type="text" name="">
           	</div>
           	<div style="display: flex;justify-content: flex-end;padding: 4px;">
           		<input class="btn btn-success text-right" type="submit" value="Sửa" name="">
           	</div>
           </form>
        </div>
    </div>
<div style="padding: 0" class="container">
	<?php 
	function getLV($level)
	{
		$lv='';
	if ($level==0) {
		$lv='<span style="background:#FC0101" class="span_level">Admin</span>';
	}else if ($level==1) {
		$lv='<span style="background:#FF8C00" class="span_level">Mod</span>';
	}else if($level==2){
		$lv='<span style="background:#007BFF"  class="span_level">Normal</span>';
	}else if($level==3){
		$lv='<span style="background:#B8B3B3"  class="span_level">Wibu</span>';
	}
	return $lv;
	}
	?>
	<?php
	$lv=getLV($data->accessright);
	?>
	<input type="hidden" id="title_web" value="{{$data->title_post}}" name="">
	<div class="row">
		<div class="col-12">
			<div style="background: url({{asset($data->img_cate)}});background-position: center;background-size: cover;height: 200px;position: relative;">
				<div style="position: absolute;background: rgba(255,255,255,.4);width: 100%;padding: 2px 8px;"><b><a href="#">{{$data->name_cate}}</a></b> | <a href="#">Hoạt động</a></div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
				<ul class="list_redicrect" style="display: flex;flex-wrap: wrap;">
					<li><a href="{{URL::to('blog')}}">Forum</a></li>
					<li><i class="fas fa-angle-right"></i><a href="{{URL::to('blog/thread/'.$data->id_cate)}}"> {{$data->name_cate}}</a> <i class="fas fa-angle-right"></i></li>
					<li></i><a style="color: #333" href="#"> {{$data->title_post}}</a></li>
				</ul>
				<br>
    	</div>

		<div class="col-lg-3 col-md-12 col-sm-12 info_post_mobile p-0">
			<div class="forum_info_auth info_user_post" style="background: url({{asset($data->avatar)}});background-position: center;background-size: cover;border-radius: 50%;" ></div>
			<div class="div_level_user">
				<form method="POST" class="form_user">
					{{ csrf_field()}}
				<a class="link_user" style="font-weight: 500" status="false" username="{{$data->id}}" href="{{URL::to('profile/'.$data->id)}}">{{$data->user}}
				
				<div class="user_name"></div>
				</a>
				</form>
				{!!$lv!!}
				<span class="getTime hide-on-table hidden-on-pc "><i class="far fa-clock"></i> {{ \Carbon\Carbon::parse($data->time_created)->diffForHumans() }}</span>
			</div>
			
		</div>
		<div class="col-lg-9 p-0">
			<div style="background: #e2ecf0;border: 5px solid #fff;box-shadow: 1px 2px 3px gray;border-radius: 16px;padding: 4px 8px">
				<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
					{{-- <span class="getTime">{{$data->created_at->diffForHumans()}}</span> --}}
					<span class="getTime hide-on-mobile">{{ \Carbon\Carbon::parse($data->time_created)->diffForHumans() }}</span>
				</div>
				<div class="cmt_forum">
					<h3 style="text-transform: uppercase;">{{$data->title_post}}</h3>
					<hr>
					<div class="content_post">
						{!! $data->content_post !!}
					</div>
					
				</div>
				<div>
					<!-- <span><i class="fas fa-signature"></i>{{$data->sign}}</span>	 -->
					<br>
					<form onsubmit="return false" action="post">
					{{csrf_field()}}
					@if(count($user_react))
						<button data-id="{{$data->id_post}}" style="line-height: 1;width: 100px" class="btn btn-primary btn-sm btn_react"><i style="color: red" class="fas fa-heart"></i> Đã thích</button>
					@else
						<button data-id="{{$data->id_post}}" style="line-height: 1;width: 100px" class="btn btn-info btn-sm btn_react">Thích</button>
					@endif
					<span>{!!$allreact!!}</span>
					</form>
				</div>
				<div class="socials-share" style="display: flex;justify-content: flex-end;margin: 0">
		    	<a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=" target="_blank"><i class="fab fa-facebook-f"></i> Share</a>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div style="display: flex;justify-content: flex-end;">
		{!!$allcmt->links()!!}
	</div>
	<br>
	@foreach($allcmt as $key=>$value)
	<?php
	$lv=getLV($value->accessright);
	?>
		
	<div class="row">
		<div class="col-lg-2 col-md-12 col-sm-12 p-0">
			<div class="div_info_post info_post_mobile">
				<div class="forum_info_auth info_user_cmt" style="background: url({{asset($value->avatar)}});background-position: center;background-size: cover;border-radius: 50%" ></div>
				<div class="div_level_user">
					<a class="link_user" style="font-weight: 500;margin-right: 4px" status="false" username="{{$value->id}}" href="{{URL::to('profile/'.$value->id)}}">{{$value->user}}
					<div class="user_name"></div>
					</a>
					{!!$lv!!}
					
				</div>
			</div>
		</div>
		<div id="{{'comment_'.$value->id_cmt}}" style="background: #e2ecf0;box-shadow: 1px 2px 3px #ccc;border-radius: 4px;background: #F6EDD2" class="col-lg-10 alert-info p-2">
			<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
				#{{$value->id_cmt}} | <span class="getTime">{{ \Carbon\Carbon::parse($value->created_at)->diffForHumans() }}</span>
			</div>
			<div id="cmt_forum_{{$value->id_cmt}}" class="cmt_forum">
				{{$value->content_cmt}} 
			</div>
			<div>
				{{-- <span><i class="fas fa-signature"></i>{{$value->sign}}</span> --}}
				<br>
				<button style="line-height: 1;width: 80px" class="btn btn-info btn-sm">Like!</button> 
			</div>
			<div style="display: flex;justify-content: flex-end;">
				@if(Session::get('id')==$value->id_auth || Session::get('id')==$data->id)
				<i title="Xóa" style="margin: 0 8px" data-id="{{$value->id_cmt}}" class="far fa-trash-alt del_cmt"></i>
				<i title="Sửa" style="margin: 0 8px" data-id="{{$value->id_cmt}}" class="fas fa-edit edit_cmt"></i>
				@endif
				<i title="Báo cáo" class="fas fa-exclamation-triangle"></i>
				<i data-id-0="{{$value->id_cmt}}" title="Trả lời" data-id="{{$value->id_cmt}}" data-name="{{$value->user}}" style="margin: 0 8px" class="fas fa-reply btn_reply"></i>
			</div>
		</div>
	</div>
	@foreach($allcmt1->where('id_parent',$value->id_cmt) as $key=>$value1)
	<?php
	$lv=getLV($value1->accessright);
	?>
	<br>
	<div style="padding-left: 100px;position: relative;">
		<div class="line_cmt"></div>
		<div class="row">
		<div class="col-lg-2 col-md-12 col-sm-12 p-0">
			<div class="div_info_post info_post_mobile">
				<div class="forum_info_auth info_user_reply" style="border-radius:50%;background: url({{asset($value1->avatar)}});background-position: center;background-size: cover;" ></div>
				<div class="div_level_user">
					<a class="link_user" style="font-weight: 500;margin-right: 4px" status="false" username="{{$value1->id}}" href="{{URL::to('profile/'.$value1->id)}}">{{$value1->user}}
					<div class="user_name"></div>
					</a>
					{!!$lv!!}
				</div>
			</div>
		</div>
		<div id="{{'comment_'.$value1->id_cmt}}" style="background: #F7EBCA" class="col-lg-10 alert-info p-2">
			<div style="display: flex;justify-content: flex-end;font-size: 0.8rem">
				#{{$value1->id_cmt}} | <span class="getTime">{{ \Carbon\Carbon::parse($value1->created_at)->diffForHumans() }}</span>
			</div>
			<div id="cmt_forum_{{$value1->id_cmt}}" style="min-height: 40px" class="cmt_forum">
				{!!$value1->content_cmt!!} 
			</div>
			<div>
				{{-- <span><i class="fas fa-signature"></i>{{$value1->sign}}</span> --}}
				<br>
				<button style="line-height: 1;width: 80px" class="btn btn-info btn-sm">Like!</button>
			</div>
			<div style="display: flex;justify-content: flex-end;">
				@if(Session::get('id')==$value1->id_auth || Session::get('id')==$data->id)
				<i style="margin: 0 8px" data-id="{{$value1->id_cmt}}" class="far fa-trash-alt del_cmt"></i>
				<i style="margin: 0 8px" data-id="{{$value1->id_cmt}}" class="fas fa-edit edit_cmt"></i>
				@endif
				<i  class="fas fa-exclamation-triangle"></i>
				<i data-id-0="{{$value->id_cmt}}" data-id="{{$value1->id_cmt}}" data-name="{{$value1->user}}"  style="margin: 0 8px" class="fas fa-reply btn_reply"></i>
			</div>
		</div>
	</div>
	</div>
	@endforeach
	<br>
	<div style="padding-left: 100px">
		@if(Session::get('id'))
		<form id="form_reply_{{$value->id_cmt}}" class="hidden form_reply" onsubmit="return false">
		{{ csrf_field()}}
			<div class="comment">
				<div class="info_cmt">
					<img class="img_cmt" src="{{asset(Session::get('img'))}}" alt="">
					<h3 class="name_auth">{{Session::get('name')}}</h3>
				</div>
				<span id="tag_name_{{$value->id_cmt}}" class="tag_name"></span>
				<input style="padding-left: 70px;"  class="input_cmt" id="reply_cmt_{{$value->id_cmt}}" placeholder="Nhập để trả lời bình luận" name="cmt" >
			</div>
			<div class="btn_cmt">
				<input class="btn btn-primary btn_reply_cmt " data-cmt="{{$value->id_cmt}}" data-auth="{{$value->id}}" data-id="{{$data->id_post}}" type="submit" link="comment_" value="Bình luận">
			</div>
		</form>
		@endif
	</div>
	@endforeach


	<form onsubmit="return false">
		{{ csrf_field()}}
	@if(Session::get('id'))
		<div class="comment">
			<div class="info_cmt">
				<img class="img_cmt" src="{{asset(Session::get('img'))}}" alt="">
				<h3 class="name_auth">{{Session::get('name')}}</h3>
			</div>
			<input class="input_cmt" placeholder="Nhập để bình luận" name="cmt" id="cmt_input">
		</div>
		<div class="btn_cmt">
		<input class="btn btn-primary" data-auth="{{$data->id}}" data-id="{{$data->id_post}}" id="cmt_forum" type="submit" value="Bình luận">
		</div>
	</form>
	@else
		<h3 class="left_cmt">Đăng nhập để bình luận</h3>
	@endif
	<br>
	<div style="display: flex;justify-content: flex-end;">
		{!!$allcmt->links()!!}
	</div>
</div>
<div class="redirect"></div>
@endsection