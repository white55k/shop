<?php

namespace app\admin\controller;

use app\admin\model\Figure as FigureModel;
use app\admin\model\User;

use think\Controller;

class Figure extends Controller
{
	protected $figure;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->figure = new FigureModel;
		$this->user = new User;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 查询轮播图信息
    public function index()
    {
  		$res_figure = $this->figure->selectAll();

  		$this->assign('res_figure', $res_figure);

    	return $this->fetch('/figure_details');
    }

    # 更改轮播图信息
    public function updateFigure()
    {
    	$res = $this->figure->updateFigure();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }

    # 添加一张轮播图
    public function addFigure()
    {
    	$res = $this->figure->addFigure();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('添加成功');
    	}
    	return $this->error('添加失败');
    }
}
