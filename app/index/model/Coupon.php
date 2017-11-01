<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Coupon extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 领取优惠券
	public function addUser()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('good_id', 'eq', input('param.gid'))
			 ->where('is_enable', 'eq', 0)
			 ->where('user_id', 'eq', 0)
			 ->where('past_time', 'gt', time())
			 ->find();
		if (!$res) {
			return 0;
		}
		$res->user_id = $res_uid;
		$res->save();
		return $res;
	}

	# 查询用户所有优惠券信息
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

	public function good()
	{
		return $this->hasMany('Good', 'good_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}
