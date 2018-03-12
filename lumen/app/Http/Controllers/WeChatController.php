<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;


class WeChatController extends Controller
{

  protected $appid;
  protected $appsecret;
  public $openid;

    public function __construct()
    {
      parent::__construct();
    }


    public function index(Request $request){
      $this->appid=config('wx_base.app_id');
      $this->appsecret=config('wx_base.secret');
      $code = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$this->appid.
   "&secret=".$this->appsecret."&code=".$request->input('code')."&grant_type=authorization_code";
      $rescode = json_decode( $this->curls($code) );dd($rescode);die;
      $this->openid = $rescode->openid;
      $token = "https://api.weixin.qq.com/sns/userinfo?access_token=".$rescode->access_token."&openid=".$rescode->openid."&lang=zh_CN";
      $res = json_decode( $this->curls($token) );
      dd($res);
    }

    public function notify(){
      dd('1234');
    }

    public function author(Request $request,$id){dd($id);
      $this->appid=config('wechat.wx_base.app_id');
      $this->appsecret=config('wechat.wx_base.secret');
      $callback = config('wechat.oauth.callback');
      if($request->isMethod('get'))
      {
        $url = "https://open.weixin.qq.com/connect/oauth2/authorize?appid=".$this->appid."&redirect_uri=".$callback."&response_type=code&scope=snsapi_userinfo&state=1#wechat_redirect";
        return $this->curls($url);
      }


    }


}

