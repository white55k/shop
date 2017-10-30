<?php

namespace app\index\controller;

use app\index\model\Coupon as NewCoupon;
use app\index\model\User as UserModel;
use think\Controller;
use traits\model\SoftDelete;

class Coupon extends Controller
{
	use SoftDelete;
	# 自定义构造函数
	protected $user;
	protected $coupon;
	public function _initialize()
	{
		parent::_initialize();

		$this->user = new UserModel;
		$this->coupon = new NewCoupon;
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