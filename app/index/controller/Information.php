<?php

namespace app\index\controller;

use app\index\model\User as UserModel;

use think\Controller;
use think\Db;
class Information extends Controller
{
	# 自定义一个构造函数
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
	}
	
	public function information()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 会员等级
		$level = $this->user->findLevel();
		$findLevel = $level->level->appellation;
		$result = $this->user->message();
		# 会员头像
		$pic = $result['picture'];
		# 电话 
		$phone = $result['phone'];
		# 邮箱
		$email = $result['email'];
		# 账户安全分
		$score = $result['safe_score'];
		$name = $result['realname'];

		$birthday = $result['birthday'];
		$phone = $result['phone'];
		$email = $result['email'];

		$question = $result['question'];
		$answer = $result['answer'];

		return $this->fetch('/information',[
			'gold'  => $findLevel,
			'pic' =>$pic,
			'username' => $username,
			'phone'  => $phone,
			'email'  => $email,
			'safe_score' => $score,
		]);
	}
	# 更改头像

	public function changePic()
	{
		$res = $this->user->changePic();
		if ($res) {
			return  $this->success('成功');
		} else {
			return  $this->error('失败');
		}
	}
	# 更改用户信息
	public function dochange()
	{
		$case = $this->user->change();
		return $case;
	}

}