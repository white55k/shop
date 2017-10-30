<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;

use think\model;
use traits\model\SoftDelete;

class Foot extends Model
{
	use SoftDelete;

	protected $pk = 'fid';

	# 查询足迹商品
	public function selectAll()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_uid = $user->getByUsername($username)->uid;
		$res_foot = $this->where('user_id','eq',$user_uid)->paginate(5);
		return $res_foot;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}