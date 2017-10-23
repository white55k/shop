<?php

namespace app\index\model;

use app\index\model\User;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Car extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	public function addCar()
	{
		$user = new User;
		$username = session('user') ? session('user') : cookie('user');
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)
			 ->where('good_id', 'eq', input('param.gid'))
			 ->find();
		if (!$res) {
			$data = [
				'user_id' => $res_uid,
				'good_id' => input('param.gid')
			];
			$this->save($data);
		}
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	public function delQuantity()
	{
		$this->where('cid', 'eq', input('param.cid'))->setDec('quantity');
		return $this::get(input('param.cid'));
	}

	public function addQuantity()
	{
		$this->where('cid', 'eq', input('param.cid'))->setInc('quantity');
		return $this::get(input('param.cid'));
	}

	public function delCar()
	{
		$this::destroy(input('param.cid'));
	}

	public function selectAll()
	{
		$user = new User;
		$username = session('user') ? session('user') : cookie('user');
		$res_uid = $user->getByUsername($username)->uid;

		$cid = explode(',', input('param.cid'));
		$res = [];
		foreach ($cid as $v) {
			$res[] = $this->where('cid', 'eq', $v)
				   ->where('user_id', 'eq', $res_uid)
				   ->find();
		}
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