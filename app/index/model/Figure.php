<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Figure extends Model
{
	use SoftDelete;

	protected $pk = 'fid';

	public function selectAll()
	{
		$res = $this->all();
		return $res;
	}

}