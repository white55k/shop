<?php

namespace app\index\controller;

use app\index\model\Coupon as CouponModel;

use think\Controller;

class Coupon extends Controller
{
	protected $coupon;

	public function _initialize()
	{
		parent::_initialize();
		$this->coupon = new CouponModel;
	}

    public function addUser()
    {
    	return $this->coupon->addUser();

    }
}
