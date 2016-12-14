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
		var_dump(Request::instance()->post());
	}
	
	public  function  edit()
	{
		
	}
}