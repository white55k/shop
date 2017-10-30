<?php

namespace app\admin\controller;

use app\admin\model\Good;
use app\admin\model\Order as OrderModel;
use app\admin\model\User as UserModel;

use think\Controller;

class Order extends Controller
{
	protected $good;
	protected $order;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->order = new OrderModel;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 展示订单列表页
    public function index()
    {
    	$res_order = $this->order->selectAll();

    	$this->assign('res_order', $res_order);

    	return $this->fetch('/order_list');
    }

    # 展示订单状态订单
    public function showOrder()
    {
    	$res_order = $this->order->showOrder();

    	$this->assign('res_order', $res_order);

    	return $this->fetch('/order_page');
    }

    # 展示搜索订单
    public function searchOrder()
    {
    	$res_order = $this->order->searchOrder();

    	$this->assign('res_order', $res_order);

    	return $this->fetch('/order_page');
    }

    # 删除一个订单
    public function delOrder()
    {
    	$res = $this->order->delOrder();

    	if ($res) {
    		return $this->success('删除成功');
    	}
    	return $this->error('删除失败');
    }
}
