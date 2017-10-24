<?php

namespace app\index\controller;

use app\index\model\Coupon;
use app\index\model\Order;
use app\index\model\Collection;
use think\Controller;
class Center extends Controller
{
	# 自定义一个构造函数
	protected $Coupon;
	protected $Collection;
	protected $Order;

	public function _initialize()
	{
		parent::_initialize();
		$this->order = new Order;
		$this->coupon = new Coupon;
		$this->collection = new Collection;

	}

	# 个人中心
	public function center()
	{
		# 优惠券
		$res = $this->coupon->selectAll();
		$coupon = count($res);
		# 我的订单(代付款)
		$res_order = $this->order->orderAll();
		$order = count($res_order);
		# 代发货
		$res_express = $this->order->inExpress();
		$inexpress = count($res_express);
		# 待收货 delivery
		$res_delivery = $this->order->delivery();
		$count_de = count($res_delivery);
		# 我的收藏
		$res_collection = $this->collection->collection();
		return $this->fetch('/center',[
			'coupon'   => $coupon,
			'order'    => $order,
			'express'  => $inexpress,
			'delivery' => $count_de,

		]);
	}
	
}