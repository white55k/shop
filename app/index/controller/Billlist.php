<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Consume;
use think\Controller;

class Billlist extends Controller
{
	# 自定义一个构造函数
	protected $user;
	protected $consume;
	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		$this->consume = new Consume;
	}
	public function billlist()
	{
		$bill_details = $this->consume->chaKan();
		return $this->fetch('/billlist',['bill_details' => $bill_details]);
	} 
	# 查看选定期限的账单明细
	public function chaKan()
	{
		$bill_details = $this->consume->chaKan();
		return $this->fetch('/bill_details',['bill_details' => $bill_details]);
	}
	# 删除交易

	public function dele()
	{
		$res = $this->consume->deleConsume();
		if ($res) {
			return $this->success('删除成功');
		} else {
			return $this->error('删除失败');
		}
	}

}
