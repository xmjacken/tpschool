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
		}else {
			$Teacher = new Teacher();
			echo $Teacher->encriptPassword($postData['password']);
			// 用户名密码错误，跳转到登录界面
			$this->error('login fail',url('index'));
		}
		
	}
}