<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Menu extends Model
{
	use SoftDelete;

	protected $pk = 'mid';

	public function selectAll()
	{
		$res = $this->all();
		return $res;
	}

	public function sort()
	{
		return $this->hasMany('Sort', 'menu_id');
	}
}