<?php

namespace app\index\model;

use app\index\model\User;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Coupon extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	public function addUser()
	{
		$user = new User;
		$username = session('user') ? session('user') : cookie('user');
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('good_id', 'eq', input('param.gid'))
			 ->where('is_enable', 'eq', 0)
			 ->where('user_id', 'eq', 0)
			 ->find();
		if (!$res) {
			return 0;
		}
		$res->user_id = $res_uid;
		$res->save();
		return $res;
	}

	public function good()
	{
		return $this->hasMany('Good', 'good_id');
	}

	public function user()
	{
		return $this->hasMany('User', 'user_id');
	}
}