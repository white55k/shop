<?php

namespace app\admin\model;

use app\admin\model\Sort;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Level extends Model
{
	use SoftDelete;

	protected $pk = 'lid';

	# 查询所有等级
	public function selectAll()
	{
		$res = $this->where('1=1')->paginate(5);
		return $res;
	}

	# 查询一个等级
	public function selectOne()
	{
		$res = $this->where('lid', 'eq', input('param.lid'))->find();
		return $res;
	}

	# 更新等级
	public function updateLevel()
	{
		$post = request()->post();
		$validate = new Validate([
			'appellation'	=>	'require|max:32',
			'discount'		=>	'require|between:0,100'
		]);
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$level = $this->where('lid', 'eq', $post['lid'])->find();
		$res = $level->save($post);
		return $res;
	}

	# 添加一个等级
	public function addLevel()
	{
		$post = request()->post();
		$validate = new Validate([
			'appellation'	=>	'require|max:32',
			'discount'		=>	'require|between:0,100'
		]);
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$res = $this->insert($post);
		return $res;
	}

	public function user()
	{
		return $this->belongsTo('User', 'level_id');
	}
}