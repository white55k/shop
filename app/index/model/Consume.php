<?php

namespace app\index\model;

use app\index\model\User;
use think\Model;
use traits\model\SoftDelete;

class Consume extends Model
{
	use SoftDelete;
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

	# 创建管理关系
	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}
}
