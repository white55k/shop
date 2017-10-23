<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Comment extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}
}