<?php
namespace app\index\controller;
use app\common\model\Student;
use app\admin\controller\IndexController;
use think\Request;
use app\common\model\Klass;


class StudentController extends IndexController
{
	public function index()
	{
		$name = Request::instance()->get('name');
		$pagesize = 2 ;
		$Student = new Student();
		if(!empty($name))
		{
			$Student->where('name','like','%'.$name.'%');
		}
		$students = $Student->paginate($pagesize,false,['query'=>['name'=>$name]]);
		$this->assign('students',$students);
		return $this->fetch();
	}
	
	public function add()
	{
		$klasses=Klass::all();
		$this->assign('klasses',$klasses);
		return $this->fetch();
	}
	
	public function save()
	{
		$Request = Request::instance();
		$Student = new Student();
		$Student->name = $Request->post('name');
		$Student->num = $Request->post('num');
		$Student->sex=$Request->post('sex');
		$Student->klass_id=$Request->post('klass_id');
		$Student->email=$Request->post('email');
		
		if($Student->validate(true)->save($Student->getData()))
		{
			return $this->success('操作成功',url('/index/student'));			
		} else{
			return $this->error('保存错误：'.$Student->getError());
		}
	}
	
	public function delete()
	{
		$id = Request::instance()->param('id/d');
		if(is_null($id)||0===$id)
		{
			return $this->error('未找记录');
		}
		$Student = Student::get($id);
		if(is_null($Student))
		{
			return $this->error('未找记录');
		}
		if($Student->delete())
		{
			return $this->success('操作成功',url('/index/student'));
		}
		return $this->error('操作错误'.$Student->getError());
	}
	
	public function edit()
	{
		$id=Request::instance()->param('id/d');
		$Student=Student::get($id);
		// 判断是否存在当前记录
		if(is_null($Student))
		{
			return $this->error('找不到ID为'.$id.'记录');
		}
		// 取出班级列表
		$klasses=Klass::all();		
		$this->assign('klasses',$klasses);
		
		$this->assign('Student',$Student);
		return $this->fetch();
	}
	
	public function update()
	{
		$id = Request::instance()->post('id/d');
		$Student = Student::get($id);
		
		if(is_null($Student))
		{
			return $this->error('不存在ID为'.$id.'的记录');
		}
		$Student->name = Request::instance()->post('name');
		$Student->sex = Request::instance()->post('sex');
		$Student->num = Request::instance()->post('num');
		$Student->klass_id = Request::instance()->post('klass_id');
		$Student->email = Request::instance()->post('email');
		
		if($Student->validate()->save($Student->getData()))
		{
			return $this->success('操作成功',url('/index/student'));
		} else{
			return $this->error('保存错误:'.$Student->getError());
		}
	}
}