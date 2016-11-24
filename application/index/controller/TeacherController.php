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
		try {
		$Teacher = new Teacher();
		$teachers = $Teacher->select();
		// 向V层传数据
		$this->assign('teachers',$teachers);
		// 取回打包后的数据
		$htmls = $this->fetch();
		// 将数据返回给用户
		return $htmls;
		}catch (\Exception $e){
			return '系统错误：'.$e->getMessage();
		}
		
			
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
			return $this->success('新增'.$Teacher->name.'教师成功',url('index'));
		}
		
	
		//return $Teacher->name .' 增加至数据表'.'ID:'. $Teacher->id;		
	}
	
	public function add()
	{
		try {
		$html=$this->fetch();
		return $html;
		}catch (\Exception $e){
			return '系统错误：'.$e->getMessage();
		}
	}
	
	public function edit()
	{
		// 获取传入ID
		$id=Request::instance()->param('id/d');
		
		// 在Teacher表模型中获取当前记录
		$Teacher=Teacher::get($id);
		if(is_null($Teacher)){
			return $this->error('未找到ID为'.$id.'的教师');
		}
		
		// 将数据传给V层
		$this->assign('Teacher',$Teacher);
		
		// 获取封装好的V层内容
		$thmls=$this->fetch();
		
		// 将封装好的V层内容返回给用户
		return $thmls;
	}
	
	public function update()
	{
		/* $teacher=Request::instance()->post();
		
		$Teacher=new Teacher();
		$message='更新成功';
		try{
			if(false===$Teacher->validate(true)->isUpdate()->save($teacher)){
				$message='更新失败:'.$Teacher->getError();
			}
		}catch (\Exception $e){
			$message='更新失败:'.$e->getMessage();
		}
		return $message; */
		
		try{
		// 接收数据，获取要更新的关键字信息
		$id = Request::instance()->post('id/d');
		$message = '更新成功';
		// 获取当前对象
		$teacher = Teacher::get($id);
		if(!is_null($teacher)){
			// 写入要更新的数据
			$teacher->name = Request::instance()->post('name');
			$teacher->username = Request::instance()->post('username');
			$teacher->sex = Request::instance()->post('sex');
			$teacher->email = Request::instance()->post('email');
			// 更新
			if(false === $teacher->validate(true)->save()){
				$message = '更新失败:'.$teacher->getError();
			}
		}else {
			throw new \Exception('所更新记录不存在',1);
		}
		}catch (\Exception $e){
			$message = $e->getMessage();
		}
		return $message;
	}
	
	public function delete()
	{
		//获取pathinfo传入的ID值
		$id=Request::instance()->param('id/d');
		if(is_null($id)||0===$id){
			return $this->error('未获取ID信息');
		}
		//获取要删除的对像
		$Teacher=Teacher::get($id);
		//判断对像是否存在
		if(!is_null($Teacher)){
			if($Teacher->delete()){				
				return $this->success('删除成功',url('index'));
			}
			else {
				return $this->error('删除失败:'.$Teacher->getError());
			}
		}
		else {
			return $this->error('未获取到ID为'.$id.'的教师');
		}
		/* if($count=Teacher::destroy(4)){
			return '共删除'.$count.'条数据';
		}
		else {
			return '删除失败';
		} */
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