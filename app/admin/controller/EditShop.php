<?php

namespace app\admin\controller;

use app\admin\model\Good;
use app\admin\model\Sort;
use app\admin\model\User as UserModel;

use think\Controller;

class EditShop extends Controller
{
	protected $good;
	protected $sort;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->sort = new Sort;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

    public function index()
    {
    	$res_good = $this->good->selectOne();

    	$this->assign('res_good', $res_good);

    	return $this->fetch('/product_detail');
    }

    public function updateShop()
    {
    	$res = $this->good->updateShop();
    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('数据未变动');
    }

    public function newShop()
    {
    	$res_menu = $this->sort->allSelect();

    	$this->assign('res_menu', $res_menu);

    	return $this->fetch('/new_product');
    }

    public function addShop()
    {
    	$res = $this->good->addShop();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('添加成功');
    	}

    	return $this->error('添加失败');
    }

    public function delShop()
    {
    	$res = $this->good->delShop();

    	if ($res) {
    		return $this->success('删除成功');
    	}
    	return $this->error('删除失败了');
    }
}
