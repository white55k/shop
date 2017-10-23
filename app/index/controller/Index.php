<?php

namespace app\index\controller;

use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Index extends Controller
{
	protected $figure;
	protected $good;
	protected $menu;
	protected $seckill;
	protected $sort;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->figure = new Figure;
		$this->good = new Good;
		$this->menu = new Menu;
		$this->seckill = new Seckill;
		$this->user = new User;
		$this->sort = new Sort;
	}

    public function index()
    {
    	$res_menu = $this->menu->selectAll();
    	$res_figure = $this->figure->selectAll();
    	$res_good = $this->good->recommend();
    	$res_seckill = $this->seckill->aliveAll();
    	

    	$this->assign('res_menu', $res_menu);
    	$this->assign('res_figure', $res_figure);
    	$this->assign('res_good', $res_good);
    	$this->assign('res_seckill', $res_seckill);
        return $this->fetch('/index');
    }
}
