<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Param extends Model
{
	use SoftDelete;

	protected $pk = 'pid';

	# 查询一个商品的参数
	public function selectOne()
	{
		$res = $this->where('good_id', 'eq', input('param.gid'))->find();
		return $res;
	}

	# 修改一个商品参数信息
	public function updateParam()
	{
		$validate = new Validate([
			'type'				=>	'require|max:16',
			'produce'			=>	'require|max:32',
			'burden'			=>	'require|max:64',
			'specification'		=>	'require|max:16',
			'quelity_date'		=>	'require|max:16',
			'standard_number'	=>	'require|max:64',
			'premit_number'		=>	'require|max:64',
			'eat_method'		=>	'require|max:64'
		]);

		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}

		$param = $this::get(['good_id'=>$post['good_id']]);
		if ($param) {
			return $param->save($post);
		}
		return $this->data($post)->save();
	}
}