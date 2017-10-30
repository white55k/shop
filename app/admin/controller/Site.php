<?php

namespace app\admin\controller;

use app\admin\model\Site as SiteModel;
use app\admin\model\User;

use think\Controller;

class Site extends Controller
{
	protected $site;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->site = new SiteModel;
		$this->user = new User;
		if (!session('aid')) {
			return $this->error('不是管理员', 'index/Index/index');
		}
	}

	# 查询站点信息
    public function index()
    {
  		$res_site = $this->site->selectAll();

  		$this->assign('res_site', $res_site);

    	return $this->fetch('/setting');
    }

    # 更改站点信息
    public function updateSite()
    {
    	$res = $this->site->updateSite();
    	if (is_string($res)) {
    		return $this->error($res);
    	}
    	if ($res) {
    		return $this->success('站点修改成功');
    	}
    	return $this->error('站点修改失败');
    }
}
