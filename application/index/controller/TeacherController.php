<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use app\common\model\Teacher;

class TeacherController extends Controller
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
		$Teacher = new Teacher();
		$teachers = $Teacher->select();
		$this->assign('teachers',$teachers);
		$htmls = $this->fetch();
		return $htmls;
		
			
		//echo  'hi eyoung';
// 		$JiaoShiBiao = new Teacher();
// 		$SuoYouJiaoShi = $JiaoShiBiao->select();
// 		$JiaoShiZhangSan = $SuoYouJiaoShi[0];
// 		//var_dump($JiaoShiZhangSan->getData('name'));
// 		echo '教师姓名：'. $JiaoShiZhangSan->getData('name') .'<br>';
// 		return '重复一遍，教师姓名：' . $JiaoShiZhangSan->getData('name');
	}
	
	public function insert()
	{
		//var_dump($_POST);
		//$postData = Request::instance()->post();
		$postData = $this->request->post();
		//var_dump($postData);
		//return;
		$Teacher = new Teacher();
		$Teacher->name=$postData['name'];
		$Teacher->username=$postData['username'];
		$Teacher->sex=$postData['sex'];
		$Teacher->email=$postData['email'];	
		
		//$Teacher = new Teacher();
		//$state = $Teacher->data($teacher)->save();
		
		//$Teacher->save();
		$result = $Teacher->validate(true)->save($Teacher->getData());		
		if(false===$result)
		{
			return '新增失败:' . $Teacher->getError();
		}
		else 
		{
			return '新增成功，新ID为：'.$Teacher->id;
		}
		
	
		//return $Teacher->name .' 增加至数据表'.'ID:'. $Teacher->id;		
	}
	
	public function add()
	{
		$html=$this->fetch();
		return $html;
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