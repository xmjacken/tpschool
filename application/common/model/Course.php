<?php
namespace app\common\model;
use think\Model;

class Course extends Model
{
	protected $dateFormat = 'Y年m月d日';
	protected $type = [
		'create_time' => 'datetime',	
	];
	
	public function Klasses()
	{
		return $this->belongsToMany('Klass',config('database.prefix').'Klass_Course');
	}
	
	/**
	 * 一对多关联
	 * */
	public function KlassCourses()
	{
		return $this->hasMany('KlassCourse');
	}
	
	public function getIsChecked(Klass &$Klass)
	{
		$klassId=(int)$Klass->id;
		$courseId=(int)$this->id;
		
		$map = array();
		$map['klass_id'] = $klassId;
		$map['course_id'] = $courseId;
		
		$KlassCourse = KlassCourse::get($map);
		if(is_null($KlassCourse))
		{
			return false;			
		}else {
			return true;
		}		
	}
}