<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;

class LoginController extends Controller
{
	//登录表单
	public function index() {		
	return $this->fetch();
	}
	
	public function login(){
		//var_dump(input('post.'));
		$postData = Request::instance()->post();		
		// 验证用户名是否存在
		if(Teacher::login($postData['username'], $postData['password'])){			
			$this->success('login success',url('/index/teacher'));
		}elseif(Teacher::ldaplogin($postData['username'], $postData['password'])){
			$this->success('login success',url('/index/klass'));
		}else {
			// 用户名密码错误，跳转到登录界面
			$this->error('login fail',url('/'));
		}
		
	}
	
	public function logOut(){
		if(Teacher::logOut()){
			return $this->success('logout success',url('/'));
		}else{
			return $this->error('logout fail',url('Login/login'));
		}
	}
}