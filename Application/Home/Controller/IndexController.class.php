<?php
// +----------------------------------------------------------------------
// | OneThink [ WE CAN DO IT JUST THINK IT ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013 http://www.onethink.cn All rights reserved.
// +----------------------------------------------------------------------
// | Author: 麦当苗儿 <zuojiazi@vip.qq.com> <http://www.zjzit.cn>
// +----------------------------------------------------------------------

namespace Home\Controller;

use OT\DataDictionary;

/**
 * 前台首页控制器
 * 主要获取首页聚合数据
 */
class IndexController extends HomeController
{

    //系统首页
    public function index()
    {
        hook('homeIndex');
        $default_url=C('DEFUALT_HOME_URL');//获得配置，如果为空则显示聚合，否则跳转
        if($default_url!=''){
            redirect(get_nav_url($default_url));
        }
        $this->assignWeibos();
        $this->assignProject();
		$this->assignNews();
		$this->display();
    }
	
    private function assignNews(){
    	$children = D('DocCategory')->getChildrenId(1);
    	$news = S('home_news');
    	if (empty($news)){
    		$news = M('Document')
    		->where("status=1 and category_id in ({$children})")
    		->order('create_time desc')
    		->limit(0,10)
    		->select();
    	
    		S('home_news',$news,600);
    	
    	}
    	$this->assign('news',$news);
    }
    
    private function assignProject(){
    	$project = S('home_project');
    	if (empty($project)){
    		$project = M()->table(C('DB_PREFIX').'document a,'.C('DB_PREFIX').'document_project b')
    					  ->where("a.id = b.id and a.position >3 and a.status=1")
    					  ->order('a.create_time desc')
    					  ->limit(0,4)
    					  ->select();
    		
    		S('home_project',$project,600);
    		
    	}
    	$this->assign('projects',$project);
    }
    
    private function assignPostCount()
    {
        $post_count = S('home_post_count');
        if (empty($post_count)) {
            $post_count = D('ForumPost')->where(array('status' => 1))->count();
            S('home_post_count', $post_count, 600);
        }
        $this->assign('post_count', $post_count);
    }

    private function assignWeiboCount()
    {
        $weibo_count = S('home_weibo_count');
        if (empty($weibo_count)) {
            $weibo_count = D('Weibo')->where(array('status' => 1))->count();
            S('home_weibo_count', $weibo_count, 600);
        }
        $this->assign('weibo_count', $weibo_count);
    }

    private function assignEventCount()
    {
        $event_count = S('home_event_count');
        if (empty($event_count)) {
            $event_count = D('Event')->where(array('status' => 1))->count();
            S('home_event_count', $event_count, 600);
        }
        $this->assign('event_count', $event_count);
    }

    private function assignEvents()
    {
        $events = S('home_events');
        if (empty($events)) {
            $events = D('Event')->where(array('status' => 1, 'create_time > ' . (time() - 604800)))->order('reply_count')->limit(3)->select();
            S('home_events', $events, 600);
        }
        $this->assign('events', $events);
    }
    private function assignPosts()
    {
        $data = S('home_posts');
        if (empty($data)) {
            $data = D('ForumPost')->where(array('status' => 1, 'create_time > ' . (time() - 604800)))->order('reply_count')->limit(4)->select();
            S('home_posts', $data, 600);
        }
        $this->assign('posts', $data);
    }
    private function assignWeibos()
    {
        $data = S('home_weibos');
        if (empty($data)) {
            $data = D('Weibo')->where(array('status' => 1))->order('create_time desc')->limit(4)->select();
            S('home_weibos', $data, 600);
        }
        $this->assign('weibos', $data);
    }

    /**
     * 获取表情列表。
     */
    public function getSmile()
    {
        //这段代码不是测试代码，请勿删除
        exit(json_encode(D('Common/Expression')->getAllExpression()));
    }

}