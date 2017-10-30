<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\User;

use think\model;
use traits\model\SoftDelete;

class Collection extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 查询收藏商品
	public function collection()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_uid = $user->getByUsername($username)->uid;
		$res_collection = $this->where('user_id','eq',$user_uid)->paginate(5);
		return $res_collection;
	}

	# 收藏一个商品
	public function addCollect()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_uid = $user->getByUsername($username)->uid;

		$data = [
			'good_id'	=>	input('param.gid'),
			'user_id'	=>	$user_uid
		];
		$collect = $this->where('good_id', 'eq', input('param.gid'))
				 ->where('user_id', 'eq', $user_uid)
				 ->find();
		if (!$collect) {
			$collect = $this->save($data);
		}
		return $collect;
	}

	# 取消一个商品的收藏
	public function delCollect()
	{
		$collect = $this::get(input('param.cid'));
		$res = $collect->delete();
		return $res;
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