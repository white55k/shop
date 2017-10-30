<?php

namespace app\index\controller;

use app\index\model\Consume;
use app\index\model\User as UserModel;
use think\Controller;

class Bill extends Controller
{
	# 自定义一个构造函数
	protected $user;
	protected $consume;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		$this->consume = new Consume;
	}


	public function bill()
	{
		# 查找当前月份
		$month = date('m');
		$year = date('Y');
		$time_b = $year . '/' . $month;
		$time_a = $year . '/' . ($month-1);
		$res_consume = $this->consume->findDetail();
		$res_money = $this->consume->allMoney();
		# 计算总交易额
		return $this->fetch('/bill',[
			'time_b' => $time_b,
			'time_a' => $time_a,
			'month_a' => $month,
			'res_consume' => $res_consume,
			'money' => $res_money,
		]);
	}
}