@extends('admin_home')
@section('admin_content')
<br>

<div class="row">
	<div class="col col-md-3">
		<div class="alert-info alert">
			<span class="count">{{$account}}</span>
			<p class="title_count">Người dùng</p>
		</div>
	</div>
	<div class="col col-md-3">
		<div class="alert-warning alert">
			<span class="count">{{$blog}}</span>
			<p class="title_count">Chia sẻ</p>
		</div>
	</div>
	<div class="col col-md-3">
		<div class="alert-success alert">
			<span class="count">{{$course}}</span>
			<p class="title_count">Khóa học</p>
		</div>
	</div>
	<div class="col col-md-3">
		<div class="alert alert-danger">
			<span class="count">{{$forum}}</span>
			<p class="title_count">Bài viết</p>
		</div>
	</div>
	{{-- <p>Tổng số coin trong ngày này :{{$coin_day}}</p>
	<p>ngày hôm nay {{$coin_day}}</p>
	<p>tháng hôm nay {{$coin_month}}</p> --}}
	{{-- <p>nam hôm nay {{$coin}}</p> --}}
	<?php
	$size= count($total);
	$str_v='';
	for($i=0; $i<$size; $i++) { 
		$str_v.=$total[$i]."-";
	}
	?>
	<div>.</div>
	<div id="container" data-order="{{$str_v}}"></div>

	{{-- <div id="container" data-order="{{$test}}"></div> --}}
</div>
<script type="text/javascript">
	$(document).ready(function(){
    var order0 = $('#container').data('order');
    var order= order0.split('-', 3);
    var listOfValue = [];
    var listOfYear = ['Hôm nay','Tháng nay','Năm nay'];
    order.forEach(function(element){
    	var n = parseInt(element)*1000;
        listOfValue.push(n);
    });
    console.log(listOfValue);
   
    var chart = Highcharts.chart('container', {

        title: {
            text: 'Tổng số tiền'
        },

        subtitle: {
            text: 'VND'
        },

        xAxis: {
            categories: listOfYear,
        },

        series: [{
            type: 'column',
            colorByPoint: true,
            data: listOfValue,
            showInLegend: false
        }]
    });
    
    $('#plain').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: false
            },
            subtitle: {
                text: 'Plain'
            }
        });
    });

    $('#inverted').click(function () {
        chart.update({
            chart: {
                inverted: true,
                polar: false
            },
            subtitle: {
                text: 'Inverted'
            }
        });
    });

    $('#polar').click(function () {
        chart.update({
            chart: {
                inverted: false,
                polar: true
            },
            subtitle: {
                text: 'Polar'
            }
        });
    });
});


</script>
@endsection