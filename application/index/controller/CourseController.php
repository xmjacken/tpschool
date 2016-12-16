<?php
namespace app\index\controller;
use app\common\model\Course;
use think\Request;
use app\common\model\Klass;
use app\common\model\KlassCourse;

class CourseController extends IndexController
{
	public function index()
	{
		$name = Request::instance()->get('name');
		$pagesize = 1;
		$Course = new Course();
		if(!empty($name))
		{
			$Course->where('name','like','%'.$name.'%');
		}
		
		$courses = $Course->paginate($pagesize,false,['query'=>['name'=>$name]]);
		$this->assign('courses',$courses);
		return $this->fetch();
	}
	
	public function add()
	{
		//$klasses=Klass::all();
		$this->assign('Course',new Course);
		return $this->fetch();
	}
	
	public function save()
	{
		//保存课程
		$Course = new Course();
		$Course->name = Request::instance()->post('name');
		//验证
		if(!$Course->validate(true)->save($Course->getData()))
		{
			return $this->error('保存课程错误：'.$Course->getError());
		}
		
		// 利用klass_id这个数组，拼接为包括klass_id和course_id的二维数组。
		$klassIds = Request::instance()->post('klass_id/a'); // /a表示获取的类型为数组
		if(!is_null($klassIds))
		{
			if(!$Course->Klasses()->saveAll($klassIds))
			{
				return $this->error('保存 班级-课程信息错误：'.$Course->Klasses()->getError());
			}
			/*
			$datas = array();
			foreach ($klassIds as $klassId)
			{
				$data = array();
				$data['klass_id'] = $klassId;
				$data['course_id'] = $Course->id;
				array_push($datas,$data);
			}
			// 利用saveAll()方法，来将二维数据存入数据库。
			if(!empty($datas))
			{
				$KlassCourse = new KlassCourse();
				if(!$KlassCourse->validate(true)->saveAll($datas))
				{
					return $this->error('保存 班级-课程信息错误：'.$KlassCourse->getError());
				}
				unset($KlassCourse);
			}*/
		}
		// -------------------------- 新增班级课程信息(end) --------------------------
		unset($Course);
		return $this->success('操作成功',(url('/index/course')));
	}
}