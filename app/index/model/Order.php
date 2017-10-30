<?php

namespace app\index\model;

use app\index\model\Center;
use app\index\model\Good;
use app\index\model\User;

use think\Model;
use traits\model\SoftDelete;

class Order extends Model
{
	use SoftDelete;

	protected $pk = 'oid';

	# 查看所用待签收的订单
	public function findAll()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$good = new Good;
		$picture = new Picture;
		$order = $this->where('user_id', 'eq', $res_uid)->where('is_express','neq',0)->where('is_express','neq',4)->where('order_type','eq',0)->select();
		$arr = [];
		$j = 0;
		foreach ($order as $v) {
			$gid = explode(',', $v->good_id);
			for ($i=0; $i < count($gid); $i++) { 
				$res = $good->where('gid', 'eq', $gid[$i])->find();
				$arr[$j]['order_data'] = $v;
				$arr[$j]['good_data'][$i] = $res;

			}
			$j++;
		}
		return $arr;
	}
	# 查看所有已关闭的订单
	public function  closeAll()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$good = new Good;
		$picture = new Picture;
		$order = $this->where('user_id', 'eq', $res_uid)->where('order_type','eq',1)->whereOr('order_type','eq',3)->whereOr('order_type','eq',4)->select();
		$arr = [];
		$j = 0;
		foreach ($order as $v) {
			$gid = explode(',', $v->good_id);
			for ($i=0; $i < count($gid); $i++) { 
				$res = $good->where('gid', 'eq', $gid[$i])->find();
				$arr[$j]['order_data'] = $v;
				$arr[$j]['good_data'][$i] = $res;

			}
			$j++;
		}
		return $arr;
	}

	# 查看所有待付款订单
	public function  readyAll()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$good = new Good;
		$picture = new Picture;
		$order = $this->where('user_id', 'eq', $res_uid)->where('is_pay','neq',1)->where('order_type','eq',0)->select();
		$arr = [];
		$j = 0;
		foreach ($order as $v) {
			$gid = explode(',', $v->good_id);
			for ($i=0; $i < count($gid); $i++) { 
				$res = $good->where('gid', 'eq', $gid[$i])->find();
				$arr[$j]['order_data'] = $v;
				$arr[$j]['good_data'][$i] = $res;

			}
			$j++;
		}
		return $arr;
	}

	# 查看所用待发货订单
	public function  readySend()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$good = new Good;
		$picture = new Picture;
		$order = $this->where('user_id', 'eq', $res_uid)->where('is_express','eq',1)->where('order_type','eq',0)->select();
		$arr = [];
		$j = 0;
		foreach ($order as $v) {
			$gid = explode(',', $v->good_id);
			for ($i=0; $i < count($gid); $i++) { 
				$res = $good->where('gid', 'eq', $gid[$i])->find();
				$arr[$j]['order_data'] = $v;
				$arr[$j]['good_data'][$i] = $res;

			}
			$j++;
		}
		return $arr;
	}

	# 个人中心未支付状态
	public function orderAll()
	{
	    $username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_pay','neq',1)->select();
	
	}
	# 个人中心货物状态 (代发货)
	public function inExpress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_express','lt',2)->select();
		return $res;
	}
	# 个人中心待收货
	public function delivery()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->where('is_express','lt',4)->where('is_express','gt',1)->select();
		return $res;
	}

	
}
