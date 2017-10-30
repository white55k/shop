<?php

namespace app\admin\model;

use app\admin\model\Sort;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Site extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	# 查询站点信息
	public function selectAll()
	{
		$res = $this->where('sid', 'eq', 1)->find();
		return $res;
	}

	# 修改站点信息
	public function updateSite()
	{
		$validate = new Validate([
			'name'			=>	'require|max:16',
			'descrbe'		=>	'require|max:32',
			'keyword'		=>	'require|max:64',
			'record'		=>	'require|max:32',
			'is_open'		=>	'require|number|between:0,1',
			'close_describe'=>	'require|max:128'
		]);
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}

		$file = request()->file('logo');
		if ($file) {
			$info = $file->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');

			if ($info) {
				$post['logo'] = DS . 'static' . DS . 'upload' . DS . $info->getSaveName();
				$site = $this->where('sid', 'eq', 1)->find();
				$res = $site->save($post);
				return $res;
			}
		}

		$site = $this->where('sid', 'eq', 1)->find();
		$res = $site->save($post);
		return $res;
	}
}