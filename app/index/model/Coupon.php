<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;
use think\Model;
use traits\model\SoftDelete;
class Coupon extends Model
{
	use SoftDelete;
	public function selectAll()
	{
	    $username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$time = time();
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_enable','eq',0)->where('past_time','gt',$time)->select();
		return $res;
		
	}
	# 过期的
	public function selectOld()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$time = time();
		$res = $this->where('user_id', 'eq', $res_uid)->where('past_time','lt',$time)->select();
		return $res;
	}
	# 已经用过的
	public function selectUsed()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_enable','eq',1)->select();
		return $res;
	}
	# 删除优惠券
	public function delCoupon()
	{
		$cid = input('param.cid');
		$result = $this::get($cid);
		$res = $result->delete();
		return $res;
	}

	# 建立关联关系
	public function good()
	{
		return $this->belongsTo('Good','good_id');
	}
	
}
