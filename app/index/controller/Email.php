<?php
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;

class Email extends Controller
{
	# 自定义一个构造函数
	protected $User;

	public function _initialize()
	{
		parent::_initialize();

		$this->user = new UserModel;
	}
	public function email()
	{
		$result = $this->user->message();
		$email = $result['email'];
		return $this->fetch('/email',['email' => $email]);
	}
}
