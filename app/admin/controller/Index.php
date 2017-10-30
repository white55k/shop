<?php

namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;

class Index extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User;
	}

    # 登陆界面
    public function index()
    {
        return $this->fetch('/index');
    }

    # 退出操作
    public function quit()
    {
    	session('aid', null);
    	return $this->fetch('/index');
    }
}
