<?php

namespace app\index\model;

use app\index\model\Order;
use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Comment extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 评论
	public function docommon()
	{
		$star = input('param.star');
		if (!$star) {
			$star = 2;
		}
		$content = input('param.center');
		if (!$content) {
			$content = "这家伙很懒什么都没有留下";
		}
		$gid = input('param.good_id');
		$res = $this->data(['star' => $star,'content' => $content,'good_id' => $gid])->save();
		if ($res) {
			$order_number = input('param.order_number');
			$order = new Order;
			$res = $order->where('order_number','eq',$order_number)->find();
			$res = $res->data(['is_express' => 4])->save();
		}
		return $res;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}

	public function seckill()
	{
		return $this->belongsTo('Seckill', 'seckill_id');
	}
}