$('#substring').on('keyup', function(event) {
		let url = $(this).val();
		let n = url.indexOf("v=");
		let m= url.length+1;
		n+=2;
		let res = url.slice(n, m);
		let xz=0;
		xz= res.search("&");
		if (xz!=-1) {
			res=res.slice(0,xz);
		}
		let http= "https://www.youtube.com/embed/";
		$('#get_url').val(http+res);
});
		let current_url=window.location.href;
		console.log(current_url);
		let start=current_url.indexOf("admin/")+6;
		let end = current_url.indexOf('/',start+1);
		if (end==-1) {
			end = current_url.length;
		}
		let cate=current_url.slice(start,end);
		switch(cate) {
			case "blog":
				$('.menu li').removeClass('active');
				$('.menu li:nth-child(2)').addClass('active');
				break;
			case "dashboard":
				$('.menu li').removeClass('active');
				$('.menu li:nth-child(1)').addClass('active');
				break;
			case "course":
				$('.menu li').removeClass('active');
				$('.menu li:nth-child(4)').addClass('active');
				break;
			case "forum":
				$('.menu li').removeClass('active');
				$('.menu li:nth-child(3)').addClass('active');
				break;
				case "document":
				$('.menu li').removeClass('active');
				$('.menu li:nth-child(5)').addClass('active');
				break;
		}

$(".list input[type='checkbox']:eq(0)").on('change', function(event) {
        $(".list input[type=checkbox]").prop('checked', $(this).prop('checked'));
});
$('#del_blog').on('click', function(event) {

  $check= confirm("Bạn có chắc muốn xóa những bài này không, điều này không thể hoàn tác ?");
        if ($check) {
            $id=[];
            $_token = $('input[name="_token"]').val();
            $('.list input[type="checkbox"]:checkbox:checked').each(function(i) {
                $id[i]= $(this).val();
            });
            if ($id.length==0) {
                alert("Vui lòng chọn dòng cần xóa!");                
            }else {
                $.ajax({
                    url:'blog/del-blogs',
                    type: 'POST',
                    data: {
                        id : $id,
                        _token:$_token
                    },
                    success:function (data) {
                        location.reload();
                        // console.log(data);
                    },
                    error:function () {
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    }
                })
            }
        }else {
            $('.list input[type="checkbox"]').prop('checked', '');
            return false;
        }
  });
$('#access_blog').on('click', function(event) {
	$check= confirm("Bạn có chắc muốn duyệt tất cả bài viết này không ?");
        if ($check) {
            $id=[];
            $_token = $('input[name="_token"]').val();
            $('.list input[type="checkbox"]:checkbox:checked').each(function(i) {
                $id[i]= $(this).val();
            });
            console.log($id);
            if ($id.length==0) {
                alert("Vui lòng chọn ít nhất 1 bài!");                
            }else {
                $.ajax({
                    url:'blog/access-blogs',
                    type: 'POST',
                    data: {
                        id : $id,
                        _token:$_token
                    },
                    success:function (data) {
                        location.reload();
                        // console.log(data);
                    },
                    error:function () {
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    }
                })
            }
        }else {
            $('.list input[type="checkbox"]').prop('checked', '');
            return false;
        }
});
$('#deny_blog').on('click', function(event) {
	$check= confirm("Bạn có chắc muốn hủy duyệt tất cả bài viết này không ?");
        if ($check) {
            $id=[];
            $_token = $('input[name="_token"]').val();
            $('.list input[type="checkbox"]:checkbox:checked').each(function(i) {
                $id[i]= $(this).val();
            });
            console.log($id);
            if ($id.length==0) {
                alert("Vui lòng chọn ít nhất 1 bài!");                
            }else {
                $.ajax({
                    url:'blog/deny-blogs',
                    type: 'POST',
                    data: {
                        id : $id,
                        _token:$_token
                    },
                    success:function (data) {
                        location.reload();
                        // console.log(data);
                    },
                    error:function () {
                        alert("Có lỗi xảy ra, vui lòng thử lại");
                    }
                })
            }
        }else {
            $('.list input[type="checkbox"]').prop('checked', '');
            return false;
        }
});