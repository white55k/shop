<?php

namespace app\index\controller;

use app\index\model\Coupon as CouponModel;
use app\index\model\Site;
use app\index\model\User as UserModel;

use think\Controller;
use traits\model\SoftDelete;

class Coupon extends Controller
{
	use SoftDelete;

	protected $coupon;
	protected $site;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->coupon = new CouponModel;
		$this->site = new Site;
		$this->user = new UserModel;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 领取优惠券
    public function addUser()
    {
    	return $this->coupon->addUser();
    }


	public function coupon()
	{
		$data = $this->coupon->selectAll();
		$enddata = $this->coupon->selectOld();
		$usedata = $this->coupon->selectUsed();
		return $this->fetch('/coupon',[
			'data' => $data,
			'enddata' => $enddata,
			'usedata' => $usedata,

		]);
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
	
}
