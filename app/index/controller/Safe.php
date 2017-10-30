<?php

namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;

class Safe extends Controller
{
	# 自定义一个构造函数
	protected $User;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
	}


	public function safety()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 会员等级
		$result = $this->user->message();
		$res = $result['gold'];
		if ($res < 500) {
			$res = '铜牌会员';
		} else if($res > 500 && $res < 1500) {
			$res = '黄金会员';
		} else {
			$res = '钻石会员';
		}
		# 会员头像
		$pic = $result['picture'];
		return $this->fetch('/safety',[
			'username' => $username,
			'gold'  => $res,
			'pic' =>$pic,
			'username' => $username,
		]);
	}
}