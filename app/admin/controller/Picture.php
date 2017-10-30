<?php

namespace app\admin\controller;

use app\admin\model\Good;
use app\admin\model\Picture as PictureModel;
use app\admin\model\User as UserModel;

use think\Controller;

class Picture extends Controller
{
	protected $good;
	protected $picture;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->picture = new PictureModel;
		$this->user = new UserModel;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 展示商品大中小图详情
    public function index()
    {
    	$res_picture = $this->picture->selectAll();

    	$this->assign('res_picture', $res_picture);

    	return $this->fetch('/picture_details');
    }

    # 修改商品大中小图
    public function updatePicture()
    {
    	$res = $this->picture->updatePicture();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }

    # 跳转到添加商品的大中小图
    public function showAddPicture()
    {
    	return $this->fetch('/new_picture');
    }

    # 跳转到添加商品的详情图
    public function showDetails()
    {
    	$res_picture = $this->picture->selectDetails();

    	$this->assign('res_picture', $res_picture);

    	return $this->fetch('/new_details');
    }

    # 添加一组商品的大中小图
    public function addPicture()
    {
    	$res = $this->picture->addPicture();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('添加成功');
    	}
    	return $this->error('添加失败');
    }

    # 修改商品详情图
    public function updateDetails()
    {
    	$res = $this->picture->updateDetails();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('修改成功');
    	}
    	return $this->error('修改失败');
    }

    # 添加商品详情图
    public function addDetails()
    {
    	$res = $this->picture->addDetails();

    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('添加成功');
    	}
    	return $this->error('添加失败');
    }
    
}
