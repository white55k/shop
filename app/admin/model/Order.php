<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Order extends Model
{
	use SoftDelete;

	protected $pk = 'oid';

	# 查询所有订单信息
	public function selectAll()
	{
		$res = $this->where('1=1')->order('update_time')->paginate(5);
		return $res;
	}

	# 查询订单状态类订单
	public function showOrder()
	{
		$res = $this->where('is_express', 'eq', input('param.is_express'))
			 ->order('update_time', 'desc')
			 ->paginate(5, false, ['query'=>request()->get()]);
		return $res;
	}

	# 查询搜索订单
	public function searchOrder()
	{
		$name = input('param.name');
		$res = $this->where('order_number', 'like', '%' . $name . '%')
			 ->whereOr('consignee', 'like', '%' . $name . '%')
			 ->whereOr('phone', 'like', '%' . $name . '%')
			 ->paginate(5, false, ['query'=>request()->get()]);
		return $res;
	}

	# 删除一个订单
	public function delOrder()
	{
		$order = $this->where('oid', 'eq', input('param.oid'))->find();
		$res = $order->delete();
		return $res;
	}
}