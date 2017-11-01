<?php

namespace app\index\controller;

use app\index\model\Car;
use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Foot as FootModel;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Foot extends Controller
{
	protected $car;
	protected $consume;
	protected $figure;
    protected $foot;
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
        $this->foot = new FootModel;
		$this->good = new Good;
		$this->menu = new Menu;
		$this->seckill = new Seckill;
		$this->site = new Site;
		$this->sort = new Sort;
		$this->user = new User;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 查询所有收藏商品
    public function index()
    {
    	# 查询所有收藏商品
    	$res_foot = $this->foot->selectAll();

    	$this->assign('res_foot', $res_foot);

    	return $this->fetch('/foot');
    }
}
