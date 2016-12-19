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
		$pagesize = 2;
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
	
	public function edit()
	{
		$id = Request::instance()->param('id/d');
		$Course = Course::get($id);
		if (is_null($Course))
		{
			return $this->error('id为:'.$id.'的课程不存在。');
		}
		$this->assign('Course',$Course);
		return $this->fetch();		
	}
	
	public function update()
	{
		//var_dump(Request::instance()->post());
		// 获取当前课程
		$id = Request::instance()->post('id/d');
		$Course = Course::get($id);
		if(is_null($Course))
		{
			return $this->error('不存在ID为：'.$id.'的课程');
		}
		//更新课程名称
		$Course->name = Request::instance()->post('name');
		if(is_null($Course->validate(true)->save($Course->getData())))
		{
			return $this->error('课程名更新错误：'.$Course->getError());
		}
		
		//删除原有信息
		
		$map=['course_id'=>$id];
		if(false===$Course->KlassCourses()->where($map)->delete())
		{
			return $this->error('删除关联课程班级信息错误：'.$Course->getError());
		}
		// 增加新增数据，执行添加操作。
		$klassIds = Request::instance()->post('klass_id/a');
		if(!is_null($klassIds))
		{
			if(!$Course->Klasses()->saveAll($klassIds))
			{
				return $this->error('课程-班级信息保存错误：'.$Course->getError());
			}
		}
		return $this->success('操作成功',url('/index/course'));
	}
}