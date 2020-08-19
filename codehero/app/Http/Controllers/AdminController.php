<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Session;
use App\Http\Requests;
use App\Admin;
use App\Comment;
use App\Forum;
use App\Blog;
use App\Course;
use Carbon\Carbon;
 use Socialite;
use Illuminate\Support\Facades\Redirect;
session_start();
class AdminController extends Controller
{
    public function redirect($provider)
     {
         return Socialite::driver($provider)->redirect();
     }
     public function callback($provider)
     {
       $getInfo = Socialite::driver($provider)->user(); 
       $user = $this->createUser($getInfo,$provider); 
       auth()->login($user); 
       var_dump($user);
       // return redirect()->to('/');
     }
     function createUser($getInfo,$provider){
     $data = User::where('provider_id', $getInfo->id)->first();
     if (!$data) {
        $data = new Admin;
        $data->user=rand(0,999999);
        $data->password=rand(0,999999);
        $data->displayname=$getInfo->name;
        $data->email=$getInfo->email;
        $data->provider=$provider;
        $data->provider_id=$getInfo->id;
        $data->status=0;
        $data->accessright=2;
        $data->coin=0;
        $data->phone=0;
        $data->avatar=0;
        $data->avatar=0;
        $data->cover_img=0;
        $data->save();
       }
       return $data;
     }
    public function check_login(Request $req)
    {
    	$user = $req->user;
    	$password = md5($req->pass);
    	$rs = DB::table('accounts')->where('user',$user)->where('password',$password)->first();
    	if ($rs) {
    		Session::put("id",$rs->id);
            Session::put("lv",$rs->accessright);
    		Session::put("name",$rs->displayname);
            Session::put("img",$rs->avatar);
            Session::put("coin",$rs->coin);
    		echo "<script>location.reload();</script>";
    	}else{
    		echo "Thông tin tài khoản hoặc mật khẩu không chính xác, vui lòng thử lại sau";
    	}
    }
    public function get_profile(Request $req)
    {
        $data = Admin::find($req->get('id_user'))->toArray();
        $data_cmt = Comment::where('id_auth',$req->get('id_user'))->count();
        $data_post = Forum::where('auth_post',$req->get('id_user'))->count();
        $html='';
        $date= substr($data['created_at'],0, 10);
        $html.='
            <div class="info_user">
                <div class="bg_cover" style="background:url(http://'.$_SERVER['SERVER_NAME'].'/'.dirname($_SERVER['PHP_SELF']).'/'.$data['cover_img'].');background-size: cover;background-repeat: no-repeat;background-position: center;">
                <img class="img_cover" src="http://'.$_SERVER['SERVER_NAME'].'/'.dirname($_SERVER['PHP_SELF']).'/'.$data['avatar'].'">
                <p class="join_time">'.$data['displayname'].'</p>
                </div>
                <div class="info_post">
                    
                    <p>Đã tham gia :'.$date.'</p>
                    
                    <p>Bài viết :'.$data_post.'
                    </p>
                    <p>Bình luận : '.$data_cmt.'</p>
                </div>
            </div>
        ';
        echo $html;
    }
    public function check_reg(Request $req)
    {
        $user = $req->reg_user;
        $displayname = $req->reg_name;
        // $email = $req->email;
        $password = md5($req->reg_pass);
        $data = Admin::where('user',$user)->get()->toArray();
        if ($data) {
            echo "Tên tài khoản bị trùng, vui lòng thử lại với tên khác";
        }else{
            $data = new Admin;
            $data->user=$user;
            $data->password=$password;
            $data->status=0;
            $data->phone=0;
            $data->email="zero";
            $data->accessright=3;
            $data->coin=0;
            $data->displayname=$displayname;
            $name_avatar= '/public/images/anime'.rand(1,11).'.jpg';
            $data->avatar= $name_avatar;
            $data->save();
            echo "Đăng kí thành công";
          
        }
    }
    public function dashboard()
    {

        $date = Carbon::now();
        $date->toArray();

        $day_curr= $date->day;
        $month_curr= $date->month;
        $year_curr= $date->year;
        $account= Admin::all()->count();
        $course= Course::all()->count();
        $forum= Forum::all()->count();
        $blog= Blog::all()->count();
        $coin_month =DB::table('account_course')->whereRaw('MONTH(created_at) = ?',$month_curr)->get()->sum('coin');
        $coin_day =DB::table('account_course')->whereRaw('DAY(created_at) = ?',$day_curr)->get()->sum('coin');
        $coin_year =DB::table('account_course')->whereRaw('YEAR(created_at) = ?',$year_curr)->get()->sum('coin');
        $test =DB::table('account_course')->whereRaw('YEAR(created_at) = ?',$year_curr)->get();

        $total=array(
            '0'=>$coin_month,
            '1'=>$coin_day,
            '2'=>$coin_year
        );
        $arr=[
            'blog'=>$blog,
            'forum'=>$forum,
            'course'=>$course,
            'account'=>$account,
            'coin'=>$coin_year,
            'total'=>$total,
            'test'=>$test
        ];
    	return view("admin.dashboard",$arr);
    }
}
