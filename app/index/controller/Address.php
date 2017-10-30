<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Address as add;
use think\Controller;

class Address extends Controller
{
	# 自定义构造函数
	protected $user;
	protected $address;
	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		$this->address = new add;
	}
	public function address()
	{
		# 搜索所有的收货地址
		$res = $this->address->address();
		return $this->fetch('/address',[
			'res' => $res,
		]);
	}
	public function addAddress()
	{
		$res = $this->address->addAddress();
		return $res;
	}
}
