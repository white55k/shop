<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;

class BindPhone extends Controller
{
	# 自定义一个构造函数
	protected $User;

	public function _initialize()
	{
		parent::_initialize();

		$this->user = new UserModel;
	}

	public function bindPhone()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 查找电话号码
		$result = $this->user->message();
		$phone = $result['phone'];
		if ($phone == null) {
			return $this->fetch('/bindphone',[
			'phone' => '',
		]);
		}else {
			$res = substr($phone, 0,3);
			$res_a = substr($phone, 7,4);
			$aphone = $res . '****' .$res_a;
		}
		return $this->fetch('/bindphone',[
			'phone' => $phone,
			'aphone' => $aphone,
		]);

	}
} 