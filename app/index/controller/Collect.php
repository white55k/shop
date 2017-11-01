<?php

namespace app\index\controller;

use app\index\model\Car;
use app\index\model\Collection;
use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Collect extends Controller
{
	protected $car;
	protected $collection;
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
		$this->collection = new Collection;
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

	# 查询所有收藏商品
    public function index()
    {
    	# 查询所有收藏商品
    	$res_collection = $this->collection->collection();

    	$this->assign('res_collection', $res_collection);

    	return $this->fetch('/collection');
    }

    # 收藏一个商品
    public function addCollect()
    {
    	$res = $this->collection->addCollect();

    	if ($res) {
    		return $this->success('添加收藏成功');
    	}
    	return $this->error('添加收藏失败');
    }

    # 取消一个商品的收藏
    public function delCollect()
    {
    	$res = $this->collection->delCollect();

    	if ($res) {
    		return $this->success('取消成功');
    	}
    	return $this->error('取消失败');
    }
}
