<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Sort extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	public function good()
	{
		return $this->hasMany('Good', 'sort_id');
	}

	public function menu()
	{
		return $this->belongsTo('Menu', 'menu_id');
	}

	public function seckill()
	{
		return $this->hasMany('Seckill', 'sort_id');
	}
}