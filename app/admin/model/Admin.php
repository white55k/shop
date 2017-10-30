<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Admin extends Model
{
	use SoftDelete;

	protected $pk = 'aid';

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}