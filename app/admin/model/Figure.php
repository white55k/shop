<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Figure extends Model
{
	use SoftDelete;

	protected $pk = 'fid';

	# 查询轮播图信息
	public function selectAll()
	{
		$res = $this->where('1=1')->select();
		return $res;
	}

	# 修改轮播图信息
	public function updateFigure()
	{
		$file = request()->file('picture');
		if (!$file) {
			return '请上传图片';
		}

		$info = $file->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$info) {
			return $file->getError();
		}

		$url = DS .  'static' . DS . 'upload' . DS . $info->getSaveName();
		$res = $this->where('fid', 'eq', input('param.fid'))->find();
		$res_fig = $res->save(['picture'=>$url]);
		return $res_fig;
	}

	# 添加一个轮播图
	public function addFigure()
	{
		$file = request()->file('picture');
		if (!$file) {
			return '请上传图片';
		}

		$info = $file->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$info) {
			return $file->getError();
		}

		$url = DS .  'static' . DS . 'upload' . DS . $info->getSaveName();
		$res = $this->data(['picture'=>$url])->save();
		return $res;
	}
}