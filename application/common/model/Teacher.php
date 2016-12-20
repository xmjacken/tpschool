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
	
	//内部AD登录验证
	static public function ldaplogin($username,$password) {
	
		$ldaprdn  = $username;
		$ldappass = $password;  // associated password
	
		// connect to ldap server
		// $ldapconn = ldap_connect("HOSTNAME.DOMAIN.com")
		$ldapconn = ldap_connect("192.168.100.1")
		or die("Could not connect to LDAP server.");
	
		// Set some ldap options for talking to
		ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3);
		ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0);
		ldap_set_option ($ldapconn, LDAP_OPT_TIMELIMIT,5);
		ldap_set_option($ldapconn, LDAP_OPT_NETWORK_TIMEOUT, 5);
	
		if ($ldapconn) {
	
			// binding to ldap server
			$ldapbind = @ldap_bind($ldapconn, $ldaprdn, $ldappass);
	
			// verify binding
			if ($ldapbind) {
				//echo "LDAP bind successful...\n";
				session('teacherId',$ldaprdn);
				return true;
			} else {
				//echo "LDAP bind failed...\n";
				return false;
			}
		}
	
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