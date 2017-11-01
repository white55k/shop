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

	# 添加购物车并查询购物车所有商品
	public function addCar()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
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

	# 添加一个商品到购物车
	public function addToCar()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;

		$data = [
			'good_id'	=>	input('param.gid'),
			'user_id'	=>	$res_uid
		];

		$car = $this->where('good_id', 'eq', input('param.gid'))
			 ->where('user_id', 'eq', $res_uid)
			 ->find();
		if (!$car) {
			$car = $this->save($data);
		}
		return $car;
	}

	# 查询购物车所有商品
	public function shopCar()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 减少购物车商品数
	public function delQuantity()
	{
		$this->where('cid', 'eq', input('param.cid'))->setDec('quantity');
		return $this::get(input('param.cid'));
	}

	# 增加购物车商品数
	public function addQuantity()
	{
		$this->where('cid', 'eq', input('param.cid'))->setInc('quantity');
		return $this::get(input('param.cid'));
	}

	# 删除购物车商品
	public function delCar()
	{
		$this::destroy(input('param.cid'));
	}

	# 获取选定商品信息
	public function selectAll()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;

		$cid = explode(',', input('param.cid'));
		$res = [];
		foreach ($cid as $v) {
			if (empty($v)) {
				continue;
			}
			$res[] = $this->where('cid', 'eq', $v)
				   ->where('user_id', 'eq', $res_uid)
				   ->find();
		}
		return $res;
	}

	# 获取选定商品信息
	public function selectOne()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;
		$gid = input('param.gid');

		$res_car = $this->where('user_id', 'eq', $res_uid)
			 ->where('good_id', 'eq', $gid)
			 ->find();
		if (!$res_car) {
			$data = [
				'user_id' => $res_uid,
				'good_id' => $pid
			];
			$res_car = $this->save($data);
		}
		$cid = $res_car->cid;
		$res = [];
		$res[] = $this->where('cid', 'eq', $cid)
			 ->where('user_id', 'eq', $res_uid)
			 ->find();
		return $res;
	}

	# 获取选定商品总价格
	public function selectMoney()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;

		$cid = explode(',', input('param.cid'));
		$money = 0;
		foreach ($cid as $v) {
			if (empty($v)) {
				continue;
			}
			$res = $this->where('cid', 'eq', $v)
				   ->where('user_id', 'eq', $res_uid)
				   ->find();
			$money += $res->good->money * $res->quantity;
		}
		return $money;	
	}

	# 获取商品价格
	public function selectPrice()
	{
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$res_uid = $user->getByUsername($username)->uid;
		$gid = input('param.gid');
		$res_car = $this->where('user_id', 'eq', $res_uid)
			 ->where('good_id', 'eq', $gid)
			 ->find();
		$cid = $res_car->cid;
		$res = $this->where('cid', 'eq', $cid)
			 ->where('user_id', 'eq', $res_uid)
			 ->find();
		$money = $res->good->money * $res->quantity;
		return $money;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}

	public function seckill()
	{
		return $this->belongsTo('Seckill', 'seckill_id');
	}
}