<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;

class Password extends Controller
{
	# 自定义构造函数
	protected $User;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
	}

	# 修改密码主页
	public function change()
	{
		$username = session('username') ? session('username') : cookie('username');
		return $this->fetch('/password',[
			'username' => $username,
		]);
	}
	# 修改密码
	public function exchange()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 查找密码判断原始密码是否正确
		$result = $this->user->message();
		$password = $result['password'];
		$oldpwd = md5(input('post.password'));
		if ($oldpwd != $password) {
			return "3";
		}
		$res = $this->user->newpwd();
		return $res;
	}
}