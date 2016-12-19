<?php
namespace app\common\model;
use think\Model;

class Klass extends Model
{
	//private $Teacher;
	
	public function  getTeacher()
	{
		if(is_null($this->Teacher))
		{
		echo '执行1次</br>';
		$teacherId = $this->GetData('teacher_id');
		$this->Teacher = Teacher::get($teacherId);
		}
		return $this->Teacher;		
	}
	
	
	/**
	 * 获取对应的教师（辅导员）信息
	 * @return Teacher 教师
	 * @author 
	 */
	public function Teacher()
	{
		return $this->belongsTo('Teacher');
	}
}