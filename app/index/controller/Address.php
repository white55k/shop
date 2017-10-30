<?php

namespace app\index\controller;

use app\index\model\Address as AddressModel;
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

class Address extends Controller
{
	protected $address;
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
		$this->address = new AddressModel;
		$this->car = new Car;
		$this->consume = new Consume;
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

	# 添加新收货地址
    public function index()
    {
    	# 添加收货新地址
    	$res_address = $this->address->newAddress();
    	if (is_string($res_address)) {
    		return false;
    	}

    	$this->assign('res_address', $res_address);

    	return $this->fetch('/new_address');
    }

    # 更改收货地址
    public function updateAddr()
    {
    	# 更改收货地址
    	$res_address = $this->address->updateAddress();
    	if (is_string($res_address)) {
    		return false;
    	}

    	$this->assign('res_address', $res_address);

    	return $this->fetch('/new_address');
    }

    # 删除收货地址
    public function delAddr()
    {
    	$res = $this->address->delAddr();
    	if (!$res) {
    		return $this->error('删除失败');
    	}
    	return $this->success('删除成功');
    }

    # 修改默认地址
    public function defaultAddr()
    {
    	$res_address = $this->address->defaultAddr();
    	return $res_address;
    	$this->assign('res_address', $res_address);

    	return $this->fetch('/new_address');
    }
}
