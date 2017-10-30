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

class Search extends Controller
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

	# 搜索商品页面
    public function index()
    {
    	# 查询所有搜索商品
    	$res_good = $this->good->searchAll();
    	# 不存在的商品返回错误页面
    	if (!$res_good) {
    		return $this->error('商品不存在');
    	}
    	# 查询搜索商品的相似商品
    	$res_sort = $this->sort->searchSimilar();
    	# 查询商品搭配
    	$res_collect = $this->sort->collect();

    	$this->assign('res_good', $res_good);
    	$this->assign('res_sort', $res_sort);
    	$this->assign('res_collect', $res_collect);

    	return $this->fetch('/search');
    }
}
