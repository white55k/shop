<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Site extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	# 查询站点信息
	public function selectAll()
	{
		$res = $this->where('sid', 'eq', 1)->find();
		return $res;
	}
}