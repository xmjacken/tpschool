<?php
namespace app\index\controller;
use think\Controller;

class LdapController extends Controller
{
	public function index()
	{
	$username  = 'dragonpxm\jklai';   // AD账号
	$password   = 'xltl6095';                   // 这是登入用的密码
	
	// 然后是连接AD服务器，这里你需要知道AD服务器的 IP 或者域名
	$conn = ldap_connect('192.168.100.2') or die('无法连接AD服务器'); // 这里填你AD的IP，填域名亦可，	
	if ($conn)
	{
		$bind = ldap_bind($conn,$username, $password); // 如果连接了，那么就试着登入一下
		var_dump($bind);
		if ($bind)
		{
			return  "验证通过，是DAC的良民";
		} else {
			return "验证失败，哪来的猴头~~";
		}
	}
	}
}