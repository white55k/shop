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

	# 获取用户所有收货地址信息
	public function getAddress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 添加新地址
	public function newAddress()
	{
		$validate = new Validate([
			'consignee' =>	'require|max:32',
			'phone' 	=>	'require|number|between:10000000000,20000000000',
			'province'	=>	'require|max:16|notIn:1,2',
			'city'		=>	'require|max:16|notIn:1,2',
			'country'	=>	'require|max:16|notIn:1,2',
			'address'	=>	'require|max:128'
		]);
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$post['user_id'] = $res_uid;
		$this->save($post);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 更改收货地址
	public function updateAddress()
	{
		$validate = new Validate([
			'consignee' =>	'require|max:32',
			'phone' 	=>	'require|number|between:10000000000,20000000000',
			'province'	=>	'require|max:16|notIn:1,2',
			'city'		=>	'require|max:16|notIn:1,2',
			'country'	=>	'require|max:16|notIn:1,2',
			'address'	=>	'require|max:128'
		]);
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->get(input('param.aid'));
		$post['user_id'] = $res_uid;
		$res->save($post);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 删除收货地址
	public function delAddr()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$address = $this->where('aid', 'eq', input('param.aid'))
			 ->where('user_id', 'eq', $res_uid)
			 ->find();
		$res = $address->delete();
		return $res;
	}

	# 修改默认地址
	public function defaultAddr()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$addr = $this::get(['user_id'=>$res_uid])->all();
		foreach ($addr as $v) {
			$v->save(['is_default'=>0]);
		}
		$address = $this::get(input('param.aid'));
		$res = $address->save(['is_default'=>1]);
		$res_address = $this->where('user_id', 'eq', $res_uid)->select();
		return $res_address;
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}