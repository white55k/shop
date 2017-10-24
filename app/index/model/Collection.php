<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;
use think\model;

class Collection extends Model
{
	# 收藏商品
	public function collection()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_uid = $user->getByUsername($username)->uid;
		$res_collection = $this->where('user_id','eq',$user_uid)->select();
		return $res_collection;
	}
}