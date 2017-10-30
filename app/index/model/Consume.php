<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Consume extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 查询商品总销量
	public function allCount()
	{
		$res = $this->where('good_id', 'eq', input('param.gid'))->count();
		return $res;
	}

	# 查询商品月销量
	public function monthCount()
	{
		$res = $this->where('good_id', input('param.gid'))
			 ->whereTime('create_time', 'm')
			 ->count();
		return $res;
	}

	public function seckill()
	{
		return $this->belongsTo('Seckill', 'seckill_id');
	}


	public function findDetail()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;

		$res = $this->where('user_id','eq',$user_id)->whereTime('create_time','m')->select();
		return $res;
	}
	
	public function allMoney()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;

		$res = $this->where('user_id','eq',$user_id)->whereTime('create_time','m')->select();
		
		$money = 0;
		foreach ($res as $v) {
			$money += $v->money;
		}
		return $money;
	}

	# 遍历条件下所有消费记录
	public function chaKan()
	{
		$time = input('post.time');
		switch ($time) {
			case '今天':
				$time = 'd';
				break;
			case '本周':
				$time = 'w';
				break;
			case '本月':
				$time = 'm';
				break;
			case '本年':
				$time = 'y';
				break;
			case '全部':
				$time = 'all';
				break;
			default:
				$time = 'all';
				break;
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;

		if ($time == 'all') {
			$res = $this->where('user_id','eq',$user_id)->select();

		} else {
			$res = $this->where('user_id','eq',$user_id)->whereTime('create_time',$time)->select();
		}
		return $res;
	}
	
	# 删除交易
	public function deleConsume()
	{
		$cid = input('param.cid');
		$result = $this::get($cid);
		$res = $result->delete();
		return $res;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}
}
