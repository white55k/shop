<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Seckill extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	public function aliveAll()
	{
		$time = time();
		$res = $this->where('end_time', 'gt', $time)->select();
		return $res;
	}

	public function picture()
	{
		return $this->hasMany('Picture', 'seckill_id');
	}

	public function sort()
	{
		return $this->belongsTo('Sort', 'sort_id');
	}
}