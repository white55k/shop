<?php

namespace app\index\controller;

use app\index\model\Address as AddressModel;
use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Address extends Controller
{
	protected $address;
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
		$this->address = new AddressModel;
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
    	$res_address = $this->address->newAddress();

    	$this->assign('res_address', $res_address);

    	return $this->fetch('/new_address');
    }

    public function updateAddr()
    {
    	$res_address = $this->address->updateAddress();

    	$this->assign('res_address', $res_address);

    	return $this->fetch('/new_address');
    }
}
