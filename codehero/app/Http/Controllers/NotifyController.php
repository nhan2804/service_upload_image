<?php

namespace App\Http\Controllers;
use Session;
use App\Notification;
use DB;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Admin;
class NotifyController extends Controller
{
    public function notify()
    {
    	$id_user= Session::get('id');
    	if ($id_user) {
    		$unread= DB::table('notify')->where('status_notify',0)->where('id_rec',$id_user)->count();
    		echo ($unread);
    	} 
    }
    public function list_notify()
    {
    	$html='
    <li class="item_notify" style="height:30px;background: #CBD3D7">MỚI</li>
        ';
    	$id_user= Session::get('id');
          
    	if ($id_user) {
    		$notify= DB::table('accounts')->join('notify','notify.id_rec','=','accounts.id')->where('notify.id_rec',$id_user)->orderBy('id_notify', 'desc')->skip(0)->take(10)->get();
    			foreach($notify as $key=>$value){
                    $user_send= Admin::where('id',$value->id_send)->first();
                    $url_img = asset($user_send->avatar);
    		            if($value->status_notify==1){
    		            $html.= '
    		            <li class="item_notify" data-id="'.$value->id_notify.'" data-stt="'.$value->status_notify.'" >
                        <img alt="" class="img_user_notify" src="'.$url_img.'">
    		            <a class="link_notify" href="'.$value->link_notify.'"><span class="name_user_notify">'.$user_send->user .'</span><span class="content_notify"> '.$value->content_notify.'</span>
                        <div style="font-size:0.8rem">'.Carbon::parse($value->created_at)->diffForHumans().'</div>
                        </a>
    		            
    		            </li>';
    		        	}
    		            else{
    		            	$html.= '
                            <li class="item_notify" data-id="'.$value->id_notify.'" data-stt="'.$value->status_notify.'" style="background: #edf2fa">
                        <img alt="" class="img_user_notify" src="'.$url_img.'">
                        <a class="link_notify" href="'.$value->link_notify.'"><span class="name_user_notify">'.$user_send->user .'</span><span class="content_notify"> '.$value->content_notify.'</span>
                        <div style="font-size:0.8rem">'.Carbon::parse($value->created_at)->diffForHumans().'</div>
                        </a>
                        
                        </li>';
    		        		}
	        }

	        echo $html;
           
            // echo $now.'=='.$last;
            // echo $notify;
    	}
	}
	public function set_notify(Request $req)
    {
    	$id_notify = $req->id_notify;
    	Notification::where('id_notify',$id_notify)->update(['status_notify'=>'1']);
    	echo "ok";
    }
}
