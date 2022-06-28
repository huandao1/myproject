<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class CheckAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        //oR6kb1Y4lE2Rg-FsNvtX_ebSfyRE
        if(empty(session('openid'))){
            //session(['AccessToken' => "42_i_7x8IS4zSzyw0DYwpAMk-0L7ylKgIq0ujGJRHsHNhohNhfZbXNX6FbABkbcLnRw1RRC-HT6Lyne8XZ0zhW8vw"]);
            session(['openid' => 'oR6kb1Y4lE2Rg-FsNvtX_ebSfyRE']);
            session(['headimgurl' =>  "https://thirdwx.qlogo.cn/mmopen/vi_32/Q0j4TwGTfTJY65kJ94nUMkic2j2PvuSLOlVCicna14tRQe5ZUw0ueaibayaZoqYQqePEZt1KHQm9jkH3YvMCaKxdw/132"]);
        }
        /*if ($request->filled('code')) {
            $code = $request->input('code');
            $url = read_config("wx_url") . "sns/oauth2/access_token?appid=" . read_config("wxAppId") . "&secret=" . read_config("wxAppSecret") . "&code=$code&grant_type=authorization_code";
            $jsonstr = curl_request($url);
            $data = json_decode($jsonstr, true);
            $access_token = $data['access_token'];
            $openid = $data['openid'];

            $url2 = read_config("wx_url") . "sns/userinfo?access_token=$access_token&openid=$openid";
            $jsonstr2 = curl_request($url2);
            $data2 = json_decode($jsonstr2, true);
            $headimgurl = $data2['headimgurl'];
            session(['AccessToken' => $access_token]);
            session(['openid' => $openid]);
            session(['headimgurl' => $headimgurl]);
            session(['citycode'=>440600]);
        }

        if(empty(session('openid'))){
            $redirect_url=url()->full();
            return redirect(read_config("wx_auth") . "connect/oauth2/authorize?appid=" . read_config("wxAppId") . '&redirect_uri=' . $redirect_url . "&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect");
        }*/
        $openid=session('openid');
        $num = DB::table('potong')->where('openid',$openid)->count('id');
        if($num > 0){
            $base_data = DB::table('potong')->select('phone','accesstoken', 'addtime')->where('openid',$openid)->latest('addtime')->limit(1)->first();
            $time=time();
            $hour=($time-$base_data->addtime)/3600;

            session(['AccessToken' => $base_data->accesstoken,'phone'=>$base_data->phone]);
        }

        else if(empty(session('AccessToken'))){
            return redirect("login_sms");
        }
        return $next($request);
    }
}
