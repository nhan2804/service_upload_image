function opentab(evt,id) {
	var tabcontent,active;
	tabcontent = document.getElementsByClassName("input_login");
	for (var i = 0; i < tabcontent.length; i++) {
		tabcontent[i].style.display = 'none';
	}
	active = document.getElementsByClassName("opentab");
	for (var i = 0; i < active.length; i++) {
		active[i].className = active[i].className.replace("btn_border"," ");
	}
	document.getElementById(id).style.display = 'block';
	evt.currentTarget.className+= " btn_border";
}
if (document.getElementById("opened")) {
	document.getElementById("opened").click();
}
var lastScrollTop = 0;
$(window).scroll(function(event){
   var st = $(this).scrollTop();
   if (st > lastScrollTop){
   		$(".header").removeClass('pined');
      	$(".header").addClass('unpin');
   } else {
      	$(".header").removeClass('unpin');
        $(".header").addClass('pined');
   }
   lastScrollTop = st;
});
$data_load = $('#rs_search').html();
$('#input_search').on('keyup', function(event) {
	$search = $(this).val();
	$_token = $('input[name="_token"]').val();
	$('#rs_search').html('');
	$('#rs_search').addClass('hidden');
	if ($search.length>2) {
		$.ajax({
			url: 'forum/search-post',
			type: 'POST',
			data: {
				search:$search,
				_token:$_token
			},beforeSend: function() {
				$('#rs_search').html($data_load);
        		$('.effect').removeClass('hidden');
        		// $('#rs_search').addClass('hidden');
        		$('#rs_search').removeClass('hidden');
    		},success:function (data) {
       			$('.effect').addClass('hidden');
       			$('#rs_search').html('');
       			$('#rs_search').addClass('hidden');
       			$('#rs_search').removeClass('hidden');
       			$('#rs_search').html(data);		
			},error:function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		})
	}
});

$('#cmt_blog').on('click', function(event) {
	event.preventDefault();
	alert("gi z");
	$cmt = $('#cmt_input').val();
	$id_blog = $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	console.log("cmt:"+$cmt+" id_blog :"+$id_blog);
	if($cmt) {
		alert("alo");
		$.ajax({
			url: 'cmt-blog',
			type: 'POST',
			data: {
				cmt:$cmt,
				id_blog:$id_blog,
				_token:$_token},
			success:function (data) {
				// $('.item_cmt').prepend(data);
				// $cmt = $('#cmt_input').val('');
				alert(data);
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		})
	}
});
$('.list_lesson li a').click(function() {
	var a = $(this).attr('data-title');
	$('#title_course').text(a);
	var b = $(this).attr('data-href');
	$('#ytb').attr('src',b);
	$('.list_lesson li').removeClass('active');
	$(this).parent().addClass('active');
	return false;
});
$('.div_comment').each(function(i, el) {
   if (i % 2 === 0) {
   	$(this).addClass('gray');
   }
});
$('#cmt_input').on('keyup', function(event) {
	$cmt = $(this).val();
	if($cmt=='') {
		$('#cmt_blog').css('opacity', '0.5');
	}else{	
		$('#cmt_blog').css('opacity', '1');
	}
});
$('#btn_buy').on('click', function(event) {
	if (confirm('Bạn có muốn mua khóa học này không?')) {
		$id_course= $('#id_course').val();
		$_token = $('input[name="_token"]').val();
		$title_web= $('#title_web').val();
		$link_url= window.location.href;

		$.ajax({
			url: 'buy-course',
			type: 'POST',
			data: {
				title_web:$title_web,
				link_url:$link_url,
				id_course: $id_course,
				_token:$_token
			},
			success:function (data) {
				$('#rs_buy').html(data);
				// alert(data);
			}
		})
	}
});
function resetColor() {
	$('.icon-star').css('color', '#C0C0C0');
}
let rateIndex=-1;
if (localStorage.getItem("rateIndex")!=null) {
	setStar(localStorage.getItem("rateIndex"));
}
$('.icon-star').on('click', function(event) {
	rateIndex =$(this).attr('data-index');
	localStorage.setItem("rateIndex", rateIndex);
	$('.cmt_rate').removeClass('hidden');
});
$('.icon-star').mouseover(function(event) {
	resetColor();
	$index = $(this).attr('data-index');
	setStar($index);
});
$('.icon-star').mouseleave(function(event) {
	resetColor();
	if (rateIndex!=-1) {
		setStar(rateIndex);
	}
});
function setStar(index) {
	for (var i = 0; i <=index; i++) {
		$('.icon-star:eq('+i+')').css('color', 'yellow');
	}
}
$('#btn_rate').on('click', function(event) {
	$star_rate= localStorage.getItem("rateIndex");
	$id_course= $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	$rate= $('#rate_input').val();
	console.log("id :"+$id_course);
	console.log("_token :"+$_token);
	console.log("rate :"+$rate);
	console.log("rate :"+$star_rate);
	if ($rate) {
		$.ajax({
			url: 'rate-course',
			type: 'POST',
			data: {
				id_course:$id_course,
				_token:$_token,
				rate:$rate,
				star_rate:$star_rate
			},
			success:function (data) {
				alert("ok");
			}
		})
	}
});
$('.detail_rate').on('click', function(event) {
	$id_course= $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	$('.list_rate').html('');
	$('.list_rate').css('height', 'unset');
	$('.list_rate').addClass('hidden');
	$.ajax({
		url: 'rate-detail',
		type: 'POST',
		data: {
			id_course:$id_course,
			_token:$_token
		},
		beforeSend: function() {
			$('.layout').removeClass('hidden');
        	$('.effect').removeClass('hidden');
    	},
		success:function (data) {
			$('.effect').addClass('hidden');
			$('.list_rate').html(data);
			$('.list_rate').removeClass('hidden');
		}
	})
});
// $('.layout').on('click', function(event) {
// 	$(this).addClass('hidden');
// });
$('.layer').on('click',function(event) {
	$('.modal_popup').addClass('hidden');
});
$('.layer').on('click',function(event) {
	$('.modal_popup_nav').addClass('hidden');
});
$('.layer').on('click',function(event) {
	$('.modal_popup_cmt').addClass('hidden');
});
$('.btn_modal').on('click', function(event) {
	$('.modal_popup').removeClass('hidden');
});
$('#title_forum').on('keyup', function(event) {
	$('#slug_forum').val(GetSlug($(this).val()));
});
function GetSlug(title) {
    var slug;
    slug = title.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    slug = '@' + slug + '@';
    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    if (slug.length>255) {
    	slug=slug.slice(0, 254);
    }
    return slug;
}
$('.input_item').on('focus', function(event) {
	if ($(this).val()=='') {
		$(this).parent().addClass('focus');
		$(this).parent().parent().addClass('focus');
	}
	
	console.log(Math.random());
});
$('.input_item').on('blur', function(event) {
	
	if ($(this).val()=='') {
		$(this).parent().removeClass('focus');
		$(this).parent().parent().removeClass('focus');
	}
});
$('.btn_react').on('click', function(event) {
	$id_post = $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	$.ajax({
		url: 'react',
		type: 'POST',
		data: {_token:$_token,
		id_post:$id_post},
		success: function (data) {
			var rs = data.split("[");
			$('.btn_react').html(rs[0]);
			$('.seft_react').text(rs[1]);
		}
	})
	
});
$('.form_reply .btn_reply_cmt').on('click', function(event) {
	$id_cmt= $(this).attr('data-cmt');
	$id_forum= $(this).attr('data-id');
	$id_auth_rec= $(this).attr('data-auth');
	$link_url= window.location.href;
	$check_url = $link_url.indexOf("#");
	if ($check_url!=-1) {
		$link_url= $link_url.slice(0,$check_url);
	}
	$title_web= $('#title_web').val();
	$_token = $('input[name="_token"]').val();
	$reply_cmt= $('#reply_cmt_'+$id_cmt).val();
	$tag_name=$('#tag_name_'+$id_cmt).text();
	if($reply_cmt) {
		$.ajax({
			url: 'reply-cmt',
			type: 'POST',
			data: {
				reply_cmt:$reply_cmt,
				id_forum:$id_forum,
				id_cmt:$id_cmt,
				id_auth_rec:$id_auth_rec,
				link_url:$link_url,
				title_web:$title_web,
				tag_name:$tag_name,
				cmt_forum:$cmt_forum,
				_token:$_token},
			success:function (data) {
				
				location.reload();
				// alert(data);
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		})
	}
});
// function CovertTime(time) {
// 	moment().format("MMM Do YY");   
// 	let tmp = time.slice(0, 10);
// 	// let tmp1= tmp.split('-');
// 	// let rs = '';
// 	// for (var i = 0; i < tmp1.length; i++) {
// 	// 	rs+=tmp1[i];
// 	// }
// 	// console.log("day la ngayf:"+ tmp);
// 	console.log(tmp);
// 	return moment(tmp).fromNow()
// 	// return moment(tmp).fromNow();
	
// }
// $.each($('.getTime'), function(index, val) {
// 	console.log($(this).text());
// 	 $(this).html(CovertTime($(this).text()));
	
// });

$('#cmt_forum').on('click', function(event) {
	$id_auth_rec= $(this).attr('data-auth');
	$link_url= window.location.href;
	$cmt = $('#cmt_input').val();
	$id_forum = $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	if($cmt) {
		$.ajax({
			url: 'cmt-forum',
			type: 'POST',
			data: {
				link_url:$link_url,
				id_auth_rec:$id_auth_rec,
				cmt:$cmt,
				id_forum:$id_forum,
				_token:$_token},
			success:function (data) {
				location.reload();
			},
			error:function (jqXHR, textStatus, errorThrown) {
				console.log(errorThrown);
			}
		})
	}
});
const parseUrl = (string, prop) =>  {
  const a = document.createElement('a'); 
  a.setAttribute('href', string);
  const {host, hostname, pathname, port, protocol, search, hash} = a;
  const origin = `${protocol}//${hostname}${port.length ? `:${port}`:''}`;
  return prop ? eval(prop) : {origin, host, hostname, pathname, port, protocol, search, hash}
}
$('.link_user').on('mouseenter', function(event) {
	$id_user= $(this).attr('username');
	$_token = $('input[name="_token"]').val();
	$link_url= $(this).attr('href');
	$status= $(this).attr('status');
	$alo= $(this);
	console.log($status);
	if (!isNaN($id_user)) {
		if ($status=='false') {
			$.ajax({
				url: parseUrl($link_url,'origin')+'/codehero/get-profile',
				type: 'POST',
				data: {
					id_user:$id_user,
					_token:$_token},
				success:function (data) {
					$alo.children('.user_name').html(data);
					$alo.children('.user_name').show();
				},
				error:function (jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			})
		}else{
			$(this).children().show();
		}
	}
});
$('.link_user').on('mouseenter', function(event) {
	$id_user= $(this).attr('username');
	$_token = $('input[name="_token"]').val();
	$link_url= $(this).attr('href');
	$status= $(this).attr('status');
	$alo= $(this);
	console.log($status);
	if (!isNaN($id_user)) {
		if ($status=='false') {
			$.ajax({
				url: parseUrl($link_url,'origin')+'/codehero/get-profile',
				type: 'POST',
				data: {
					id_user:$id_user,
					_token:$_token},
				success:function (data) {
					$alo.children('.user_name').html(data);
					$alo.children('.user_name').show();
				},
				error:function (jqXHR, textStatus, errorThrown) {
					console.log(errorThrown);
				}
			})
		}else{
			$(this).children().show();
		}
	}
});
$('.link_user').on('mouseleave', function(event) {
	$alo= $(this);
	$alo.attr('status','true');
	$alo.children('.user_name').hide();
});
$cmt_forum='';
$('.btn_reply').on('click', function(event) {
	$id_cmt = $(this).attr('data-id');
	$id_cmt0 = $(this).attr('data-id-0');
	$name_cmt = $(this).attr('data-name');
	console.log($name_cmt);
	$('.form_reply').hide();
	$cmt_forum = ($('#cmt_forum_'+$id_cmt).html()).trim();
	console.log('#cmt_forum_'+$id_cmt);
	console.log($cmt_forum);
	$('#form_reply_'+$id_cmt0).show(0);
	// $('#form_reply_'+$id_cmt +'input').val('@'+$name_cmt);
	$('#tag_name_'+$id_cmt0).text($name_cmt);
});
//nope
var title=document.title;
$('.del_cmt').on('click', function(event) {
	event.preventDefault();
	$rs = confirm("Bạn có chắc muốn xóa bình luận này không?");
	$id_cmt = $(this).attr('data-id');
	$_token = $('input[name="_token"]').val();
	if ($rs) {
		$.ajax({
			url: 'delete-cmt-forum',
			type: 'POST',
			data: {id_cmt: $id_cmt,_token:$_token},
			success:function (data) {
				// alert(data);
				console.log(data);
				location.reload();
			}
		})
	}
});
AOS.init({
	easing: 'ease-out-back',
	duration: 2000,
	delay: 0,
	once: true,
	disable: 'mobile'
 });


var cate = (window.location.pathname.split("/")[2]);
console.log(cate);
		switch(cate) {
			case "blog":
				$('.header_link').removeClass('border-bt');
				$('.header_link:eq(3)').addClass('border-bt');
				break;
			case "document":
				$('.header_link').removeClass('border-bt');
				$('.header_link:eq(1)').addClass('border-bt');
				break;
			case "course":
				$('.header_link').removeClass('border-bt');
				$('.header_link:eq(0)').addClass('border-bt');
				break;
			case "forum":
				$('.header_link').removeClass('border-bt');
				$('.header_link:eq(2)').addClass('border-bt');
				break;
			default: 
				$('.header_link').removeClass('border-bt');
				break;
		}

$('#see_more').on('click', function(event) {
	event.preventDefault();
	$row_curr = Number($('#row_curr').val());
	$_token = $('input[name="_token"]').val();
	
	$.ajax({
		url: 'forum/see-more',
		type: 'POST',
		data: {row_curr: $row_curr,_token:$_token},
		beforeSend: function() {
			$('#see_more').text("Loading...");
    		},
		success:function (data) {
			if (data=='done') {
				$('#see_more').parent().hide();
			}else{
			$('#row_curr').val($row_curr+5);
			$('.list_blog').append(data);
			$('#see_more').text("Xem thêm");
			}
		}
	})
	
});
$("a[href*='#']:not([href='#])").click(function() {
  let target = $(this).attr("href");
  $('html,body').stop().animate({
    scrollTop: $(target).offset().top
  }, 1000);
  event.preventDefault();
});
// $(document).keydown(function(event){
//     if(event.keyCode==123){
//         return false;
//     }
//     else if (event.ctrlKey && event.shiftKey && event.keyCode==73){        
//              return false;
//     }
// });

// $(document).on("contextmenu",function(e){        
//    e.preventDefault();
// });
$('.edit_cmt').on('click', function(event) {
	event.preventDefault();
	$id = $(this).attr('data-id');
	console.log('#cmt_forum_'+$id);
	$('.modal_popup_cmt').removeClass('hidden');
	$content= $('#cmt_forum_'+$id).text();
	$content= $content.trim();
	console.log($content);
	$('.modal_popup_cmt .text_edit input').val('');
	$('.modal_popup_cmt .text_edit input').val($content);
	
});
if (localStorage.getItem("index")==null) {
	localStorage.setItem("index", 0);
}
let index = localStorage.getItem("index")-1;
$('.item_document').on('click', function(event) {
	event.preventDefault();
	$('.item_document').removeClass('border_active');
	$(this).addClass('border_active');
	$id_cate= $(this).attr('data-id');
	localStorage.setItem("index", $id_cate);
	$('#data_document').html();
	$.ajax({
		url: 'document/get-doc',
		data: {id_cate: $id_cate},
		beforeSend: function() {
			$('.effect').removeClass('hidden');
		},
		success:function (data) {
			$('.effect').addClass('hidden');
			$('#data_document').html(data);
		}
	})
});
$('.item_document:eq('+index+')').click();
$('body').on('click','.view_doc', function(event) {
	// event.preventDefault();
	$('.modal_popup_cmt').removeClass('hidden');
	$content= $(this).children('input').val();
	$('.text_edit').text($content);
	$('.heading_doc').text($(this).attr('data_head'));

	console.log($content);
});
$('.header_item_mobile').on('click', function(event) {
	// event.preventDefault();
	$(this).children('.course_cate_mobile').slideToggle(400);
});
$('.btn_nav').on('click', function(event) {
	// event.preventDefault();
	$('.modal_popup_nav').toggleClass('hidden');
});
$('.container').on('click', function(event) {
	// event.preventDefault();
	$('.div_notify').hide();
});

$('.btn_change').on('click', function(event) {

	$(this).toggleClass('active');
	$('.form_change').toggleClass('hidden');
});