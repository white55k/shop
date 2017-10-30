<?php

namespace app\index\controller;

use app\index\model\Coupon as CouponModel;
use app\index\model\Site;

use think\Controller;

class Coupon extends Controller
{
	protected $coupon;
	protected $site;

	public function _initialize()
	{
		parent::_initialize();
		$this->coupon = new CouponModel;
		$this->user = new User;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 领取优惠券
    public function addUser()
    {
    	return $this->coupon->addUser();
    }
}
