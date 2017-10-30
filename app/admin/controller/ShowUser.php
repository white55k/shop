<?php

namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;

class ShowUser extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 展示用户信息
    public function show()
    {
    	$res_user = $this->user->selectAll();
    	
    	$this->assign('res_user', $res_user);

        return $this->fetch('/user_list');
    }
}
