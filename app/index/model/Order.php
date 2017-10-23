<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;
use think\Model;

class Order extends Model
{
	# 未支付状态
	public function orderAll()
	{
	    $username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_pay','neq',1)->select();
		return $res;
		
	}
	# 货物状态 (代发货)
	public function inExpress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_express','lt',2)->select();
		return $res;
	}
	# 待收货
	public function delivery()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_express','lt',4)->where('is_express','gt',1)->select();
		return $res;
	}

	
}
