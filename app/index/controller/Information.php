<?php

namespace app\index\controller;

use app\index\model\Site;
use app\index\model\User as UserModel;

use think\Controller;
use think\Db;

class Information extends Controller
{
	protected $site;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->site = new Site;
		$this->user = new UserModel;

		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}
	public function information()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 会员等级
		$result = Db::name('user')->where('username','eq',$username)->find();
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
		return $this->fetch('/information',[
			'gold'  => $res,
			'pic' =>$pic,
			'username' => $username,
		]);
	}

}