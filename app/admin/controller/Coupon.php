<?php

namespace app\admin\controller;

use app\admin\model\Coupon as CouponModel;
use app\admin\model\User as UserModel;

use think\Controller;

class Coupon extends Controller
{
	protected $coupon;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->coupon = new CouponModel;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

    # 显示财务管理
    public function index()
    {
    	$res_coupon = $this->coupon->selectAll();

    	$this->assign('res_coupon', $res_coupon);

    	return $this->fetch('/coupon_list');
    }

    # 展示更改优惠券信息
    public function showCoupon()
    {
    	$res_coupon = $this->coupon->selectOne();

    	$this->assign('res_coupon', $res_coupon);

    	return $this->fetch('/coupon_details');
    }

    # 更改优惠券信息
    public function updateCoupon()
    {
    	$res = $this->coupon->updateCoupon();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }

    # 删除优惠券
    public function delCoupon()
    {
        $res = $this->coupon->delCoupon();

        if ($res) {
            return $this->success('删除成功');
        }
        return $this->error('删除失败');
    }

    # 跳转到添加优惠券页面
    public function showAddCoupon()
    {
        $res_number = $this->coupon->selectNumber();

        $this->assign('res_number', $res_number);

        return $this->fetch('/new_coupon');
    }

    # 创建一个优惠券
    public function addCoupon()
    {
        $res = $this->coupon->addCoupon();

        if (is_string($res)) {
            return $this->error($res);
        }
        if ($res) {
            return $this->success('添加成功');
        }
        return $this->error('添加失败');
    }

    # 搜索优惠券
    public function searchCoupon()
    {
        $res_coupon = $this->coupon->searchCoupon();

        $this->assign('res_coupon', $res_coupon);

        return $this->fetch('/coupon_list');
    }

    

}
