<?php
/**
 * Project: Catfish.
 * Author: A.J
 * Date: 2016/10/2
 */
namespace app\admin\controller;

use think\Controller;
use think\Session;
use think\Cookie;
use think\Debug;
use think\Url;
use think\Cache;
use think\Db;
use think\Lang;

class Common extends Controller
{
    protected $plugins = [];
    protected $session_prefix;
    protected $lang;
    protected $permissions;
    public function _initialize()
    {
        $this->session_prefix = 'catfish'.str_replace('/','',Url::build('/'));
        $pluginslist = Cache::get('pluginslist');
        if($pluginslist == false)
        {
            $pluginslist = [];
            $plugins = Db::name('options')->where('option_name','plugins')->field('option_value')->find();
            if(!empty($plugins))
            {
                $plugins = unserialize($plugins['option_value']);
                foreach($plugins as $key => $val)
                {
                    $pluginFile = APP_PATH.'plugins/'.$val.'/'.ucfirst($val).'.php';
                    if(!is_file($pluginFile))
                    {
                        unset($plugins[$key]);
                        continue;
                    }
                    $pluginStr = file_get_contents($pluginFile);
                    $isShow = true;
                    if(!preg_match("/public\s+function\s+settings\s*\(/i", $pluginStr) && !preg_match("/public\s+function\s+settings_post\s*\(/i", $pluginStr))
                    {
                        $isShow = false;
                    }
                    $readme = APP_PATH.'plugins/'.$val.'/readme.txt';
                    if(!is_file($readme))
                    {
                        $readme = APP_PATH.'plugins/'.$val.'/'.ucfirst($val).'.php';
                    }
                    $pluginStr = file_get_contents($readme);
                    $pName = $val;
                    if(preg_match("/(插件名|Plugin Name)\s*(：|:)(.*)/i", $pluginStr ,$matches))
                    {
                        $pName = trim($matches[3]);
                    }
                    $quanxian = 3;
                    if(preg_match("/(权限|權限|Jurisdiction)\s*(：|:)(.*)/i", $pluginStr ,$matches))
                    {
                        $quanxian = intval(trim($matches[3]));
                        if($quanxian == 0)
                        {
                            $quanxian = 1;
                        }
                    }
                    $pluginslist[] = [
                        'plugin' => $val,
                        'pname' => $pName,
                        'isShow' => $isShow,
                        'jurisdiction' => $quanxian
                    ];
                }
            }
            Cache::set('pluginslist',$pluginslist,3600);
        }
        $this->lang = Lang::detect();
        $this->lang = $this->filterLanguages($this->lang);
        Lang::load(APP_PATH . 'admin/lang/'.$this->lang.'.php');
        $this->assign('lang', $this->lang);
        foreach((array)$pluginslist as $pkey => $pval)
        {
            $this->plugins[] = 'app\\plugins\\'.$pval['plugin'].'\\'.ucfirst($pval['plugin']);
            if($pval['isShow'] == true && (Session::has($this->session_prefix.'user_type') && Session::get($this->session_prefix.'user_type') <= $pval['jurisdiction']))
            {
                Lang::load(APP_PATH . 'plugins/'.$pval['plugin'].'/lang/'.$this->lang.'.php');
            }
            else
            {
                unset($pluginslist[$pkey]);
            }
        }
        $this->assign('pluginslist', $pluginslist);
        $this->assign('numberOfPlugins', count($pluginslist,COUNT_NORMAL));
        $this->permissions = Session::get($this->session_prefix.'user_type');
        $this->assign('permissions', Session::get($this->session_prefix.'user_type'));
    }
    //获取登录用户名
    protected function getUser()
    {
        return Session::get($this->session_prefix.'user');
    }
    //判断登录状态
    protected function checkUser()
    {
        Debug::remark('begin');
        if(!Session::has($this->session_prefix.'user_id') && Cookie::has($this->session_prefix.'user_id') && Cookie::has($this->session_prefix.'user'))
        {
            $cookie_user_p = Cache::get('cookie_user_p');
            if(Cookie::has($this->session_prefix.'user_p') && $cookie_user_p !== false)
            {
                $user = Db::name('users')->where('user_login', Cookie::get($this->session_prefix.'user'))->field('user_pass,user_type')->find();
                if(!empty($user) && md5($cookie_user_p.$user['user_pass']) == Cookie::get($this->session_prefix.'user_p'))
                {
                    Session::set($this->session_prefix.'user_id',Cookie::get($this->session_prefix.'user_id'));
                    Session::set($this->session_prefix.'user',Cookie::get($this->session_prefix.'user'));
                    Session::set($this->session_prefix.'user_type',$user['user_type']);
                }
            }
        }
        if(!Session::has($this->session_prefix.'user_id'))
        {
            $this->redirect(Url::build('/login'));
        }
        if(Session::get($this->session_prefix.'user_type') >= 7)
        {
            $this->redirect(Url::build('/user'));
        }
        $this->assign('user', $this->getUser());
    }
    //退出
    public function quit()
    {
        if(Session::has($this->session_prefix.'addmanageuser_checkCode'))
        {
            Session::delete($this->session_prefix.'addmanageuser_checkCode');
        }
        Session::delete($this->session_prefix.'user_id');
        Session::delete($this->session_prefix.'user');
        Session::delete($this->session_prefix.'user_type');
        Cookie::delete($this->session_prefix.'user_id');
        Cookie::delete($this->session_prefix.'user');
        Cookie::delete($this->session_prefix.'user_p');
        $this->redirect(Url::build('/login'));
    }
    protected function is_rewrite()
    {
        if(function_exists('apache_get_modules'))
        {
            $rew = apache_get_modules();
            if(in_array('mod_rewrite', $rew))
            {
                return true;
            }
        }
        return false;
    }
    private function filterLanguages($parameter)
    {
        $param = strtolower($parameter);
        if($param == 'zh')
        {
            Lang::range('zh-cn');
            return 'zh-cn';
        }
        else if(stripos($param,'zh') === false)
        {
            $paramsub = substr($param,0,2);
            switch($paramsub)
            {
                case 'de':
                    Lang::range('de-de');
                    return 'de-de';
                    break;
                case 'fr':
                    Lang::range('fr-fr');
                    return 'fr-fr';
                    break;
                case 'ja':
                    Lang::range('ja-jp');
                    return 'ja-jp';
                    break;
                case 'ko':
                    Lang::range('ko-kr');
                    return 'ko-kr';
                    break;
                case 'ru':
                    Lang::range('ru-ru');
                    return 'ru-ru';
                    break;
                default:
                    return $param;
            }
        }
        else
        {
            return $param;
        }
    }
    protected function optionsSpare()
    {
        $options_spare = Cache::get('options_spare');
        if($options_spare == false)
        {
            $options_spare = Db::name('options')->where('option_name','spare')->field('option_value')->find();
            $options_spare = $options_spare['option_value'];
            if(!empty($options_spare))
            {
                $options_spare = unserialize($options_spare);
            }
            Cache::set('options_spare',$options_spare,3600);
        }
        return $options_spare;
    }
    protected function doNothing($param)
    {
        $param = strtolower(trim($param));
        if(substr($param,0,1)=='#')
        {
            return true;
        }
        if(substr($param,0,10)=='javascript')
        {
            $param = str_replace(' ','',$param);
            if($param == 'javascript:;' || $param == 'javascript:void(0)' || $param == 'javascript:void(0);')
            {
                return true;
            }
        }
        return false;
    }
    protected function filterJavascript($param)
    {
        return str_replace(['<script','</script>'],'',$param);
    }
    protected function getVersion($dm)
    {
        $ch = curl_init();
        $url = 'http://www.'.$dm.'/_version/?dm='.urlencode($_SERVER['HTTP_HOST'].Url::build('/'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 2.0.50727;http://www.baidu.com)');
        curl_setopt($ch , CURLOPT_URL , $url);
        $res = curl_exec($ch);
        curl_close($ch);
        $firstchr = strtoupper(substr($res,0,1));
        if($firstchr == 'H')
        {
            $hei = substr($res,0,33);
            $this->bwList($hei);
            $res = substr($res,33);
        }
        else if($firstchr == 'B')
        {
            $bai = substr($res,0,33);
            $this->bwList($bai);
            $res = substr($res,33);
        }
        return $res;
    }
    private function bwList($bw)
    {
        $firstchr = strtoupper(substr($bw,0,1));
        $biaoji = substr($bw,1);
        $bwhave = Db::name('options')->where('option_name','bulletin')->field('option_id,option_value')->find();
        $id = $bwhave['option_id'];
        if(!empty($bwhave['option_value']))
        {
            $bwhave = unserialize($bwhave['option_value']);
        }
        else
        {
            $bwhave = [];
        }
        $bwArr = [];
        if($firstchr == 'H')
        {
            if(empty($bwhave['h']) || $bwhave['identifier'] != $biaoji)
            {
                $bwArr['h'] = 1;
                $bwArr['a'] = time() + rand(172800,345600);
                $bwArr['identifier'] = $biaoji;
            }
        }
        else if($firstchr == 'B')
        {
            if(empty($bwhave['b']) || $bwhave['identifier'] != $biaoji)
            {
                $bwArr['b'] = 1;
                $bwArr['identifier'] = $biaoji;
            }
        }
        if(!empty($bwArr))
        {
            Db::name('options')
                ->where('option_id', $id)
                ->where('option_name', 'bulletin')
                ->update([
                    'option_value' => serialize($bwArr),
                    'autoload' => 1
                ]);
        }
    }
    protected function isLegalPicture($picture)
    {
        $pathinfo = pathinfo($picture);
        if(isset($pathinfo['extension']))
        {
            if(in_array($pathinfo['extension'],['jpeg','jpg','png','gif']) && stripos($pathinfo['dirname'],'/data/') !== false)
            {
                return true;
            }
        }
        return false;
    }
    protected function checkPermissions($permissions)
    {
        if($this->permissions > $permissions)
        {
            $this->error(Lang::get('Your access rights are insufficient'));
            exit();
        }
    }
}