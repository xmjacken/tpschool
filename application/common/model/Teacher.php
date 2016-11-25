<?php
namespace app\common\model;
use think\Model;

class Teacher extends Model
{
	static public function login($username,$password){
		$map = array('username'=>$username);
		$Teacher = self::get($map);
		if(!is_null($Teacher)){
			if($Teacher->checkPassword($password)){
				session('teacherId',$Teacher->getData('id'));
				return true;
			}
			
		}
		return false;
	}
	
	public function checkPassword($password){
		if($this->getData('password') === $this->encriptPassword($password))
		{
			return true;
		}
		return false;		
	}
	
	public function encriptPassword($password){
		if(!is_string($password)){
			throw new \RuntimeException('传入变量非字符串');
		}
		return sha1(md5($password).'jackeneyoung');
	}
	
	static public function logOut(){
		session('teacherId',null);
		return true;
	}
	
	static public function isLogin(){
		$teacherId = session('teacherId');
		if(isset($teacherId)){
			return true;
		}
		return false;
	}
}