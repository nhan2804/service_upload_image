<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CateCourse;
use File;
use App\Document;
use App\Document_Cate;
class DocumentController extends Controller
{
    public function index()
   {
   	$cate_doc = Document_Cate::all();
   	return view('page.document')->with('cate_doc',$cate_doc);
   }
   public function get_doc(Request $req)
   {
   	$data = Document::where('id_cate',$req->id_cate)->get();
   	$html='';
   	if (count($data)) {
   	foreach ($data as $key => $value) {
   		$desc=$value->desc_doc;
   		if (strlen($desc)>90) {
   			$desc= substr($value->desc_doc, 0,90).' ...';
   		}
   		$url = asset('public'.$value->file_doc);
   		// $link= {{asset('public'.$value->file_doc.)}};
   		$html.='
   		<div class="col-lg-4 col-md-6 col-6 col-sm-6">
  			<div class="item_doc p-3">
	  			<div class="file_name pb-0">
	  				<i style="font-size:4em;color:'.$this->getFileColor($value->file_doc).'" class="fas fa-file-'.$this->getFileType($value->file_doc).'"></i>
	  				<h3>'.$value->name_doc.'</h3>
	  			</div>
  				<p>'.$desc.'</p>
  				<div class="info_doc">
  					<a data_head="'.$value->name_doc.'" class="view_doc btn_hover" href="#">Xem chi tiết <i class="fas fa-chevron-right btn_doc"></i>
  					<input type="hidden" value="'.$value->desc_doc.'"/>
  					</a>
  					
  					 <a class="btn_hover" href="'.$url.'" >Tải xuống <i class="fas fa-chevron-down btn_doc"></i></a>
  				</div>
  				
  			</div>
  			<br>
  		</div>';
   	}
   	// <a class="btn_hover" href="{{asset(public'.$value->file_doc.')}}" >Tải xuống</a>
   	
   	// <a class="btn_hover" href="http://localhost/codehero/public'.$value->file_doc.'">Tải xuống</a>
   	echo $html;
}else{
	echo "Hiện không có tài liệu nào thuộc mục này, vui lòng quay lại sau!";
   }
}

   public function add_docs()
   {
   	$cate_doc = Document_Cate::all();
   	return view('admin.documents')->with('cate_doc',$cate_doc);
   }
   public function insert_docs(Request $req)
   {
   	if($req->hasFile('file'))
    	{
    		$data = new Document;
    		// $data->id_cate=0;
    		$data->desc_doc=$req->content_doc;
    		$data->name_doc=$req->name_doc;
    		$data->id_cate= $req->id_cate;
    		$imageFile = $req->file('file');
    		$imageName = '/upload/'.time().'-'.$imageFile->getClientOriginalName();
    		$data->file_doc=$imageName;
    		$imageFile->move(public_path('upload'), $imageName);
    		$data->save();
    		return back()->with('success_up','Up file thành công');
    	}
   }
   public function insert_cate(Request $req)
   {
   	$data = new Document_Cate;
   	$data->name_cate= $req->name_cate;
   	$data->id_parent= 0;
   	$data->save();
   	return back();

   }
   function getFileType(string $url):string{
    $filename=explode('.',$url);
    $extension=end($filename);
    switch($extension){
        case 'pdf':
            $type=$extension;
            break;
        case 'docx':
        case 'doc':
            $type='word';
            break;
        case 'xls':
        case 'xlsx':
            $type='excel';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='audio';
            break;
        case 'mp4':
        case 'mov':
            $type='video';
            break;
        case 'zip':
        case '7z':
        case 'rar':
            $type='archive';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
            $type='image';
            break;
        default:
            $type='alt';
    }

    return $type;
}
function getFileColor(string $url):string{
    $filename=explode('.',$url);
    $extension=end($filename);
    switch($extension){
        case 'pdf':
            $type='#da1113';
            break;
        case 'docx':
        case 'doc':
            $type='#D9D6DA';
            break;
        case 'xls':
        case 'xlsx':
            $type='#016f38';
            break;
        case 'mp3':
        case 'ogg':
        case 'wav':
            $type='#1080c7';
            break;
        case 'mp4':
        case 'mov':
            $type='#7ed8e7';
            break;
        case 'zip':
        case '7z':
        case 'rar':
            $type='#de8f10';
            break;
        case 'jpg':
        case 'jpeg':
        case 'png':
            $type='black';
            break;
        default:
            $type='#ccc';
    }

    return $type;
}
}
