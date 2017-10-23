<?php

namespace app\index\controller;

use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Sort;
use app\index\model\User;

use think\Controller;

class Introduct extends Controller
{
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
		$this->consume = new Consume;
		$this->figure = new Figure;
		$this->good = new Good;
		$this->menu = new Menu;
		$this->seckill = new Seckill;
		$this->user = new User;
		$this->sort = new Sort;
	}

    public function good()
    {
    	$res_good = $this->good->selectOne();
    	$res_consume_m = $this->consume->monthCount();
    	$res_consume_a = $this->consume->allCount();
    	$res_similar = $this->good->similar();
        $res_all_similar = $this->good->allSimilar();

        $this->assign('res_all_similar', $res_all_similar);
    	$this->assign('res_comment_count', count($res_good->comment));
    	$this->assign('res_consume_a', $res_consume_a);
    	$this->assign('res_consume_m', $res_consume_m);
    	$this->assign('res_good', $res_good);
    	$this->assign('res_param', $res_good->param);
    	$this->assign('res_picture', $res_good->picture);
    	$this->assign('res_taste', $res_good->taste);
    	$this->assign('res_similar', $res_similar);

        return $this->fetch('/introduction');
    }

    public function seckill()
    {
        return $this->fetch('/introduction');
    }
}
