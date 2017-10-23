<?php

namespace app\index\model;

use app\index\model\User;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Address extends Model
{
	use SoftDelete;

	protected $pk = 'aid';

	public function getAddress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	public function newAddress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$data = [
			'user_id'	=> $res_uid,
			'consignee' => input('param.consignee'),
			'phone' 	=> input('param.phone'),
			'province'	=> input('param.province'),
			'city'		=> input('param.city'),
			'country'	=> input('param.country'),
			'address'	=> input('param.address')
		];
		$this->save($data);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	public function updateAddress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->get(input('param.aid'));
		$data = [
			'user_id'	=> $res_uid,
			'aid'		=> input('param.aid'),
			'consignee' => input('param.consignee'),
			'phone' 	=> input('param.phone'),
			'province'	=> input('param.province'),
			'city'		=> input('param.city'),
			'country'	=> input('param.country'),
			'address'	=> input('param.address')
		];
		$res->save($data);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}