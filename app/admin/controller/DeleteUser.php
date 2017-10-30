<?php

namespace app\admin\controller;

use app\admin\model\User;
use think\Controller;

class DeleteUser extends Controller
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

	# 删除一个用户
	public function index()
	{
		$res = $this->user->delUser();

		if ($res) {
			return $this->success('删除成功');
		}
		return $this->error('删除失败');
	}
}
