<?php

namespace app\admin\controller;

use app\admin\model\User as UserModel;
use think\Controller;

class User extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
	}

    # 管理员身份认证
    public function index()
    {
        # 验证身份
    	$res = $this->user->yanZheng();
 
    	if (!$res) {
    		return $this->error('不是管理员', 'index/Index/index');
    	}
        session('aid', $res->aid);

        # 查询所有用户
    	$res_user = $this->user->selectAll();

    	$this->assign('res_user', $res_user);

        return $this->fetch('/user_list');
    }
}
