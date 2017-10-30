<?php

namespace app\index\controller;

use app\index\model\Consume;
use app\index\model\Figure;
use app\index\model\Good;
use app\index\model\Menu;
use app\index\model\Seckill;
use app\index\model\Site;
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
    protected $site;
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
        $this->site = new Site;
		$this->sort = new Sort;
        $this->user = new User;

        $res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

    # 查询商品介绍信息
    public function good()
    {
        # 查询商品基本信息
    	$res_good = $this->good->selectOne();
        # 查询商品图片信息
        $res_picture = $this->good->selectPicture();
        # 查询该商品月销量
    	$res_consume_m = $this->consume->monthCount();
        # 查询该商品总销量
    	$res_consume_a = $this->consume->allCount();
        # 查询该商品相似商品
    	$res_similar = $this->good->similar();
        # 查询该商品类似商品
        $res_all_similar = $this->good->allSimilar();
        # 获取商品详细介绍
        $res_details = $res_good->picture->details_picture;
        $res_details = explode(';', $res_details);

        $this->assign('res_all_similar', $res_all_similar);
    	$this->assign('res_comment_count', count($res_good->comment));
    	$this->assign('res_consume_a', $res_consume_a);
    	$this->assign('res_consume_m', $res_consume_m);
    	$this->assign('res_good', $res_good);
    	$this->assign('res_param', $res_good->param);
    	$this->assign('res_picture', $res_picture);
    	$this->assign('res_taste', $res_good->taste);
    	$this->assign('res_similar', $res_similar);
        $this->assign('sid', 0);
        $this->assign('res_details', $res_details);

        return $this->fetch('/introduction');
    }
}
