<?php
namespace app\index\controller;

use app\index\model\Address;
use app\index\model\User as UserModel;
use think\Controller;

class ChangeAdd extends Controller
{
	protected $user;
	protected $address;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		$this->address = new Address;
	}
	public function changeAdd()
	{

		return $this->fetch('/changeadd');
	}
	# 编辑收货地址
	public function updateAdd()
	{
		$data = $this->address->updateAdd();
		return $data;
	}
	# 默认收货地址
	public function moren()
	{
		$res = $this->address->changeMoren();
		return $res;
	}
	# 删除收获地址
	public function isReadyDel()
	{
		$res = $this->address->changeDel();
		return $res;
	}
}