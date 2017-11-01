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
		$res_foot = $this->where('user_id','eq',$user_uid)
				  ->whereTime('create_time', 'd')
				  ->paginate(5);
		return $res_foot;
	}

	# 添加一个足迹
	public function addFoot()
	{
		if (empty(session('username')) && empty(cookie('username'))) {
			return false;
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_uid = $user->getByUsername($username)->uid;
		$data = [
			'user_id'	=>	$user_uid,
			'good_id'	=>	input('param.gid')
		];
		$res_f = $this->where('user_id', 'eq', $user_uid)
			 ->where('good_id', 'eq', input('param.gid'))
			 ->find();
		if ($res_f) {
			if (strtotime($res_f->create_time) <= time()-86400*7) {
				$res_f->delete();
			} else {
				return false;
			}
		}
		$res = $this->data($data)->save();
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