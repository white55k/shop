<?php

namespace app\admin\controller;

use app\admin\model\Level;
use app\admin\model\User as UserModel;

use think\Controller;

class EditLevel extends Controller
{
	protected $level;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->level = new Level;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

    # 跳转到编辑等级
    public function index()
    {
    	$res_level = $this->level->selectOne();

    	$this->assign('res_level', $res_level);

    	return $this->fetch('/level_detail');
    }

    # 更新等级
    public function updateLevel()
    {
    	$res = $this->level->updateLevel();
    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }

    # 添加等级
    public function addLevel()
    {
    	$res = $this->level->addLevel();
    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('添加成功');
    	}
    	return $this->error('添加失败');

    }

}
