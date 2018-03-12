<?php
/**
 * Project: Catfish.
 * Author: A.J
 * Date: 2016/10/1
 */
namespace app\admin\controller;

use app\admin\controller\Common;
use app\admin\controller\Tree;
use think\Db;
use think\Request;
use think\Validate;
use think\Session;
use think\Config;
use think\Debug;
use think\Cache;
use think\Hook;
use think\Url;
use think\Lang;

class Index extends Common
{
    //显示后台首页
    public function index()
    {
        $this->checkUser();
        $zxwenzhang = Db::name('posts')->where('post_type',0)->field('id,post_title')->order('post_modified desc')->limit(5)->select();
        $this->assign('zxwenzhang', $zxwenzhang);
        $zxpinglun = Db::name('comments')->field('id,url,content')->order('createtime desc')->limit(5)->select();
        $this->assign('zxpinglun', $zxpinglun);
        $zxliuyan = Db::name('guestbook')->field('id,msg')->order('createtime desc')->limit(5)->select();
        $this->assign('zxliuyan', $zxliuyan);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', '');
        return $this->view();
    }
    //添加分类
    public function addclassify()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        if(Request::instance()->has('fenleim','post'))
        {
            //验证输入内容
            $rule = [
                'fenleim' => 'require',
                'shangji' => 'require'
            ];
            $msg = [
                'fenleim.require' => Lang::get('The category name must be filled in'),
                'shangji.require' => Lang::get('The superior category must be selected')
            ];
            $data = [
                'fenleim' => Request::instance()->post('fenleim'),
                'shangji' => Request::instance()->post('shangji')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $data = ['term_name' => htmlspecialchars(Request::instance()->post('fenleim')), 'description' => htmlspecialchars(Request::instance()->post('miaoshu')), 'parent_id' => Request::instance()->post('shangji')];
            Db::name('terms')->insert($data);
        }
        $fufenlei = 0;//父分类
        if(Request::instance()->has('c','get'))
        {
            $fufenlei = Request::instance()->get('c');
        }
        $this->assign('fufenlei', $fufenlei);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'addclassify');
        $this->assign('fenlei', $this->getfenlei());
        return $this->view();
    }
    //分类管理
    public function classify()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        if(Request::instance()->has('d','get'))
        {
            //删除对应分类
            Db::name('terms')->where('id',Request::instance()->get('d'))->delete();
            //提交父节点
            Db::name('terms')
                ->where('parent_id', Request::instance()->get('d'))
                ->update(['parent_id' => Request::instance()->get('f')]);
            //删除对应文章
            Db::name('term_relationships')->where('term_id',Request::instance()->get('d'))->delete();
        }
        $this->assign('data', $this->getfenlei('id,term_name,description,parent_id','&#12288;'));
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'classify');
        return $this->view();
    }
    //修改分类
    public function modifyclassify()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        if(Request::instance()->has('cid','post'))
        {
            //验证输入内容
            $rule = [
                'fenleim' => 'require',
                'shangji' => 'require'
            ];
            $msg = [
                'fenleim.require' => Lang::get('The category name must be filled in'),
                'shangji.require' => Lang::get('The superior category must be selected')
            ];
            $data = [
                'fenleim' => Request::instance()->post('fenleim'),
                'shangji' => Request::instance()->post('shangji')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $data = ['term_name' => htmlspecialchars(Request::instance()->post('fenleim')), 'description' => htmlspecialchars(Request::instance()->post('miaoshu')), 'parent_id' => Request::instance()->post('shangji')];
            Db::name('terms')
                ->where('id', Request::instance()->post('cid'))
                ->update($data);
        }
        $data = Db::name('terms')->where('id',Request::instance()->get('c'))->find();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'classify');
        $this->assign('fenlei', $this->getfenlei());
        return $this->view();
    }
    //写文章
    public function write()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if(Request::instance()->has('biaoti','post'))
        {
            //验证输入内容
            $rule = [
                'biaoti' => 'require',
                'neirong' => 'require'
            ];
            $msg = [
                'biaoti.require' => Lang::get('The title must be filled in'),
                'neirong.require' => Lang::get('Article content must be filled out')
            ];
            $data = [
                'biaoti' => Request::instance()->post('biaoti'),
                'neirong' => Request::instance()->post('neirong')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $biaoti = Request::instance()->post('biaoti');
            $neirong = str_replace('<img','<img class="img-responsive"',Request::instance()->post('neirong'));
            $zhaiyao = Request::instance()->post('zhaiyao');
            $guanjianci = str_replace('，',',',Request::instance()->post('guanjianci'));
            Hook::add('write',$this->plugins);
            $params = [
                'title' => $biaoti,
                'content' => $neirong,
                'summary' => ltrim($zhaiyao)
            ];
            Hook::listen('write',$params);
            $biaoti = $params['title'];
            $neirong = $params['content'];
            $zhaiyao = $params['summary'];
            $fabushijian = date('Y-m-d H:i:s');
            if(Request::instance()->has('fabushijian','post'))
            {
                $fabushijian = Request::instance()->post('fabushijian');
            }
            $zhiding = 0;
            if(Request::instance()->has('zhiding','post'))
            {
                $zhiding = Request::instance()->post('zhiding');
            }
            $tuijian = 0;
            if(Request::instance()->has('tuijian','post'))
            {
                $tuijian = Request::instance()->post('tuijian');
            }
            $pinglun = 1;
            if(Request::instance()->has('pinglun','post'))
            {
                $pinglun = Request::instance()->post('pinglun');
            }
            $shenhe = 1;
            if($this->permissions > 5)
            {
                $shenhe = 0;
            }
            $data = ['post_author' => Session::get($this->session_prefix.'user_id'), 'post_keywords' => htmlspecialchars($guanjianci), 'post_source' => htmlspecialchars(Request::instance()->post('laiyuan')), 'post_date' => $fabushijian, 'post_content' => $neirong, 'post_title' => htmlspecialchars($biaoti), 'post_excerpt' => htmlspecialchars($zhaiyao), 'post_status' => $shenhe, 'comment_status' => $pinglun, 'post_modified' => $fabushijian, 'post_type' => Request::instance()->post('xingshi'), 'thumbnail' => Request::instance()->post('suolvetu'), 'istop' => $zhiding, 'recommended' => $tuijian];
            $id = Db::name('posts')->insertGetId($data);
            if(isset($_POST['fenlei']) && is_array($_POST['fenlei']))
            {
                $data = [];
                foreach($_POST['fenlei'] as $key => $val)
                {
                    $data[] = ['object_id' => $id, 'term_id' => $val];
                }
                Db::name('term_relationships')->insertAll($data);
            }
            if(Request::instance()->has('jsfb','post') && Request::instance()->post('jsfb') == 'on')
            {
                Cache::clear();
            }
        }
        $this->switchEditor();
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'write');
        $this->assign('fenlei', $this->getfenlei());
        return $this->view();
    }
    //所有文章
    public function articles()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if($this->permissions < 6)
        {
            $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended')
                ->view('users','user_login','users.id=posts.post_author')
                ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                ->where('status','=',1)
                ->order('post_date desc')
                ->paginate(10);
            $this->assign('authority', 'all');
        }
        else
        {
            $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended')
                ->view('users','user_login','users.id=posts.post_author')
                ->where('post_author','=',Session::get($this->session_prefix.'user_id'))
                ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                ->where('status','=',1)
                ->order('post_date desc')
                ->paginate(10);
            $this->assign('authority', 'part');
        }
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'articles');
        $this->assign('fenlei', $this->getfenlei());
        return $this->view();
    }
    //评论管理
    public function comments()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        $data = Db::view('comments','id,createtime,content,status')
            ->view('users','user_login,user_nicename,user_email,avatar','users.id=comments.uid')
            ->order('comments.createtime desc')
            ->paginate(10);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'comments');
        return $this->view();
    }
    //审核评论
    public function shenhepinglun()
    {
        $this->checkPermissions(5);
        $zt = Request::instance()->post('zt');
        if($zt == 1)
        {
            $zt = 0;
        }
        else
        {
            $zt = 1;
        }
        Db::name('comments')
            ->where('id', Request::instance()->post('id'))
            ->update(['status' => $zt]);
        return true;
    }
    //删除评论
    public function removeComment()
    {
        $this->checkPermissions(5);
        $post = Db::name('comments')
            ->where('id', Request::instance()->post('id'))
            ->field('post_id')
            ->find();
        Db::name('comments')
            ->where('id',Request::instance()->post('id'))
            ->delete();
        Db::name('posts')
            ->where('id', $post['post_id'])
            ->setDec('comment_count');
        return true;
    }
    //批量审核评论
    public function commentbatch()
    {
        $this->checkPermissions(5);
        $zhi = 0;
        switch(Request::instance()->post('cz')){
            case 'shenhe':
                $zhi = 1;
                break;
            case 'weishenhe':
                $zhi = 0;
                break;
        }
        Db::name('comments')
            ->where('id','in',Request::instance()->post('zcuan'))
            ->update(['status' => $zhi]);
        return true;
    }
    //留言管理
    public function messages()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        $data = Db::name('guestbook')->order('createtime desc')->paginate(10);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'messages');
        return $this->view();
    }
    //删除留言
    public function removeMessage()
    {
        $this->checkPermissions(5);
        Db::name('guestbook')->where('id',Request::instance()->post('id'))->delete();
        return true;
    }
    //回收站
    public function recycle()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if($this->permissions < 6)
        {
            $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                ->view('users','user_login','users.id=posts.post_author')
                ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                ->where('status','=',0)
                ->order('post_date desc')
                ->paginate(10);
        }
        else
        {
            $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                ->view('users','user_login','users.id=posts.post_author')
                ->where('post_author','=',Session::get($this->session_prefix.'user_id'))
                ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                ->where('status','=',0)
                ->order('post_date desc')
                ->paginate(10);
        }
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'recycle');
        return $this->view();
    }
    //从回收站删除
    public function removeArticle()
    {
        $this->checkPermissions(6);
        Db::name('posts')->where('id',Request::instance()->post('id'))->delete();
        Db::name('term_relationships')->where('object_id',Request::instance()->post('id'))->delete();
        Db::name('comments')->where('post_id',Request::instance()->post('id'))->delete();
        return true;
    }
    //从回收站还原
    public function reductionArticle()
    {
        $this->checkPermissions(6);
        Db::name('posts')
            ->where('id', Request::instance()->post('id'))
            ->update(['status' => 1]);
        return true;
    }
    //回收站批量操作
    public function recycleBatch()
    {
        $this->checkPermissions(6);
        switch(Request::instance()->post('cz')){
            case 'phuanyuan':
                Db::name('posts')
                    ->where('id','in',Request::instance()->post('zcuan'))
                    ->update(['status' => 1]);
                break;
            case 'pshanchu':
                Db::name('posts')->where('id','in',Request::instance()->post('zcuan'))->delete();
                Db::name('term_relationships')->where('object_id','in',Request::instance()->post('zcuan'))->delete();
                Db::name('comments')->where('post_id','in',Request::instance()->post('zcuan'))->delete();
                break;
        }
        return true;
    }
    //文章搜索
    public function search()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        $fenlei = 0;
        $start = '2000-01-01 01:01:01';
        $end = date("Y-m-d H:i:s");
        $key = '';
        if(Request::instance()->has('fenlei','get'))
        {
            $fenlei = Request::instance()->get('fenlei');
        }
        if(Request::instance()->has('start','get') && Request::instance()->get('start') != '')
        {
            $start = Request::instance()->get('start');
        }
        if(Request::instance()->has('end','get') && Request::instance()->get('end') != '')
        {
            $end = Request::instance()->get('end');
        }
        if(Request::instance()->has('key','get') && Request::instance()->get('key') != '')
        {
            $key = Request::instance()->get('key');
        }
        if(strtotime($start) > strtotime($end))
        {
            $tmp = $start;
            $start = $end;
            $end = $tmp;
        }
        //查询
        if($fenlei != 0)
        {
            if($this->permissions < 6)
            {
                $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                    ->view('users','user_login','users.id=posts.post_author')
                    ->view('term_relationships','term_id','term_relationships.object_id=posts.id')
                    ->where('term_id','=',$fenlei)
                    ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                    ->where('status','=',1)
                    ->whereTime('post_date', 'between', [$start, $end])
                    ->where('post_title|post_content','like','%'.$key.'%')
                    ->order('post_date desc')
                    ->paginate(10,false,[
                        'query' => [
                            'fenlei' => urlencode($fenlei),
                            'start' => urlencode($start),
                            'end' => urlencode($end),
                            'key' => urlencode($key)
                        ]
                    ]);
                $this->assign('authority', 'all');
            }
            else
            {
                $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                    ->view('users','user_login','users.id=posts.post_author')
                    ->view('term_relationships','term_id','term_relationships.object_id=posts.id')
                    ->where('term_id','=',$fenlei)
                    ->where('post_author','=',Session::get($this->session_prefix.'user_id'))
                    ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                    ->where('status','=',1)
                    ->whereTime('post_date', 'between', [$start, $end])
                    ->where('post_title|post_content','like','%'.$key.'%')
                    ->order('post_date desc')
                    ->paginate(10,false,[
                        'query' => [
                            'fenlei' => urlencode($fenlei),
                            'start' => urlencode($start),
                            'end' => urlencode($end),
                            'key' => urlencode($key)
                        ]
                    ]);
                $this->assign('authority', 'part');
            }
        }
        else
        {
            if($this->permissions < 6)
            {
                $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                    ->view('users','user_login','users.id=posts.post_author')
                    ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                    ->where('status','=',1)
                    ->whereTime('post_date', 'between', [$start, $end])
                    ->where('post_title|post_content','like','%'.$key.'%')
                    ->order('post_date desc')
                    ->paginate(10,false,[
                        'query' => [
                            'fenlei' => urlencode($fenlei),
                            'start' => urlencode($start),
                            'end' => urlencode($end),
                            'key' => urlencode($key)
                        ]
                    ]);
                $this->assign('authority', 'all');
            }
            else
            {
                $data = Db::view('posts','id,post_date,post_title,post_status,comment_count,thumbnail,post_hits,istop,recommended,status')
                    ->view('users','user_login','users.id=posts.post_author')
                    ->where('post_author','=',Session::get($this->session_prefix.'user_id'))
                    ->where('post_type',['=',0],['=',2],['=',3],['=',4],['=',5],['=',6],['=',7],['=',8],'or')
                    ->where('status','=',1)
                    ->whereTime('post_date', 'between', [$start, $end])
                    ->where('post_title|post_content','like','%'.$key.'%')
                    ->order('post_date desc')
                    ->paginate(10,false,[
                        'query' => [
                            'fenlei' => urlencode($fenlei),
                            'start' => urlencode($start),
                            'end' => urlencode($end),
                            'key' => urlencode($key)
                        ]
                    ]);
                $this->assign('authority', 'part');
            }
        }
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'articles');
        $this->assign('fenlei', $this->getfenlei());
        return $this->view('articles');
    }
    //文章放入回收站
    public function recycleArticle()
    {
        $this->checkPermissions(6);
        Db::name('posts')
            ->where('id', Request::instance()->post('id'))
            ->update(['status' => 0]);
        return true;
    }
    //修改文章
    public function rewrite()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if(Request::instance()->has('postId','post'))
        {
            //验证输入内容
            $rule = [
                'biaoti' => 'require',
                'neirong' => 'require'
            ];
            $msg = [
                'biaoti.require' => Lang::get('The title must be filled in'),
                'neirong.require' => Lang::get('Article content must be filled out')
            ];
            $data = [
                'biaoti' => Request::instance()->post('biaoti'),
                'neirong' => Request::instance()->post('neirong')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $neirong = str_replace('<img','<img class="img-responsive"',Request::instance()->post('neirong'));
            $guanjianci = str_replace('，',',',Request::instance()->post('guanjianci'));
            $data = ['post_keywords' => htmlspecialchars($guanjianci), 'post_source' => htmlspecialchars(Request::instance()->post('laiyuan')), 'post_content' => $neirong, 'post_title' => htmlspecialchars(Request::instance()->post('biaoti')), 'post_excerpt' => htmlspecialchars(Request::instance()->post('zhaiyao')), 'comment_status' => Request::instance()->post('pinglun'), 'post_modified' => date("Y-m-d H:i:s"), 'post_type' => Request::instance()->post('xingshi'), 'thumbnail' => Request::instance()->post('suolvetu'), 'istop' => Request::instance()->post('zhiding'), 'recommended' => Request::instance()->post('tuijian')];
            Db::name('posts')
                ->where('id', Request::instance()->post('postId'))
                ->update($data);
            //删除原分类
            Db::name('term_relationships')->where('object_id',Request::instance()->post('postId'))->delete();
            //新建分类
            if(isset($_POST['fenlei']) && is_array($_POST['fenlei']))
            {
                $data = [];
                foreach($_POST['fenlei'] as $key => $val)
                {
                    $data[] = ['object_id' => Request::instance()->post('postId'), 'term_id' => $val];
                }
                Db::name('term_relationships')->insertAll($data);
            }
        }
        //查找分类
        $classify = Db::name('term_relationships')->field('term_id')->where('object_id',Request::instance()->get('art'))->select();
        $fenlei =$this->getfenlei();//获取完整分类
        //已选分类
        foreach($fenlei as $key => $val){
            $fenlei[$key]['classify'] = 0;
            foreach($classify as $cval){
                if($val['id'] == $cval['term_id']){
                    $fenlei[$key]['classify'] = 1;
                    break;
                }
            }
        }
        //选取文章
        $wzid = 0;
        if(Request::instance()->has('postId','post'))
        {
            $wzid = Request::instance()->post('postId');
        }
        elseif(Request::instance()->has('art','get'))
        {
            $wzid = Request::instance()->get('art');
        }
        $data = Db::name('posts')->where('id',$wzid)->select();
        $data[0]['post_content'] = str_replace('<img class="img-responsive"','<img',$data[0]['post_content']);
        $this->assign('data', $data[0]);
        $this->switchEditor();
        $this->assign('backstageMenu', 'neirong');
        $this->assign('option', 'articles');
        $this->assign('fenlei', $fenlei);
        return $this->view();
    }
    //批量修改文章
    public function modify()
    {
        $this->checkPermissions(6);
        $xiugai = '';
        $zhi = 0;
        switch(Request::instance()->post('cz')){
            case 'shenhe':
                $xiugai = 'post_status';
                $zhi = 1;
                break;
            case 'weishenhe':
                $xiugai = 'post_status';
                $zhi = 0;
                break;
            case 'zhiding':
                $xiugai = 'istop';
                $zhi = 1;
                break;
            case 'weizhiding':
                $xiugai = 'istop';
                $zhi = 0;
                break;
            case 'tuijian':
                $xiugai = 'recommended';
                $zhi = 1;
                break;
            case 'weituijian':
                $xiugai = 'recommended';
                $zhi = 0;
                break;
            case 'pshanchu':
                $xiugai = 'status';
                $zhi = 0;
                break;
        }
        if(!empty($xiugai)){
            Db::name('posts')
                ->where('id','in',Request::instance()->post('zcuan'))
                ->update([$xiugai => $zhi]);
        }
        return true;
    }
    //新建页面
    public function newpage()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('biaoti','post'))
        {
            //验证输入内容
            $rule = [
                'biaoti' => 'require',
                'template' => 'require'
            ];
            $msg = [
                'biaoti.require' => Lang::get('The title must be filled in'),
                'template.require' => Lang::get('The template must be selected')
            ];
            $data = [
                'biaoti' => Request::instance()->post('biaoti'),
                'template' => Request::instance()->post('template')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $guanjianci = str_replace('，',',',Request::instance()->post('guanjianci'));
            $neirong = str_replace('<img','<img class="img-responsive"',Request::instance()->post('neirong'));
            $data = ['post_author' => Session::get($this->session_prefix.'user_id'), 'post_keywords' => htmlspecialchars($guanjianci), 'post_date' => Request::instance()->post('fabushijian'), 'post_content' => $neirong, 'post_title' => htmlspecialchars(Request::instance()->post('biaoti')), 'post_excerpt' => htmlspecialchars(Request::instance()->post('zhaiyao')), 'post_modified' => Request::instance()->post('fabushijian'), 'post_type' => 1, 'thumbnail' => Request::instance()->post('suolvetu'), 'template' => Request::instance()->post('template')];
            Db::name('posts')->insert($data);
        }
        //获取模板目录
        $template = Db::name('options')
            ->where('option_name','template')
            ->field('option_value')
            ->find();
        //获取现存模板
        $dir = glob(APP_PATH.'../public/'.$template['option_value'].'/page/*.html');
        foreach($dir as $key => $val)
        {
            $tmpdir = basename($val);
            $dir[$key] = $tmpdir;
        }
        $this->assign('dir', $dir);
        $this->switchEditor();
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'newpage');
        return $this->view();
    }
    //所有页面
    public function allpage()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        $data = Db::view('posts','id,post_date,post_title,template')
            ->view('users','user_login','users.id=posts.post_author')
            ->where('post_type','=',1)
            ->where('status','=',1)
            ->order('post_date desc')
            ->paginate(10);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'allpage');
        return $this->view();
    }
    //删除页面
    public function removePage()
    {
        $this->checkPermissions(3);
        Db::name('posts')
            ->where('id',Request::instance()->post('id'))
            ->delete();
        return true;
    }
    //批量删除页面
    public function removeAllPage()
    {
        $this->checkPermissions(3);
        if(Request::instance()->post('cz') == 'pshanchu')
        {
            Db::name('posts')
                ->where('id', 'in', Request::instance()->post('zcuan'))
                ->delete();
        }
        return true;
    }
    //修改页面
    public function editpage()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('postId','post'))
        {
            //验证输入内容
            $rule = [
                'biaoti' => 'require',
                'template' => 'require'
            ];
            $msg = [
                'biaoti.require' => Lang::get('The title must be filled in'),
                'template.require' => Lang::get('The template must be selected')
            ];
            $data = [
                'biaoti' => Request::instance()->post('biaoti'),
                'template' => Request::instance()->post('template')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $guanjianci = str_replace('，',',',Request::instance()->post('guanjianci'));
            $neirong = str_replace('<img','<img class="img-responsive"',Request::instance()->post('neirong'));
            $data = ['post_author' => Session::get($this->session_prefix.'user_id'), 'post_keywords' => htmlspecialchars($guanjianci), 'post_content' => $neirong, 'post_title' => htmlspecialchars(Request::instance()->post('biaoti')), 'post_excerpt' => htmlspecialchars(Request::instance()->post('zhaiyao')), 'post_modified' => date("Y-m-d H:i:s"), 'thumbnail' => Request::instance()->post('suolvetu'), 'template' => Request::instance()->post('template')];
            Db::name('posts')
                ->where('id', Request::instance()->post('postId'))
                ->update($data);
        }
        //选取页面
        $wzid = 0;
        if(Request::instance()->has('postId','post'))
        {
            $wzid = Request::instance()->post('postId');
        }
        elseif(Request::instance()->has('art','get'))
        {
            $wzid = Request::instance()->get('art');
        }
        $data = Db::name('posts')->where('id',$wzid)->find();
        $data['post_content'] = str_replace('<img class="img-responsive"','<img',$data['post_content']);
        $this->assign('data', $data);
        //获取模板目录
        $template = Db::name('options')
            ->where('option_name','template')
            ->field('option_value')
            ->find();
        //获取现存模板
        $dir = glob(APP_PATH.'../public/'.$template['option_value'].'/page/*.html');
        foreach($dir as $key => $val)
        {
            $tmpdir = basename($val);
            $dir[$key] = $tmpdir;
        }
        $this->assign('dir', $dir);
        $this->switchEditor();
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'allpage');
        return $this->view();
    }
    //页面搜索
    public function searchpage()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        $start = '2000-01-01 01:01:01';
        $end = date("Y-m-d H:i:s");
        $key = '';
        if(Request::instance()->has('start','get') && Request::instance()->get('start') != '')
        {
            $start = Request::instance()->get('start');
        }
        if(Request::instance()->has('end','get') && Request::instance()->get('end') != '')
        {
            $end = Request::instance()->get('end');
        }
        if(Request::instance()->has('key','get') && Request::instance()->get('key') != '')
        {
            $key = Request::instance()->get('key');
        }
        if(strtotime($start) > strtotime($end))
        {
            $tmp = $start;
            $start = $end;
            $end = $tmp;
        }
        $data = Db::view('posts','id,post_date,post_title,template')
            ->view('users','user_login','users.id=posts.post_author')
            ->where('post_type','=',1)
            ->where('status','=',1)
            ->whereTime('post_date', 'between', [$start, $end])
            ->where('post_title|post_content','like','%'.$key.'%')
            ->order('post_date desc')
            ->paginate(10,false,[
                'query' => [
                    'start' => urlencode($start),
                    'end' => urlencode($end),
                    'key' => urlencode($key)
                ]
            ]);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'allpage');
        return $this->view('allpage');
    }
    //页面设置
    public function pageSettings()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->isPost())
        {
            $pageSettings = Db::name('options')
                ->where('option_name','pageSettings')
                ->field('option_value')->find();
            $pageSettings = unserialize($pageSettings['option_value']);
            foreach(Request::instance()->post() as $key => $val)
            {
                $sx = explode('_',$key);
                if($sx[0] == 'biaoti')
                {
                    $pageSettings[$sx[1]][$sx[2]][$sx[0]] = htmlspecialchars($val);
                }
                else
                {
                    $pageSettings[$sx[1]][$sx[2]][$sx[0]] = $val;
                }
            }
            Db::name('options')
                ->where('option_name','pageSettings')
                ->update(['option_value' => serialize($pageSettings)]);
        }
        $pageSettings = Db::name('options')
        ->where('option_name','pageSettings')
        ->field('option_value')->find();
        $pageSettings = unserialize($pageSettings['option_value']);
        $this->assign('hunhe', $pageSettings['hunhe']);
        $this->assign('tuwen', $pageSettings['tuwen']);
        $this->assign('fenlei', $this->getfenlei());
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'pageSettings');
        return $this->view();
    }
    //添加幻灯片
    public function addSlideshow()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->isPost())
        {
            //验证输入内容
            $rule = [
                'slideshow' => 'require'
            ];
            $msg = [
                'slideshow.require' => Lang::get('Image must be uploaded')
            ];
            $data = [
                'slideshow' => Request::instance()->post('slideshow')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $data = ['slide_name' => htmlspecialchars(Request::instance()->post('mingcheng')), 'slide_pic' => Request::instance()->post('slideshow'), 'slide_url' => htmlspecialchars(Request::instance()->post('lianjie')), 'slide_des' => htmlspecialchars(Request::instance()->post('miaoshu'))];
            Db::name('slide')->insert($data);
        }
        //获取幻灯片宽和高
        $slideshowWidth = Db::name('options')->where('option_name','slideshowWidth')->field('option_value')->find();
        $slideshowHeight = Db::name('options')->where('option_name','slideshowHeight')->field('option_value')->find();
        $this->assign('slideshowWidth', $slideshowWidth['option_value']);
        $this->assign('slideshowHeight', $slideshowHeight['option_value']);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'addSlideshow');
        return $this->view();
    }
    //修改幻灯片
    public function modifyslide()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->isPost())
        {
            //验证输入内容
            $rule = [
                'slideshow' => 'require'
            ];
            $msg = [
                'slideshow.require' => Lang::get('Image must be uploaded')
            ];
            $data = [
                'slideshow' => Request::instance()->post('slideshow')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $data = ['slide_name' => htmlspecialchars(Request::instance()->post('mingcheng')), 'slide_pic' => Request::instance()->post('slideshow'), 'slide_url' => htmlspecialchars(Request::instance()->post('lianjie')), 'slide_des' => htmlspecialchars(Request::instance()->post('miaoshu'))];
            Db::name('slide')
                ->where('slide_id', Request::instance()->post('slideId'))
                ->update($data);
        }
        //选取幻灯片
        $wzid = 0;
        if(Request::instance()->has('slideId','post'))
        {
            $wzid = Request::instance()->post('slideId');
        }
        elseif(Request::instance()->has('c','get'))
        {
            $wzid = Request::instance()->get('c');
        }
        $data = Db::name('slide')->where('slide_id',$wzid)->find();
        $this->assign('data', $data);
        //获取幻灯片宽和高
        $slideshowWidth = Db::name('options')->where('option_name','slideshowWidth')->field('option_value')->find();
        $slideshowHeight = Db::name('options')->where('option_name','slideshowHeight')->field('option_value')->find();
        $this->assign('slideshowWidth', $slideshowWidth['option_value']);
        $this->assign('slideshowHeight', $slideshowHeight['option_value']);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'slideshow');
        return $this->view();
    }
    //管理幻灯片
    public function slideshow()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        //排序
        if(Request::instance()->has('paixu','post'))
        {
            $paixu = Request::instance()->post();//获取所有post内容
            foreach($paixu as $key => $val)
            {
                if($val != 'paixu')
                {
                    Db::name('slide')
                        ->where('slide_id', $key)
                        ->update(['listorder' => intval($val)]);
                }
            }
        }
        $data = Db::name('slide')->order('listorder')->select();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'slideshow');
        return $this->view();
    }
    //删除幻灯片
    public function removeSlide()
    {
        $this->checkPermissions(3);
        $slide = Db::name('slide')
            ->where('slide_id', Request::instance()->post('id'))
            ->field('slide_pic')
            ->find();
        $yuming = Db::name('options')->where('option_name','domain')->field('option_value')->find();
        //删除原图
        $yfile = str_replace($yuming['option_value'],'',$slide['slide_pic']);
        if(!empty($yfile) && $this->isLegalPicture($slide['slide_pic'])){
            $yfile = substr($yfile,0,1)=='/' ? substr($yfile,1) : $yfile;
            $yfile = str_replace("/", DS, $yfile);
            @unlink(APP_PATH . '..'. DS . $yfile);
        }
        Db::name('slide')
            ->where('slide_id',Request::instance()->post('id'))
            ->delete();
        return true;
    }
    //隐藏启用幻灯片
    public function yincang_qiyong()
    {
        $this->checkPermissions(3);
        $zt = Request::instance()->post('zt');
        if($zt == 1)
        {
            $zt = 0;
        }
        else
        {
            $zt = 1;
        }
        Db::name('slide')
            ->where('slide_id', Request::instance()->post('id'))
            ->update(['slide_status' => $zt]);
        return true;
    }
    //添加友情链接
    public function addLinks()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->isPost())
        {
            //验证输入内容
            $rule = [
                'mingcheng' => 'require',
                'dizhi' => 'require'
            ];
            $msg = [
                'mingcheng.require' => Lang::get('Friendship link name is required'),
                'dizhi.require' => Lang::get('Friendship link address is required')
            ];
            $data = [
                'mingcheng' => Request::instance()->post('mingcheng'),
                'dizhi' => Request::instance()->post('dizhi')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $weizhi = 0;
            if(Request::instance()->has('shouye','post') && Request::instance()->post('shouye') == 'on')
            {
                $weizhi = 1;
            }
            $data = ['link_url' => htmlspecialchars(Request::instance()->post('dizhi')), 'link_name' => htmlspecialchars(Request::instance()->post('mingcheng')), 'link_image' => Request::instance()->post('tubiao'), 'link_target' => Request::instance()->post('dakai'), 'link_description' => htmlspecialchars(Request::instance()->post('miaoshu')), 'link_location' => $weizhi];
            Db::name('links')->insert($data);
        }
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'addLinks');
        return $this->view();
    }
    //管理友情链接
    public function links()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        //排序
        if(Request::instance()->has('paixu','post'))
        {
            $paixu = Request::instance()->post();//获取所有post内容
            foreach($paixu as $key => $val)
            {
                if($val != 'paixu')
                {
                    Db::name('links')
                        ->where('link_id', $key)
                        ->update(['listorder' => intval($val)]);
                }
            }
        }
        $data = Db::name('links')->order('listorder')->select();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'links');
        return $this->view();
    }
    //修改友情链接
    public function modifylink()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->isPost())
        {
            //验证输入内容
            $rule = [
                'mingcheng' => 'require',
                'dizhi' => 'require'
            ];
            $msg = [
                'mingcheng.require' => Lang::get('Friendship link name is required'),
                'dizhi.require' => Lang::get('Friendship link address is required')
            ];
            $data = [
                'mingcheng' => Request::instance()->post('mingcheng'),
                'dizhi' => Request::instance()->post('dizhi')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $weizhi = 0;
            if(Request::instance()->has('shouye','post') && Request::instance()->post('shouye') == 'on')
            {
                $weizhi = 1;
            }
            $data = ['link_url' => htmlspecialchars(Request::instance()->post('dizhi')), 'link_name' => htmlspecialchars(Request::instance()->post('mingcheng')), 'link_image' => Request::instance()->post('tubiao'), 'link_target' => Request::instance()->post('dakai'), 'link_description' => htmlspecialchars(Request::instance()->post('miaoshu')), 'link_location' => $weizhi];
            Db::name('links')
                ->where('link_id', Request::instance()->post('linkId'))
                ->update($data);
        }
        //获取友情链接
        $wzid = 0;
        if(Request::instance()->has('linkId','post'))
        {
            $wzid = Request::instance()->post('linkId');
        }
        elseif(Request::instance()->has('c','get'))
        {
            $wzid = Request::instance()->get('c');
        }
        $data = Db::name('links')->where('link_id',$wzid)->find();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yemian');
        $this->assign('option', 'links');
        return $this->view();
    }
    //隐藏启用友情链接
    public function link_yincang_qiyong()
    {
        $this->checkPermissions(3);
        $zt = Request::instance()->post('zt');
        if($zt == 1)
        {
            $zt = 0;
        }
        else
        {
            $zt = 1;
        }
        Db::name('links')
            ->where('link_id', Request::instance()->post('id'))
            ->update(['link_status' => $zt]);
        return true;
    }
    //删除友情链接
    public function removeLink()
    {
        $this->checkPermissions(3);
        $slide = Db::name('links')
            ->where('link_id', Request::instance()->post('id'))
            ->field('link_image')
            ->find();
        $yuming = Db::name('options')->where('option_name','domain')->field('option_value')->find();
        //删除原图
        $yfile = str_replace($yuming['option_value'],'',$slide['link_image']);
        if(!empty($yfile) && $this->isLegalPicture($slide['link_image'])){
            $yfile = substr($yfile,0,1)=='/' ? substr($yfile,1) : $yfile;
            $yfile = str_replace("/", DS, $yfile);
            @unlink(APP_PATH . '..'. DS . $yfile);
        }
        Db::name('links')
            ->where('link_id',Request::instance()->post('id'))
            ->delete();
        return true;
    }
    //普通用户
    public function general()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        $data = Db::name('users')->where('user_type',7)->order('last_login_time desc')->paginate(10);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yonghu');
        $this->assign('option', 'general');
        return $this->view();
    }
    //查找用户
    public function searchuser()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        $data = [];
        if(Request::instance()->has('user','get'))
        {
            $user = Request::instance()->get('user');
            $user = trim($user);
            $data = Db::name('users')
                ->where('user_type',7)
                ->where('user_login|user_nicename','like','%'.$user.'%')
                ->order('last_login_time desc')
                ->paginate(10,false,[
                    'query' => [
                        'user' => urlencode($user)
                    ]
                ]);
        }
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yonghu');
        $this->assign('option', 'general');
        return $this->view('general');
    }
    //拉黑用户,启用用户
    public function lahei_qiyong()
    {
        $this->checkPermissions(3);
        $zt = Request::instance()->post('zt');
        if($zt == 1)
        {
            $zt = 0;
        }
        else
        {
            $zt = 1;
        }
        Db::name('users')
            ->where('id', Request::instance()->post('id'))
            ->update(['user_status' => $zt]);
        return true;
    }
    //添加后台用户
    public function addmanageuser()
    {
        $this->checkUser();
        $this->checkPermissions(1);
        if(Request::instance()->has('yonghuming','post'))
        {
            //验证输入内容
            $rule = [
                'yonghuming' => 'require',
                'pwd' => 'require',
                'repeat' => 'require',
                'juese' => 'require'
            ];
            $msg = [
                'yonghuming.require' => Lang::get('The user name must be filled in'),
                'pwd.require' => Lang::get('Password must be filled in'),
                'repeat.require' => Lang::get('Confirm password is required'),
                'juese.require' => Lang::get('Role must choose')
            ];
            $data = [
                'yonghuming' => Request::instance()->post('yonghuming'),
                'pwd' => Request::instance()->post('pwd'),
                'repeat' => Request::instance()->post('repeat'),
                'juese' => Request::instance()->post('juese')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            if(Request::instance()->post('pwd') != Request::instance()->post('repeat'))
            {
                $this->error(Lang::get('Confirm the password must be the same as the password'));//验证错误输出
                return false;
            }
            if(!Session::has($this->session_prefix.'addmanageuser_checkCode') || Request::instance()->post('checkCode') != Session::get($this->session_prefix.'addmanageuser_checkCode'))
            {
                $this->error(Lang::get('Your permission is insufficient'));//验证错误输出
                return false;
            }
            $user = Db::name('users')->where('user_login',Request::instance()->post('yonghuming'))->find();
            if(!empty($user))
            {
                $this->error(Lang::get('Username already exists'));//验证错误输出
                return false;
            }
            $data = ['user_login' => htmlspecialchars(Request::instance()->post('yonghuming')), 'user_pass' => md5(Request::instance()->post('pwd')), 'user_nicename' => htmlspecialchars(Request::instance()->post('yonghuming')), 'create_time' => date("Y-m-d H:i:s"), 'user_type' => Request::instance()->post('juese')];
            Db::name('users')->insert($data);
        }
        $checkCode = rand(1, 99999).time();
        Session::set($this->session_prefix.'addmanageuser_checkCode',$checkCode);
        $this->assign('checkCode', $checkCode);
        $this->assign('backstageMenu', 'yonghu');
        $this->assign('option', 'addmanageuser');
        return $this->view();
    }
    //管理后台用户
    public function manageuser()
    {
        $this->checkUser();
        $this->checkPermissions(1);
        $data = Db::name('users')->where('user_type','between','2,6')->order('id desc')->paginate(10);
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yonghu');
        $this->assign('option', 'manageuser');
        return $this->view();
    }
    //修改后台用户
    public function modifymanage()
    {
        $this->checkUser();
        $this->checkPermissions(1);
        if(Request::instance()->has('uid','post'))
        {
            Db::name('users')
                ->where('id', Request::instance()->post('uid'))
                ->update(['user_type' => Request::instance()->post('juese')]);
        }
        //选取菜单分类
        $wzid = 0;
        if(Request::instance()->has('uid','post'))
        {
            $wzid = Request::instance()->post('uid');
        }
        elseif(Request::instance()->has('c','get'))
        {
            $wzid = Request::instance()->get('c');
        }
        $data = Db::name('users')->where('id',$wzid)->field('id,user_login,user_type')->find();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'yonghu');
        $this->assign('option', 'manageuser');
        return $this->view();
    }
    //拉黑后台用户,启用后台用户
    public function lahei_qiyong_bu()
    {
        $this->checkPermissions(1);
        $zt = Request::instance()->post('zt');
        if($zt == 1)
        {
            $zt = 0;
        }
        else
        {
            $zt = 1;
        }
        Db::name('users')
            ->where('id', Request::instance()->post('id'))
            ->update(['user_status' => $zt]);
        return true;
    }
    //添加菜单分类
    public function category()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('fenleiming','post'))
        {
            //验证输入内容
            $rule = [
                'fenleiming' => 'require'
            ];
            $msg = [
                'fenleiming.require' => Lang::get('The category name must be filled in')
            ];
            $data = [
                'fenleiming' => Request::instance()->post('fenleiming')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $active = 0;
            if(Request::instance()->has('zhucaidan','post') && Request::instance()->post('zhucaidan') == 'on')
            {
                $active = 1;
            }
            $data = ['nav_name' => htmlspecialchars(Request::instance()->post('fenleiming')), 'active' => $active, 'remark' => htmlspecialchars(Request::instance()->post('miaoshu'))];
            $id = Db::name('nav_cat')->insertGetId($data);
            if($active == 1)
            {
                Db::name('nav_cat')
                    ->where('navcid', 'neq', $id)
                    ->update(['active' => 0]);
            }
        }
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'category');
        return $this->view();
    }
    //管理菜单分类
    public function managemc()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        $data = Db::name('nav_cat')->select();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'managemc');
        return $this->view();
    }
    //修改菜单分类
    public function modifycategory()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('navcid','post'))
        {
            //验证输入内容
            $rule = [
                'fenleiming' => 'require'
            ];
            $msg = [
                'fenleiming.require' => Lang::get('The category name must be filled in')
            ];
            $data = [
                'fenleiming' => Request::instance()->post('fenleiming')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $active = 0;
            if(Request::instance()->has('zhucaidan','post') && Request::instance()->post('zhucaidan') == 'on')
            {
                $active = 1;
            }
            $data = ['nav_name' => htmlspecialchars(Request::instance()->post('fenleiming')), 'active' => $active, 'remark' => htmlspecialchars(Request::instance()->post('miaoshu'))];
            Db::name('nav_cat')
                ->where('navcid', Request::instance()->post('navcid'))
                ->update($data);
            if($active == 1)
            {
                Db::name('nav_cat')
                    ->where('navcid', 'neq', Request::instance()->post('navcid'))
                    ->update(['active' => 0]);
            }
        }
        //选取菜单分类
        $wzid = 0;
        if(Request::instance()->has('navcid','post'))
        {
            $wzid = Request::instance()->post('navcid');
        }
        elseif(Request::instance()->has('c','get'))
        {
            $wzid = Request::instance()->get('c');
        }
        $data = Db::name('nav_cat')->where('navcid',$wzid)->find();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'managemc');
        return $this->view();
    }
    //删除菜单分类
    public function removemanagemc()
    {
        $this->checkPermissions(3);
        Db::name('nav_cat')
            ->where('navcid',Request::instance()->post('id'))
            ->delete();
        return true;
    }
    //添加菜单
    public function addmenu()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('caidanming','post'))
        {
            //验证输入内容
            $rule = [
                'caidanming' => 'require'
            ];
            $msg = [
                'caidanming.require' => Lang::get('The menu name must be filled in')
            ];
            $data = [
                'caidanming' => Request::instance()->post('caidanming')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $lianjie = '';
            $tmp = $this->filterJavascript(trim(Request::instance()->post('zidingyi')));
            if($tmp != '')
            {
                $lianjie = (substr($tmp,0,4)=='http' || substr($tmp,0,5)=='https' || $this->doNothing($tmp)) ? $tmp : 'http://'.$tmp;
            }
            else
            {
                $lianjie = Request::instance()->post('lianjie');
            }
            $data = ['cid' => Request::instance()->post('caidanfenlei'), 'parent_id' => Request::instance()->post('fuji'), 'label' => htmlspecialchars(Request::instance()->post('caidanming')), 'target' => Request::instance()->post('dakaifangshi'), 'href' => $lianjie, 'icon' => $this->filterJavascript(Request::instance()->post('tubiao')), 'status' => Request::instance()->post('zhuangtai')];
            Db::name('nav')->insert($data);
        }
        //添加子菜单时用
        $cid = 0;//菜单分类
        if(Request::instance()->has('cid','get'))
        {
            $cid = Request::instance()->get('cid');
        }
        $this->assign('cid', $cid);
        if($cid == 0)
        {
            $nav = Db::name('nav_cat')->field('navcid')->order('active desc')->limit(1)->find();
            $cid = $nav['navcid'];
        }
        $this->addModifyMenu($cid);
        //添加子菜单时用
        $fj = 0;//父级
        if(Request::instance()->has('c','get'))
        {
            $fj = Request::instance()->get('c');
        }
        $this->assign('fj', $fj);
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'addmenu');
        return $this->view();
    }
    //添加菜单时改变父级
    public function changeParent()
    {
        $this->checkPermissions(3);
        //获取菜单
        $caidan = Db::name('nav')->where('cid', Request::instance()->post('id'))->where('status', 1)->field('id,parent_id,label')->order('listorder')->select();
        echo '<option value="0">'.Lang::get('As a first-level menu').'</option>';
        if(is_array($caidan) && count($caidan) > 0)
        {
            $caidan = Tree::makeTreeForHtml($caidan);
            foreach($caidan as $key => $val){
                if($val['id'] == Request::instance()->post('fj'))
                {
                    echo '<option value="'.$val['id'].'" selected>'.str_repeat('&#12288;',$val['level']);
                    if($val['level'] > 0){
                        echo '└&nbsp;';
                    }
                    echo $val['label'].'</option>';
                }
                else
                {
                    echo '<option value="'.$val['id'].'">'.str_repeat('&#12288;',$val['level']);
                    if($val['level'] > 0){
                        echo '└&nbsp;';
                    }
                    echo $val['label'].'</option>';
                }
            }
        }
        exit;
    }
    //修改菜单
    public function modifymenu()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('caidanId','post'))
        {
            //验证输入内容
            $rule = [
                'caidanming' => 'require'
            ];
            $msg = [
                'caidanming.require' => Lang::get('The menu name must be filled in')
            ];
            $data = [
                'caidanming' => Request::instance()->post('caidanming')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $lianjie = '';
            $tmp = $this->filterJavascript(trim(Request::instance()->post('zidingyi')));
            if($tmp != '')
            {
                $lianjie = (substr($tmp,0,4)=='http' || substr($tmp,0,5)=='https' || $this->doNothing($tmp)) ? $tmp : 'http://'.$tmp;
            }
            else
            {
                $lianjie = Request::instance()->post('lianjie');
            }
            $data = ['cid' => Request::instance()->post('caidanfenlei'), 'parent_id' => Request::instance()->post('fuji'), 'label' => htmlspecialchars(Request::instance()->post('caidanming')), 'target' => Request::instance()->post('dakaifangshi'), 'href' => $lianjie, 'icon' => $this->filterJavascript(Request::instance()->post('tubiao')), 'status' => Request::instance()->post('zhuangtai')];
            Db::name('nav')
                ->where('id', Request::instance()->post('caidanId'))
                ->update($data);
        }
        //获取菜单项数据
        $caidanxiang = Db::name('nav')
            ->where('id', Request::instance()->get('c'))
            ->find();
        $zidingyi = '';
        if(substr($caidanxiang['href'],0,4) == 'http' || $this->doNothing($caidanxiang['href']))
        {
            $zidingyi = $caidanxiang['href'];
        }
        $this->assign('zidingyi', $zidingyi);//自定义项
        $caidanxiang['icon'] = str_replace('"','&#34;',$caidanxiang['icon']);
        $this->assign('cdxiang', $caidanxiang);//菜单项
        $this->addModifyMenu($caidanxiang['cid']);
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'managemenu');
        return $this->view();
    }
    //用于添加和修改菜单
    private function addModifyMenu($cid)
    {
        //获取菜单分类
        $cdfenlei = Db::name('nav_cat')->field('navcid,nav_name')->order('active desc')->select();
        $this->assign('cdfenlei', $cdfenlei);
        //获取菜单
        $caidan = Db::name('nav')->where('status', 1)->where('cid', $cid)->field('id,parent_id,label')->order('listorder')->select();
        if(is_array($caidan) && count($caidan) > 0)
        {
            $caidan = Tree::makeTreeForHtml($caidan);
            foreach($caidan as $key => $val){
                $caidan[$key]['level'] = str_repeat('&#12288;',$val['level']);
            }
        }
        $this->assign('caidan', $caidan);
        //获取页面
        $yemian = Db::name('posts')->where('post_type', '1')->where('status', '1')->field('id,post_title,parent_id')->select();
        if(is_array($yemian) && count($yemian) > 0)
        {
            $yemian = Tree::makeTreeForHtml($yemian);
            foreach($yemian as $key => $val){
                $yemian[$key]['level'] = str_repeat('&#12288;',$val['level']);
            }
        }
        $this->assign('yemian', $yemian);
        //获取文章分类
        $this->assign('fenlei', $this->getfenlei());
    }
    //管理菜单
    public function managemenu()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        //排序
        if(Request::instance()->has('paixu','post'))
        {
            $paixu = Request::instance()->post();//获取所有post内容
            foreach($paixu as $key => $val)
            {
                if($val != 'paixu')
                {
                    Db::name('nav')
                        ->where('id', $key)
                        ->update(['listorder' => intval($val)]);
                }
            }
        }
        //删除菜单
        if(Request::instance()->has('d','get'))
        {
            //删除对应菜单
            Db::name('nav')->where('id',Request::instance()->get('d'))->delete();
            //提交父节点
            Db::name('nav')
                ->where('parent_id', Request::instance()->get('d'))
                ->update(['parent_id' => Request::instance()->get('f')]);
        }
        //获取菜单分类
        $cdfenlei = Db::name('nav_cat')->field('navcid,nav_name')->order('active desc')->select();
        $this->assign('cdfenlei', $cdfenlei);
        $cid = 0;
        if(Request::instance()->has('caidanfenlei','post'))
        {
            //当前菜单
            $cid = Request::instance()->post('caidanfenlei');
        }
        elseif(Request::instance()->has('cid','get'))
        {
            //当前菜单
            $cid = Request::instance()->get('cid');
        }
        else
        {
            //查找主菜单
            $nav = Db::name('nav_cat')->field('navcid')->order('active desc')->limit(1)->select();
            $cid = $nav[0]['navcid'];
        }
        $this->assign('cid', $cid);
        $data = Db::name('nav')->where('cid',$cid)->field('id,parent_id,label,status,listorder')->order('listorder')->select();
        if(is_array($data) && count($data) > 0)
        {
            $data = Tree::makeTreeForHtml($data);
            foreach($data as $key => $val){
                $data[$key]['level'] = str_repeat('&#12288;',$val['level']);
            }
        }
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'caidan');
        $this->assign('option', 'managemenu');
        return $this->view();
    }
    //网站信息
    public function web()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('title','post'))
        {
            //验证输入内容
            $rule = [
                'email' => 'email',
                'domain' => 'require'
            ];
            $msg = [
                'email.email' => Lang::get('The e-mail format is incorrect'),
                'domain.require' => Lang::get('Site domain name must be filled out')
            ];
            $data = [
                'email' => Request::instance()->post('email'),
                'domain' => Request::instance()->post('domain')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $pinglun = 0;
            if(Request::instance()->has('pinglun','post') && Request::instance()->post('pinglun') == 'on')
            {
                $pinglun = 1;
            }
            $yanzheng = 0;
            if(Request::instance()->has('yanzheng','post') && Request::instance()->post('yanzheng') == 'on')
            {
                $yanzheng = 1;
            }
            $spare = [];
            $options_spare = Db::name('options')->where('option_name','spare')->field('option_value')->find();
            $options_spare = $options_spare['option_value'];
            if(!empty($options_spare))
            {
                $spare = unserialize($options_spare);
            }
            $rewrite = 0;
            if(Request::instance()->has('rewrite','post') && Request::instance()->post('rewrite') == 'on')
            {
                $rewrite = 1;
            }
            $spare['rewrite'] = $rewrite;
            $notAllowLogin = 0;
            if(Request::instance()->has('notAllowLogin','post') && Request::instance()->post('notAllowLogin') == 'on')
            {
                $notAllowLogin = 1;
            }
            $spare['notAllowLogin'] = $notAllowLogin;
            $closeSlide = 0;
            if(Request::instance()->has('closeSlide','post') && Request::instance()->post('closeSlide') == 'on')
            {
                $closeSlide = 1;
            }
            $spare['closeSlide'] = $closeSlide;
            $datu = 0;
            if(Request::instance()->has('datu','post') && Request::instance()->post('datu') == 'on')
            {
                $datu = 1;
            }
            $spare['datu'] = $datu;
            $everyPageShows = 10;
            if(Request::instance()->has('everyPageShows','post'))
            {
                $everyPageShows = intval(Request::instance()->post('everyPageShows'));
                if($everyPageShows < 1)
                {
                    $everyPageShows = 10;
                }
            }
            $spare['everyPageShows'] = $everyPageShows;
            $ico = '';
            if(Request::instance()->has('ico','post'))
            {
                $ico = Request::instance()->post('ico');
            }
            $spare['ico'] = $ico;
            $tFormat = 'Y-m-d H:i:s';
            if(Request::instance()->has('timeFormat','post'))
            {
                $tFormat = Request::instance()->post('timeFormat');
            }
            $spare['timeFormat'] = $tFormat;
            $spare = serialize($spare);
            Db::name('options')
                ->where('option_name', 'title')
                ->update(['option_value' => htmlspecialchars(Request::instance()->post('title'))]);
            Db::name('options')
                ->where('option_name', 'subtitle')
                ->update(['option_value' => htmlspecialchars(Request::instance()->post('subtitle'))]);
            Db::name('options')
                ->where('option_name', 'keyword')
                ->update(['option_value' => htmlspecialchars(Request::instance()->post('keyword'))]);
            Db::name('options')
                ->where('option_name', 'description')
                ->update(['option_value' => htmlspecialchars(Request::instance()->post('description'))]);
            Db::name('options')
                ->where('option_name', 'email')
                ->update(['option_value' => Request::instance()->post('email')]);
            Db::name('options')
                ->where('option_name', 'template')
                ->update(['option_value' => Request::instance()->post('template')]);
            Db::name('options')
                ->where('option_name', 'comment')
                ->update(['option_value' => $pinglun]);
            Db::name('options')
                ->where('option_name', 'filter')
                ->update(['option_value' => Request::instance()->post('guolv')]);
            Db::name('options')
                ->where('option_name', 'record')
                ->update(['option_value' => Request::instance()->post('record')]);
            Db::name('options')
                ->where('option_name', 'copyright')
                ->update(['option_value' => serialize(Request::instance()->post('copyright'))]);
            Db::name('options')
                ->where('option_name', 'statistics')
                ->update(['option_value' => serialize(Request::instance()->post('statistics'))]);
            Db::name('options')
                ->where('option_name', 'slideshowWidth')
                ->update(['option_value' => Request::instance()->post('kuan')]);
            Db::name('options')
                ->where('option_name', 'slideshowHeight')
                ->update(['option_value' => Request::instance()->post('gao')]);
            Db::name('options')
                ->where('option_name', 'domain')
                ->update(['option_value' => Request::instance()->post('domain')]);
            Db::name('options')
                ->where('option_name', 'logo')
                ->update(['option_value' => Request::instance()->post('tubiao')]);
            Db::name('options')
                ->where('option_name', 'captcha')
                ->update(['option_value' => $yanzheng]);
            Db::name('options')
                ->where('option_name', 'spare')
                ->update(['option_value' => $spare]);
            Cache::clear();
        }
        //获取现存模板
        $dir = glob(APP_PATH.'../public/*',GLOB_ONLYDIR);
        foreach($dir as $key => $val)
        {
            $tmpdir = basename($val);
            if($tmpdir == 'common')
            {
                unset($dir[$key]);
            }
            else
            {
                $dir[$key] = $tmpdir;
            }
        }
        $this->assign('dir', $dir);
        //获取站点信息
        $siteInfo = Db::name('options')
            ->where('option_id','<','21')
            ->field('option_name,option_value')->select();
        $data = [];
        foreach($siteInfo as $key => $val){
            if($val['option_name'] == 'copyright' || $val['option_name'] == 'statistics')
            {
                $data[$val['option_name']] = unserialize($val['option_value']);
            }
            else if($val['option_name'] == 'spare')
            {
                if(!empty($val['option_value']))
                {
                    $spare = unserialize($val['option_value']);
                    foreach($spare as $skey => $sval)
                    {
                        $data[$skey] = $sval;
                    }
                }
            }
            else
            {
                $data[$val['option_name']] = $val['option_value'];
            }
        }
        if(!isset($data['rewrite']) && $this->is_rewrite() == true)
        {
            $data['rewrite'] = 1;
        }
        $this->assign('data', $data);
        $now = time();
        $timeFormat = [];
        $timeFormat[] = [
            'val' => 'Y-m-d H:i:s',
            'show' => date('Y-m-d H:i:s',$now)
        ];
        $timeFormat[] = [
            'val' => 'Y年m月d日 H'.Lang::get('点').'i分s秒',
            'show' => date('Y年m月d日 H'.Lang::get('点').'i分s秒',$now)
        ];
        $timeFormat[] = [
            'val' => 'Y年m月d日 H:i:s',
            'show' => date('Y年m月d日 H:i:s',$now)
        ];
        $timeFormat[] = [
            'val' => 'Y/m/d H:i:s',
            'show' => date('Y/m/d H:i:s',$now)
        ];
        $timeFormat[] = [
            'val' => 'Y.m.d H:i:s',
            'show' => date('Y.m.d H:i:s',$now)
        ];
        $timeFormat[] = [
            'val' => 'M d Y h:i:s A',
            'show' => date('M d Y h:i:s A',$now)
        ];
        $timeFormat[] = [
            'val' => 'F d Y h:i:s A',
            'show' => date('F d Y h:i:s A',$now)
        ];
        $this->assign('timeFormat', $timeFormat);
        $this->assign('backstageMenu', 'xitong');
        $this->assign('option', 'web');
        return $this->view();
    }
    //主题
    public function themes()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        if(Request::instance()->has('themeName','post'))
        {
            Db::name('options')
                ->where('option_name', 'template')
                ->update(['option_value' => Request::instance()->post('themeName')]);
            Cache::clear();
        }
        $dqzhuti = Db::name('options')->where('option_name','template')->field('option_value')->find();
        $dqzhuti = $dqzhuti['option_value'];
        $themes = [];
        $domain = $this->host();
        $dir = glob(APP_PATH.'../public/*',GLOB_ONLYDIR);
        foreach($dir as $key => $val)
        {
            $tmpdir = basename($val);
            if($tmpdir != 'common')
            {
                $url = $domain.'public/common/images/screenshot.jpg';
                $path = APP_PATH.'../public/'.$tmpdir.'/screenshot.jpg';
                if(is_file($path))
                {
                    $url = $domain.'public/'.$tmpdir.'/screenshot.jpg';
                }
                $dq = 0;
                if($dqzhuti == $tmpdir)
                {
                    $dq = 1;
                }
                if($dq == 1)
                {
                    array_unshift($themes,[
                        'name' => $tmpdir,
                        'url' => $url,
                        'open' => $dq
                    ]);
                }
                else
                {
                    array_push($themes,[
                        'name' => $tmpdir,
                        'url' => $url,
                        'open' => $dq
                    ]);
                }
            }
        }
        $this->assign('themes', $themes);
        $this->assign('backstageMenu', 'xitong');
        $this->assign('option', 'themes');
        return $this->view();
    }
    //个人信息
    public function personal()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if(Request::instance()->has('user_nicename','post'))
        {
            //验证输入内容
            $rule = [
                'email' => 'require|email'
            ];
            $msg = [
                'email.require' => Lang::get('E-mail address is required'),
                'email.email' => Lang::get('The e-mail format is incorrect')
            ];
            $data = [
                'email' => Request::instance()->post('email')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            $avatar = Db::name('users')
                ->where('id', Session::get($this->session_prefix.'user_id'))
                ->field('avatar')
                ->find();
            $yuming = Db::name('options')->where('option_name','domain')->field('option_value')->find();
            //删除原图
            if(Request::instance()->post('avatar') != $avatar['avatar'])
            {
                $yfile = str_replace($yuming['option_value'],'',$avatar['avatar']);
                if(!empty($yfile) && $this->isLegalPicture(Request::instance()->post('avatar'))){
                    $yfile = substr($yfile,0,1)=='/' ? substr($yfile,1) : $yfile;
                    $yfile = str_replace("/", DS, $yfile);
                    @unlink(APP_PATH . '..'. DS . $yfile);
                }
            }
            $ava = Request::instance()->post('avatar');
            if($this->isLegalPicture($ava) == false)
            {
                $ava = '';
            }
            $xingbie = Request::instance()->post('sex');
            $pdata = [
                'user_nicename' => htmlspecialchars(Request::instance()->post('user_nicename')),
                'sex' => intval($xingbie),
                'birthday' => htmlspecialchars(Request::instance()->post('birthday')),
                'user_url' => htmlspecialchars(Request::instance()->post('user_url')),
                'signature' => htmlspecialchars(Request::instance()->post('signature')),
                'avatar' => $ava
            ];
            Db::name('users')
                ->where('id', Session::get($this->session_prefix.'user_id'))
                ->update($pdata);
        }
        $data = Db::name('users')
            ->where('id',Session::get($this->session_prefix.'user_id'))
            ->field('user_nicename,user_email,user_url,avatar,sex,birthday,signature')
            ->find();
        $this->assign('data', $data);
        $this->assign('backstageMenu', 'xitong');
        $this->assign('option', 'personal');
        return $this->view();
    }
    //个人头像上传
    public function uploadhead()
    {
        $this->checkPermissions(6);
        $file = request()->file('file');
        $validate = [
            'ext' => 'jpg,png,gif,jpeg'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            echo $info->getSaveName();
        }
        else{
            echo $file->getError();
        }
        exit();
    }
    //修改密码
    public function change()
    {
        $this->checkUser();
        $this->checkPermissions(6);
        if(Request::instance()->has('oldPassword','post'))
        {
            //验证输入内容
            $rule = [
                'oldPassword' => 'require',
                'newPassword' => 'require|min:8',
                'repeat' => 'require'
            ];
            $msg = [
                'oldPassword.require' => Lang::get('The original password must be filled in'),
                'newPassword.require' => Lang::get('The new password must be filled in'),
                'newPassword.min' => Lang::get('The new password can not be shorter than 8 characters'),
                'repeat.require' => Lang::get('Confirm the new password must be filled out')
            ];
            $data = [
                'oldPassword' => Request::instance()->post('oldPassword'),
                'newPassword' => Request::instance()->post('newPassword'),
                'repeat' => Request::instance()->post('repeat')
            ];
            $validate = new Validate($rule, $msg);
            if(!$validate->check($data))
            {
                $this->error($validate->getError());//验证错误输出
                return false;
            }
            if(Request::instance()->post('newPassword') != Request::instance()->post('repeat'))
            {
                $this->error(Lang::get('Confirm that the new password and the new password do not match'));//验证错误输出
                return false;
            }
            $data = Db::name('users')
                ->where('id', Session::get($this->session_prefix.'user_id'))
                ->field('user_pass')
                ->find();
            if($data['user_pass'] != md5(Request::instance()->post('oldPassword')))
            {
                $this->error(Lang::get('The original password is wrong'));//验证错误输出
                return false;
            }
            else
            {
                Db::name('users')
                    ->where('id', Session::get($this->session_prefix.'user_id'))
                    ->update(['user_pass' => md5(Request::instance()->post('newPassword'))]);
            }
        }
        $this->assign('backstageMenu', 'xitong');
        $this->assign('option', 'change');
        return $this->view();
    }
    //获取版本
    public function version()
    {
        $this->checkPermissions(6);
        $versionCache = Cache::get('latestVersion');
        $version = Config::get('version');
        $version_number = trim(substr(trim($version['number']),1));
        $versionCache_number = '';
        if($versionCache != false)
        {
            $versionCache_number = trim(substr(trim($versionCache),1));
        }
        if($versionCache == false || version_compare($version_number, $versionCache_number) >= 0)
        {
            $res = $this->getVersion($version['official']);
            if(strtoupper(substr($res,0,1)) == 'V')
            {
                Cache::set('latestVersion',$res,43200);
                return $res;
            }
        }
        else
        {
            return $versionCache;
        }
        return Lang::get('Did not find the latest version information');
    }
    //删除缓存
    public function clearcache()
    {
        $this->checkUser();
        $this->checkPermissions(5);
        if(Request::instance()->has('clearcache','post'))
        {
            Cache::clear();
        }
        $this->assign('backstageMenu', 'xitong');
        $this->assign('option', 'clearcache');
        return $this->view();
    }
    //插件
    public function plugin()
    {
        $this->checkUser();
        $this->checkPermissions(3);
        //获取已经开启插件
        $plugins = Db::name('options')->where('option_name','plugins')->field('option_value')->find();
        if(!empty($plugins))
        {
            $plugins = unserialize($plugins['option_value']);
        }
        else
        {
            $plugins = [];
        }
        //获取已有插件
        $data = [];
        $dir = glob(APP_PATH.'plugins/*',GLOB_ONLYDIR);
        foreach($dir as $key => $val)
        {
            $pluginName = basename($val);
            Lang::load(APP_PATH . 'plugins/'.$pluginName.'/lang/'.$this->lang.'.php');
            $readme = APP_PATH.'plugins/'.$pluginName.'/readme.txt';
            if(!is_file($readme))
            {
                $readme = APP_PATH.'plugins/'.$pluginName.'/'.ucfirst($pluginName).'.php';
            }
            if(!is_file($readme))
            {
                continue;
            }
            $pluginStr = file_get_contents($readme);
            $pName = '';
            if(preg_match("/(插件名|Plugin Name)\s*(：|:)(.*)/i", $pluginStr ,$matches))
            {
                $pName = trim($matches[3]);
            }
            $pluginDesc = '';
            if(preg_match("/(描述|Description)\s*(：|:)(.*)/i", $pluginStr ,$matches))
            {
                $pluginDesc = trim($matches[3]);
            }
            $pluginAuth = '';
            if(preg_match("/(作者|Author)\s*(：|:)(.*)/i", $pluginStr ,$matches))
            {
                $pluginAuth = trim($matches[3]);
            }
            $pluginVers = '';
            if(preg_match("/(版本|Version)\s*(：|:)(.*)/i", $pluginStr ,$matches))
            {
                $pluginVers = trim($matches[3]);
            }
            $pluginUri = '';
            if(preg_match("/(插件网址|插件網址|Plugin URI|Plugin URL)\s*(：|:)(.*)/i", $pluginStr ,$matches))
            {
                $pluginUri = trim($matches[3]);
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
            $data[] = [
                'plugin' => $pluginName,
                'name' => Lang::get($pName),
                'description' => Lang::get($pluginDesc),
                'author' => $pluginAuth,
                'version' => $pluginVers,
                'pluginUrl' => $pluginUri,
                'jurisdiction' => $quanxian
            ];
        }
        $dataArr = [];
        foreach($data as $key => $val)
        {
            if(in_array($val['plugin'],$plugins))
            {
                $data[$key]['open'] = 1;
                $dataArr[] = $val['plugin'];
            }
            else
            {
                $data[$key]['open'] = 0;
            }
            if(Session::has($this->session_prefix.'user_type') && Session::get($this->session_prefix.'user_type') > $val['jurisdiction'])
            {
                unset($data[$key]);
            }
        }
        $this->assign('data', $data);
        //清理冗余插件
        $intArr=array_intersect($plugins,$dataArr);
        if(count($intArr) < count($plugins))
        {
            Db::name('options')
                ->where('option_name', 'plugins')
                ->update(['option_value' => serialize($intArr)]);
        }
        $this->assign('backstageMenu', 'kuozhan');
        $this->assign('option', 'plugin');
        return $this->view();
    }
    //插件开关
    public function pluginkaiguan()
    {
        $this->checkPermissions(3);
        $norecord = false;
        $plugins = Db::name('options')->where('option_name','plugins')->field('option_value')->find();
        if(!empty($plugins))
        {
            $plugins = unserialize($plugins['option_value']);
        }
        else
        {
            $norecord = true;
            $plugins = [];
        }
        $find = array_search(Request::instance()->post('pn'),$plugins);
        $params = [
            'plugin' => Request::instance()->post('pn')
        ];
        if($find === false)
        {
            $plugins[] = Request::instance()->post('pn');
            Hook::add('open','app\\plugins\\'.Request::instance()->post('pn').'\\'.ucfirst(Request::instance()->post('pn')));
            Hook::listen('open',$params);
        }
        else
        {
            unset($plugins[$find]);
            Hook::add('close','app\\plugins\\'.Request::instance()->post('pn').'\\'.ucfirst(Request::instance()->post('pn')));
            Hook::listen('close',$params);
        }
        if($norecord == true)
        {
            $data = ['option_name' => 'plugins', 'option_value' => serialize($plugins), 'autoload' => 0];
            Db::name('options')->insert($data);
        }
        else
        {
            Db::name('options')
                ->where('option_name','plugins')
                ->update(['option_value' => serialize($plugins)]);
        }
        Cache::rm('plugins');//前台
        Cache::rm('pluginslist');//后台
        return true;
    }
    //自定义插件
    public function plugins($plugin)
    {
        $this->checkUser();
        $this->checkPermissions(3);
        Hook::add('settings','app\\plugins\\'.$plugin.'\\'.ucfirst($plugin));
        Hook::add('settings_post','app\\plugins\\'.$plugin.'\\'.ucfirst($plugin));
        $params = [];
        if(Request::instance()->isPost())
        {
            Hook::listen('settings_post',$params);
        }
        Hook::listen('settings',$params);
        $nofile = false;
        //获取插件名
        $readme = APP_PATH.'plugins/'.$plugin.'/readme.txt';
        if(!is_file($readme))
        {
            $readme = APP_PATH.'plugins/'.$plugin.'/'.ucfirst($plugin).'.php';
        }
        $pluginStr = @file_get_contents($readme);
        if($pluginStr === false)
        {
            $nofile = true;
        }
        $pName = $plugin;
        if($nofile == false && @preg_match("/(插件名|Plugin Name)\s*(：|:)(.*)/i", $pluginStr ,$matches))
        {
            $pName = trim($matches[3]);
        }
        $this->assign('pluginName', $pName);
        if($nofile == true)
        {
            $this->assign('data', Lang::get('Plugin not found'));
        }
        else
        {
            if(!empty($params['view']))
            {
                $this->assign('data', $params['view']);
            }
            else
            {
                $this->assign('data', Lang::get('The plugin has no settings'));
            }
        }
        $this->assign('backstageMenu', 'kuozhan');
        $this->assign('option', $plugin);
        return $this->view();
    }
    //Logo上传
    public function uploadLogo()
    {
        $this->checkPermissions(3);
        $file = request()->file('file');
        $validate = [
            'ext' => 'jpg,png,gif,jpeg'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            echo $info->getSaveName();
        }
        else{
            echo $file->getError();
        }
        exit();
    }
    //ico上传
    public function uploadIco()
    {
        $this->checkPermissions(3);
        $file = request()->file('file');
        $validate = [
            'ext' => 'ico'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            echo $info->getSaveName();
        }
        else{
            echo $file->getError();
        }
        exit();
    }
    //图片上传
    public function upload()
    {
        $this->checkPermissions(6);
        $file = request()->file('file');
        $validate = [
            'ext' => 'jpg,png,gif,jpeg'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            //生成缩略图
            $image = \think\Image::open(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            $width = $image->width();
            $height = $image->height();
            $options_spare = $this->optionsSpare();
            if(!isset($options_spare['datu']) || $options_spare['datu'] != 1)
            {
                $larger = str_replace('.','_larger.',$info->getSaveName());
                @$image->thumb(800, ($height * 800 / $width),\think\Image::THUMB_FIXED)->save(ROOT_PATH . 'data' . DS . 'uploads' . DS . $larger);
            }
            if($width > 350 || $height > 350)
            {
                @$image->thumb(350, 350)->save(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            }
            echo $info->getSaveName();
        }else{
            echo $file->getError();
        }
        exit();
    }
    //友情链接图标上传
    public function uploadLinks()
    {
        $this->checkPermissions(3);
        $file = request()->file('file');
        $validate = [
            'ext' => 'jpg,png,gif,jpeg'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            //生成图标
            $image = \think\Image::open(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            $width = $image->width();
            $height = $image->height();
            if($width > 100 || $height > 50)
            {
                @$image->thumb(100, 50, \think\Image::THUMB_FIXED)->save(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            }
            echo $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
        exit();
    }
    //上传幻灯片
    public function uploadSlideshow()
    {
        $this->checkPermissions(3);
        $file = request()->file('file');
        $validate = [
            'ext' => 'jpg,png,gif,jpeg'
        ];
        $file->validate($validate);
        $info = $file->move(ROOT_PATH . 'data' . DS . 'uploads');
        if($info){
            //生成幻灯片
            $slideshowWidth = Db::name('options')->where('option_name','slideshowWidth')->field('option_value')->find();
            $slideshowHeight = Db::name('options')->where('option_name','slideshowHeight')->field('option_value')->find();
            $image = \think\Image::open(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            @$image->thumb($slideshowWidth['option_value'],$slideshowHeight['option_value'],\think\Image::THUMB_FIXED)->save(ROOT_PATH . 'data' . DS . 'uploads' . DS . $info->getSaveName());
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
        exit();
    }
    //获取分类数组
    private function getfenlei($fields = 'id,term_name,parent_id', $replace = '&nbsp;&nbsp;&nbsp;')
    {
        $data = Db::name('terms')->field($fields)->select();
        if(is_array($data) && count($data) > 0)
        {
            $r = Tree::makeTreeForHtml($data);
            foreach($r as $key => $val){
                $r[$key]['level'] = str_repeat($replace,$val['level']);
            }
            return $r;
        }
        else
        {
            return [];
        }
    }
    private function view($template = '')
    {
        $domain = Cache::get('domain');
        if($domain == false)
        {
            $domain = Db::name('options')->where('option_name','domain')->field('option_value')->find();
            $domain = $domain['option_value'];
            Cache::set('domain',$domain,3600);
        }
        $this->assign('domain', $domain);
        $version = Config::get('version');
        $this->assign('catfish', '<a href="http://www.'.$version['official'].'/" target="_blank" id="catfish">'.$version['name'].'&nbsp;'.$version['number'].'</a>&nbsp;&nbsp;');
        $this->assign('executionTime', Debug::getRangeTime('begin','end',4).'s');
        $view = $this->fetch($template);
        return $view;
    }
    private function domain()
    {
        $domain = Cache::get('domain');
        if($domain == false)
        {
            $domain = Db::name('options')->where('option_name','domain')->field('option_value')->find();
            $domain = $domain['option_value'];
            Cache::set('domain',$domain,3600);
        }
        $root = '';
        $dm = Url::build('/');
        if(strpos($dm,'/index.php') !== false)
        {
            $root = 'index.php/';
        }
        return $domain.$root;
    }
    private function host()
    {
        $domain = Cache::get('domain');
        if($domain == false)
        {
            $domain = Db::name('options')->where('option_name','domain')->field('option_value')->find();
            $domain = $domain['option_value'];
            Cache::set('domain',$domain,3600);
        }
        return $domain;
    }
    private function switchEditor()
    {
        Hook::add('switch_editor',$this->plugins);
        $editorParams = [
            'editor_css' => '',
            'editor_js' => '',
            'editor' => '',
            'js' => ''
        ];
        Hook::listen('switch_editor',$editorParams);
        if(!empty($editorParams['editor_css']))
        {
            $this->assign('editor_css', $editorParams['editor_css']);
        }
        if(!empty($editorParams['editor_js']))
        {
            $this->assign('editor_js', $editorParams['editor_js']);
        }
        if(!empty($editorParams['editor']))
        {
            $this->assign('editor', $editorParams['editor']);
        }
        if(!empty($editorParams['js']))
        {
            $this->assign('js', $editorParams['js']);
        }
    }
}