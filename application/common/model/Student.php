<?php
namespace app\common\model;
use think\Model;

class Student extends Model
{
	protected $dateFormat='Y年m月d日';
	/**
	 * 自定义自转换字换
	 * @var array
	 */
	protected $type=[
			'create_time'=>'datetime',
	];	
	
	public function getSexAttr($value)
	{
		$status=array('0'=>'男','1'=>'女');
		$sex=$status[$value];
		if(isset($sex))
		{
			return $sex;
		}else{
			return $status[0];
		}
	}
	
	public function Klass()
	{
		return $this->belongsTo('Klass');
	}
}