<?php

namespace app\index\controller;

use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Index extends Controller
{
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

	# 展示商品首页
    public function index()
    {
    	# 商品所有菜单
    	$res_menu = $this->menu->selectAll();
    	# 首页轮播图
    	$res_figure = $this->figure->selectAll();
    	# 查询前三推荐商品
    	$res_good = $this->good->recommend();
    	# 查询前四秒杀商品
    	$res_seckill = $this->good->seckillGood();
    	# 查询登陆用户基本信息
    	$res_user = $this->user->selectAll();
    	
    	$this->assign('res_menu', $res_menu);
    	$this->assign('res_figure', $res_figure);
    	$this->assign('res_good', $res_good);
    	$this->assign('res_seckill', $res_seckill);
    	$this->assign('res_user', $res_user);
        return $this->fetch('/index');
    }
}
