<?php

namespace app\index\model;

use think\Model;
use traits\model\SoftDelete;

class Shop extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	public function index()
	{
		
	}

	public function user()
	{
		return $this->hasOne('User', 'uid');
	}
}