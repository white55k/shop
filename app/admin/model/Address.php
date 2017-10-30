<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Address extends Model
{
	use SoftDelete;

	protected $pk = 'aid';

	public function admin()
	{
		return $this->hasOne('Admin', 'user_id');
	}

	public function user()
	{
		return $this->hasMany('User', 'user_id');
	}
}