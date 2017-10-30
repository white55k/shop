<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use app\index\model\Order as OrderAll;
use think\Controller;

class Order extends Controller
{
	# 自定义一个构造函数
	protected $user;
	protected $order;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		$this->order = new OrderAll;

	}
	# 首页
	public function order()
	{
		$res = $this->order->findAll();
		$close = $this->order->closeAll();
		$ready = $this->order->readyAll();
		$readySend = $this->order->readySend();
		return $this->fetch('/order',[
			'order' => $res,
			'close' => $close,
			'ready' => $ready,
			'readySend' => $readySend,
		]);
	}
}