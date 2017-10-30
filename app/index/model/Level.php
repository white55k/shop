<?php
namespace app\index\model;

use think\Model;

class Level extends Model
{
	# 定义关联关系
	public function user()
	{
		return $this->hasOne('User','level_id');
	}
}