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

class SearchGood extends Controller
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
		$this->site = new Site;
		$this->sort = new Sort;
		$this->user = new User;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

    public function index()
    {
    	$res_good = $this->good->searchPrice();
    	$res_sort = $this->sort->searchSimilar();
    	$res_collect = $this->sort->collect();

    	$this->assign('res_good', $res_good);
    	$this->assign('res_sort', $res_sort);
    	$this->assign('res_collect', $res_collect);

    	return $this->fetch('/search');
    }
}
