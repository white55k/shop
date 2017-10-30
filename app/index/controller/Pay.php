<?php

namespace app\index\controller;

use app\index\model\Address;
use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Coupon;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Pay extends Controller
{
	protected $address;
	protected $car;
	protected $consume;
	protected $coupon;
	protected $figure;
	protected $good;
	protected $menu;
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
		$this->seckill = new Seckill;
        $this->site = new Site;
		$this->sort = new Sort;
        $this->user = new User;

        $res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 查询支付页面所有信息
    public function index()
    {
    	# 查询用户所有收货地址信息
    	$res_address = $this->address->getAddress();
    	# 获取选定商品信息
    	$res_car = $this->car->selectAll();
    	# 获取选定商品总价格
    	$res_money = $this->car->selectMoney();
    	# 查询用户所有优惠券
    	$res_coupon = $this->coupon->selectAll();

    	$this->assign('res_address', $res_address);
    	$this->assign('res_car', $res_car);
    	$this->assign('res_money', $res_money);
    	$this->assign('res_coupon', $res_coupon);

    	return $this->fetch('/pay');
    }

    # 查询支付页面所有信息
    public function show()
    {
    	# 查询用户所有收货地址信息
    	$res_address = $this->address->getAddress();
    	# 获取选定商品信息
    	$res_car = $this->car->selectOne();
    	# 获取选定商品总价格
    	$res_money = $this->car->selectPrice();
    	# 查询用户所有优惠券
    	$res_coupon = $this->coupon->selectAll();

    	$this->assign('res_address', $res_address);
    	$this->assign('res_car', $res_car);
    	$this->assign('res_money', $res_money);
    	$this->assign('res_coupon', $res_coupon);

    	return $this->fetch('/pay');
    }
}
