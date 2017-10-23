<?php

namespace app\index\controller;

use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
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
		$this->sort = new Sort;
	}

    public function index()
    {
    	$res_car = $this->car->addCar();

    	$this->assign('res_car', $res_car);

    	return $this->fetch('/shopcart');
    }

    public function delQuantity()
    {
    	$res_car = $this->car->delQuantity();
    	return $res_car;
    }

    public function addQuantity()
    {
    	$res_car = $this->car->addQuantity();
    	return $res_car;
    }
}
