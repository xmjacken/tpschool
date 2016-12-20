<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],		
		// 首页 定位到 Login控制器下的index触发器, 方法为get
		''         => ['Login/index', ['method' => 'get']],
		'login'		=>	['Login/login',['method'	=>	'post']],
		'logout'	=>	['Login/logout',['method'	=>	'get']],
		'teacher/'	=>	['Teacher/index',['method'	=>	'get']],
		'teacher/add'	=>	['Teacher/add',['method'	=>	'get']],
		'teacher/save'	=>	['Teacher/save',['method'	=>	'post']],
		'teacher/edit/:id'	=>	['Teacher/edit',['method'	=>	'get'],['id'	=>	'/d+']],
		'student/'	=>	['Student/index',['method'	=>	'get']],
		'student/add'	=>	['Student/add',['method'	=>	'get']],
		'student/save'	=>	['Student/save',['method'	=>	'post']],
		'student/edit/:id'	=>	['Student/edit',['method'	=>	'get'],['id'	=>	'/d+']],
		'klass/'	=>	['Klass/index',['method'	=>	'get']],
		'klass/add'	=>	['Klass/add',['method'	=>	'get']],
		'klass/save'	=>	['Klass/add',['method'	=>	'post']],
		'klass/edit/:id'	=>	['Klass/add',['method'	=>	'get'],['id'	=>	'/d+']],
		'course/'	=>	['Course/index',['method'	=>	'get']],
		'course/add'	=>	['Course/add',['method'	=>	'get']],
		'course/save'	=>	['Course/save',['method'	=>	'post']],
		'course/edit/:id'	=>	['Course/edit',['method'	=>	'get'],['id'	=>	'/d+']],
		'ldap/'	=>	['Ldap/index',['method'	=>	'get']],
];
