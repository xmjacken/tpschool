<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;

class TeacherController extends IndexController
{
	public function index2()
	{
		//return '<style type="text/css">*{ padding: 0; margin: 0; } .think_default_text{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">Hello tpSchool</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
		//$teachers = DB::name('teacher')->select();
		//var_dump($teachers[1]);
		//echo $teachers[0]['name'];
		//return $teachers[1]['name'];
	}
	
	public  function index()
	{
		
		$name = Request::instance()->get('name');
		$pageSize = 2 ;
		$Teacher = new Teacher();
		if(!empty($name))
		{
			$Teacher->where('name','like','%'.$name.'%');
		}
		
		// 打印$Teacher 至控制台
		trace($Teacher,'debug');
		
		//$teachers = $Teacher->select();
		$teachers = $Teacher->paginate($pageSize,false,['query'=>['name'=>$name]]);
		// 向V层传数据
		$this->assign('teachers',$teachers);
		// 取回打包后的数据
		$htmls = $this->fetch();
		// 将数据返回给用户
		return $htmls;
	}
	
	private function saveTeacher(Teacher &$Teacher,$isUpdate=false)
	{
		$Teacher->name = input('post.name');
		$Teacher->sex = input('post.sex/d');
		if(!$isUpdate)
		{
			$Teacher->username = input('post.username');
		}
		$Teacher->email = input('post.email');
		if(!empty(Request::instance()->post('password')))
		{
			$Teacher->password = $Teacher->encriptPassword(input('post.password')) ;
		}
		
		return $Teacher->validate(true)->save($Teacher->getData());
	}
	
	public function save()
	{	
		$Teacher = new Teacher();
		if(!$this->saveTeacher($Teacher))
		{
			return $this->error('操作失败'.$Teacher->getError());
		}
		return $this->success('操作成功',url('/index/teacher'));
		/*
		$postData = $this->request->post();
		
		$Teacher = new Teacher();
		$Teacher->name=$postData['name'];
		$Teacher->username=$postData['username'];		
		$Teacher->sex=$postData['sex'];
		$Teacher->email=$postData['email'];	
		$Teacher->password= $Teacher->encriptPassword($postData['password']);		
		
		$result = $Teacher->validate(true)->save($Teacher->getData());		
		if(false===$result)
		{
			return '新增失败:' . $Teacher->getError();
		}
		else 
		{
			return $this->success('新增'.$Teacher->name.'教师成功',url('index'));
		}
		*/
	}
	
	public function update()
	{
		$id = Request::instance()->post('id/d');
		$Teacher = Teacher::get($id);
	
		if(!is_null($Teacher))
		{
			if(!$this->saveTeacher($Teacher,true))
			{
				return $this->error('操作失败'.$Teacher->getError());
			}
		}else {
			return $this->error('操作记录不存在：'.$Teacher->getError());
		}
		return $this->success('操作成功',url('/index/teacher'));
	
		/*
			try{
			// 接收数据，获取要更新的关键字信息
			$id = Request::instance()->post('id/d');
			$message = '更新成功';
			// 获取当前对象
			$teacher = Teacher::get($id);
			if(!is_null($teacher)){
			// 写入要更新的数据
			$teacher->name = Request::instance()->post('name');
			$teacher->username = Request::instance()->post('username');
			$teacher->sex = Request::instance()->post('sex');
			$teacher->email = Request::instance()->post('email');
			if(!empty(Request::instance()->post('password')))
			{
			$teacher->password = $teacher->encriptPassword(Request::instance()->post('password'));
			}
				
			// 更新
			if(false === $teacher->validate(true)->save()){
			$message = '更新失败:'.$teacher->getError();
			}
			else {
			$message = $message . "<script type='text/javascript'>setTimeout(window.location.href='/index/teacher',10)
			</script>" ;
			}
			}else {
			throw new \Exception('所更新记录不存在',1);
			}
			}catch (\Exception $e){
			$message = $e->getMessage();
			}
			return $message;
			*/
	}
	
	public function add()
	{
		$Teacher = new Teacher();
		$Teacher->id = 0;
		$Teacher->name = '';
		$Teacher->username = '';
		$Teacher->password = '';
		$Teacher->sex = '0';
		$Teacher->email = '';
		$this->assign('Teacher',$Teacher);
		try {
		$html=$this->fetch('edit');
		return $html;
		}catch (\Exception $e){
			return '系统错误：'.$e->getMessage();
		}
	}
	
	public function edit()
	{
		try{
		// 获取传入ID
		$id=Request::instance()->param('id/d');
		
		// 在Teacher表模型中获取当前记录
		$Teacher=Teacher::get($id);
		if(is_null($Teacher)){
			return $this->error('未找到ID为'.$id.'的教师');
		}
		
		// 将数据传给V层
		$this->assign('Teacher',$Teacher);
		
		// 获取封装好的V层内容
		$thmls=$this->fetch();
		
		// 将封装好的V层内容返回给用户
		return $thmls;
		}catch (\think\exception\HttpResponseException $e){
			throw $e;			
		}
		catch (\Exception $e){
			return $e->getMessage();
		}
	}
	
	
	
	public function delete()
	{
		
		//获取pathinfo传入的ID值
		$id=Request::instance()->param('id/d');
		if(is_null($id)||0===$id){
			return $this->error('未获取ID信息');
		}
		//获取要删除的对像
		$Teacher=Teacher::get($id);
		//判断对像是否存在
		if(!is_null($Teacher)){
			if($Teacher->delete()){				
				return $this->success('删除成功',url('index'));
			}
			else {
				return $this->error('删除失败:'.$Teacher->getError());
			}
		}
		else {
			return $this->error('未获取到ID为'.$id.'的教师');
		}
		
	}
	
	public function logOut(){
		if(Teacher::logOut()){
			return $this->success('logout success',url('/index/login'));			
		}else{
			return $this->error('logout fail',url('/index/login'));
		}
	}
	
	//导出用户
	public function excel_action()
	{
		$xlsName  = "Teacher";
		$xlsCell  = array(
				array('id','ID号'),
				array('username','登录账户'),
				array('sex','性别'),
				array('create_time','注册时间')
		);
		//$xlsData=Teacher::all();
		$xlsData  =db("teacher")->where("sex",1)->select();
		exportExcel($xlsName,$xlsCell,$xlsData);
	}
	
	public function test()
	{
		$data = array();
		$data['username']='a';
		$data['name']='test';
		$data['sex']='1';
		$data['email']='test@ey.com';
		var_dump($this->validate($data, 'Teacher'));
	}
	
}