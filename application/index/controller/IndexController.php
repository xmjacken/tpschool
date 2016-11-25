<?php
namespace app\index\controller;
use app\common\model\Teacher;
use think\Controller;

class IndexController extends Controller
{
	public function __construct() {
		// 调用父类构造函数(必须)
		parent::__construct();
		if(!Teacher::isLogin()){
			return $this->error('login fail',url('/index/login'));
		}
		
	}
	
    public function index()
    {
       //return  redirect('/index/teacher');
       return '<p align=center>index系统首页</p>';
    }
}
