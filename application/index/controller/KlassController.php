<?php
namespace app\index\controller;
use app\common\model\Klass;
use think\Request;
use app\common\model\Teacher;

class KlassController extends IndexController
{
	public function index()	
	{
		$name = Request::instance()->get('name');
		$pagesize = 2 ;
		$Klass = new Klass();
		if(!empty($name))
		{
			$Klass->where('name','like','%'.$name.'%');
		}
		$klasses = $Klass->paginate($pagesize,false,['query'=>['name'=>$name]]);		
		$this->assign('klasses',$klasses);
		return $this->fetch();
	}	
	
	
	public  function  add()
	{
		$teachers = Teacher::all();
		$this->assign("teachers",$teachers);
		return $this->fetch();
	}
	
	public function save()
	{
		//var_dump(Request::instance()->post());
		$Request = Request::instance();
		$Klass = new Klass();
		$Klass->name = $Request->post('name');
		$Klass->teacher_id = $Request->post('teacher_id/d');
		if(!$Klass->validate(true)->save($Klass->getData()))		
		{
			return $this->error('数据添加错误：'.$Klass->getError());
		}
		return $this->success('添加成功',url('/index/klass'));
	}
	
	public  function  edit()
	{
		$id = Request::instance()->param('id/d');
		
		$teachers = Teacher::all();
		$this->assign('teachers',$teachers);
		
		if(false == $Klass = Klass::get($id))
		{
			return $this->error('未找到ID为'.$id.'的记录');
		}
		$this->assign('Klass',$Klass);
		return $this->fetch();
	}
	
	public  function  update()
	{
		$id = Request::instance()->post('id');
		
		$Klass = Klass::get($id);
		if(is_null($Klass))
		{
			return $this->error('找不到ID为'.$id.'的记录');
		}
		$Klass->name = Request::instance()->post('name');
		$Klass->teacher_id = Request::instance()->post('teacher_id');
		if($Klass->validate()->save($Klass->getData()))
		{
			return $this->success('操作成功',url('/index/klass'));
		}else{
			return $this->error('保存错误：'.$Klass->getError());
		}
	}
	
	public function delete()
	{
		$id=Request::instance()->param('id/d');
		if(is_null($id)||0===$id)
		{
			return $this->error('未找到记录');
		}
		$Klass=Klass::get($id);
		if(is_null($Klass))
		{
			return $this->error('未找到记录');
		}
		if($Klass->delete())
		{
			return $this->success('操作成功',url('/index/klass'));
		}else 
		{
			return $this->error('删除失败');
		}
	}
	
	public function logOut(){
		if(Teacher::logOut()){
			return $this->success('logout success',url('/index'));
		}else{
			return $this->error('logout fail',url('/index'));
		}
	}
	
	//导出用户
	public function excel_action()
	{
		$xlsName  = "Klass";
		$xlsCell  = array(
				array('id','ID号'),
				array('name','班级名称'),
				array('teacher_id','老师ID'),
				array('create_time','注册时间')
		);
		//$xlsData=Teacher::all();
		$xlsData  =db("klass")->where("teacher_id",1)->select();
		exportExcel($xlsName,$xlsCell,$xlsData);
	}
}