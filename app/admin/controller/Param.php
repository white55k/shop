<?php

namespace app\admin\controller;

use app\admin\model\Good;
use app\admin\model\Param as ParamModel;
use app\admin\model\User as UserModel;

use think\Controller;

class Param extends Controller
{
	protected $good;
	protected $param;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->param = new ParamModel;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 展示参数详情
    public function index()
    {
    	$res_param = $this->param->selectOne();

    	$this->assign('res_param', $res_param);

    	return $this->fetch('/param_details');
    }

    # 更改详情参数
    public function updateParam()
    {
    	$res = $this->param->updateParam();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }
}
