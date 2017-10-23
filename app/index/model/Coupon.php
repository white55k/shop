<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;
use think\Model;

class Coupon extends Model
{
	public function selectAll()
	{
	    $username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
		
	}
	
}
