<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Consume extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 查询商品总销量
	public function allCount()
	{
		$res = $this->where('good_id', 'eq', input('param.gid'))->count();
		return $res;
	}

	# 查询商品月销量
	public function monthCount()
	{
		$res = $this->where('good_id', input('param.gid'))
			 ->whereTime('create_time', 'm')
			 ->count();
		return $res;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}

	public function seckill()
	{
		return $this->belongsTo('Seckill', 'seckill_id');
	}
}