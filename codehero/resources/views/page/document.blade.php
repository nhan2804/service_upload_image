@extends('welcome')
@section('title',"Tài liệu")
@section('content')
<br>
<br>
<br>
<div class="modal_popup_cmt hidden">
    <div class="layer"></div>
    <div class="popup_edit popup_doc">
       	<div>
       		<h3 class="heading_doc"></h3>
       	</div>
       	<div class="text_edit">
       		
       	</div>
    </div>
</div>
    
<div class="hide-on-table-and-moblie">
  <img src="{{asset('public/images/doc.png')}}" alt="" style="width: 100%">
</div>
<br>
<div class="container">
	<div class="row">
  	<div class="col-lg-3 col-md-4 col-sm-12">
  		<div class="cate_document">
  			<h3>Danh mục tài liệu</h3>
  			<ul class="list_document">
  				@foreach($cate_doc as $k=>$v)
  					<li class="item_document" data-id='{{$v->id_cate}}'>{{$v->name_cate}}</li>
		  		@endforeach
  			</ul>
  		</div>
      <br>
  	</div>

  	<div class="col-lg-9 col-md-8 col-sm-12">
  		<div style="position: absolute;top: 50%;z-index: 99999999;transform: translateY(-50%);" class="effect hidden custom">
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		 	<div class="loading"></div>
		</div>
  		<div id="data_document" class="row">
  			
  		</div>
  	</div>
  	</div>
</div>
{{-- <img alt="" scr="http://localhost/codehero/public/images/document.png" style="width:100%"> --}}
{{-- <img src="http://localhost/codehero/public/images/document.png" alt=""> --}}
@endsection