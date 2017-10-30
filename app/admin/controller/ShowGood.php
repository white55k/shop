<?php

namespace app\admin\controller;

use app\admin\model\Good;
use app\admin\model\Menu;
use app\admin\model\Sort;
use app\admin\model\User;

use think\Controller;

class ShowGood extends Controller
{
	protected $good;
	protected $menu;
	protected $sort;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->menu = new Menu;
		$this->sort = new Sort;
		$this->user = new User;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

    # 查看分类商品
    public function index()
    {
    	$res_menu = $this->menu->selectAll();

    	$this->assign('res_menu', $res_menu);

        return $this->fetch('/product_list');
    }

    # 查询分类商品信息
    public function show()
    {
    	$res_sort = $this->sort->selectAll();
    	$res_good = $this->good->selectGood($res_sort[0]->name);
    	
    	$arr = [];

    	$this->assign('res_sort', $res_sort);
    	$arr[] = $this->fetch('/sort_list');

    	$this->assign('res_good', $res_good);
    	$arr[] = $this->fetch('/good_list');

    	return $arr;
    }

    # 查询商品信息
    public function showGood()
    {
    	$res_good = $this->good->selectAll();

    	$this->assign('res_good', $res_good);

    	return $this->fetch('/good_list');
    }

    # 搜索商品信息
    public function searchGood()
    {
        $res_good = $this->good->searchAll();

        $this->assign('res_good', $res_good);

        return $this->fetch('/good_list');
    }
}
