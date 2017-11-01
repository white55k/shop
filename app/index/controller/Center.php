<?php

namespace app\index\controller;

use app\index\model\Collection;
use app\index\model\Coupon;
use app\index\model\Good;
use app\index\model\Order;
use app\index\model\Site;

use think\Controller;

class Center extends Controller
{
	protected $collection;
	protected $coupon;
	protected $good;
	protected $order;
	protected $site;
	
	public function _initialize()
	{
		parent::_initialize();
		$this->collection = new Collection;
		$this->coupon = new Coupon;
		$this->good = new Good;
		$this->order = new Order;
		$this->site = new Site;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
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
		# 今日新品
		$newtoday = $this->good->newtoday();
		# 热卖推荐
		$hotshop = $this->order->hotshop();
		return $this->fetch('/center',[
			'coupon'   => $coupon,
			'order'    => $order,
			'express'  => $inexpress,
			'delivery' => $count_de,
			'res_collection' => $res_collection,
			'time' => time(),
			'week' =>["日","一","二","三","四","五","六"],
			'a' => date('w'),
			'newtoday' => $newtoday,
			'hotshop' => $hotshop,
		]);
	}
}