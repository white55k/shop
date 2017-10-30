<?php

namespace app\admin\controller;

use app\admin\model\Level as LevelModel;
use app\admin\model\User;

use think\Controller;

class Level extends Controller
{
	protected $user;
	protected $level;

	public function _initialize()
	{
		parent::_initialize();
		$this->level = new LevelModel;
		$this->user = new User;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 查询所有等级
    public function index()
    {
    	$res_level = $this->level->selectAll();

    	$this->assign('res_level', $res_level);

    	return $this->fetch('/user_rank');
    }
}
