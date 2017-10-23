<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Param extends Model
{
	use SoftDelete;

	protected $pk = 'pid';

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}
}