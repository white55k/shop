<?php

namespace app\admin\controller;

use app\admin\model\User as UserModel;
use think\Controller;

class EditUser extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

    # 跳转到编辑一个用户页面
    public function index()
    {
    	$res_user = $this->user->selectOne();
    	
    	$this->assign('res_user', $res_user);

    	return $this->fetch('/user_detail');
    }

    # 更新一个用户
    public function updateUser()
    {
    	$res = $this->user->updateUser();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if (!$res) {
    		return $this->error('格式不正确');
    	}
    	return $this->success('修改成功');
    }

    # 搜索一个用户
    public function searchUser()
    {
        $res_user = $this->user->searchUser();

        $this->assign('res_user', $res_user);

        return $this->fetch('/user_list');
    }

    # 展示添加用户页面
    public function showAddUser()
    {
        return $this->fetch('/new_user');
    }

    # 添加一个用户
    public function addUser()
    {
        $res = $this->user->addUser();

        if (is_string($res)) {
           return $this->error($res);
        }
        if ($res) {
            return $this->success('添加成功');
        }
        return $this->error('添加失败');
    }
}
