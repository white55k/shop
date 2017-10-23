<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Picture extends Model
{
	use SoftDelete;

	protected $pk = 'pid';

	public function recommend()
	{
		$res = $this->where('is_recommend', 'eq', 1)->limit(3)->select();
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