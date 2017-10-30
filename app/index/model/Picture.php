<?php
namespace app\index\model;

use think\Model;

class Picture extends Model
{
	


	# 创建关联关系
	public function good()
	{
		return $this->belongsTo('good','good_id');
	}
}