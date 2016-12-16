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
}