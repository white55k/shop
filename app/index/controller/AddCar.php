<?php

namespace app\index\controller;

use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class AddCar extends Controller
{
	protected $car;
	protected $consume;
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
		$this->car = new Car;
		$this->consume = new Consume;
		$this->figure = new Figure;
		$this->good = new Good;
		$this->menu = new Menu;
		$this->seckill = new Seckill;
		$this->user = new User;
		$this->site = new Site;
        $this->sort = new Sort;

        $res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 添加到购物车
    public function index()
    {
    	# 添加购物车并查询购物车所有商品
    	$res_car = $this->car->addCar();

    	$this->assign('res_car', $res_car);

    	return $this->fetch('/shopcart');
    }

    # 添加商品到购物车
    public function addCar()
    {
    	$res = $this->car->addToCar();

    	if ($res) {
    		return $this->success('添加成功');
    	}
    	return $this->error('添加失败');
    }

    # 减少购物车商品数
    public function delQuantity()
    {
    	$res_car = $this->car->delQuantity();
    	return $res_car;
    }

    # 增加购物车商品数
    public function addQuantity()
    {
    	$res_car = $this->car->addQuantity();
    	return $res_car;
    }
}
