<?php

namespace app\index\controller;

use app\index\model\Address;
use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Coupon;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Order as OrderModel;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Order extends Controller
{
	protected $address;
	protected $car;
	protected $consume;
	protected $coupon;
	protected $figure;
	protected $good;
	protected $menu;
    protected $order;
	protected $seckill;
	protected $site;
	protected $sort;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->address = new Address;
		$this->car = new Car;
		$this->consume = new Consume;
		$this->coupon = new Coupon;
		$this->figure = new Figure;
		$this->good = new Good;
		$this->menu = new Menu;
        $this->order = new OrderModel;
		$this->seckill = new Seckill;
		$this->site = new Site;
		$this->sort = new Sort;
		$this->user = new User;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 查询支付结果页面所有信息
    public function index()
    {
    	$res_address = $this->order->addOrder();

        $this->assign('res_address', $res_address);
        $this->assign('money', input('param.money'));

    	return $this->fetch('/success');
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
