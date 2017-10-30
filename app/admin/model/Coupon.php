<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Coupon extends Model
{
	use SoftDelete;

	protected $pk = 'cid';

	# 获取所有优惠券信息
	public function selectAll()
	{
		$res = $this->where('1=1')->paginate('6');
		return $res;
	}

	# 获取一个优惠券信息
	public function selectOne()
	{
		$res = $this->where('cid', 'eq', input('param.cid'))->find();
		return $res;
	}

	# 修改优惠券信息
	public function updateCoupon()
	{
		$validate = new Validate([
			'user_id'	=>	'require|number',
			'good_id'	=>	'require|number',
			'number'	=>	'require|number|between:100000001,999999999',
			'face_value'=>	'require|number|between:0,100',
			'descrbe'	=>	'require|max:64',
			'full_money'=>	'require|number|between:0,10000',
			'past_time'	=>	'require|number|between:0,100000000000',
		]); 
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}

		$post['past_time'] += time();

		$result = $this::get($post['cid']);
		$res_coupon = $result->save($post);
		return $res_coupon;
	}

	# 删除优惠券
	public function delCoupon()
	{
		$coupon = $this::get(input('param.cid'));
		$res = $coupon->delete();
		return $res;
	}

	# 添加一个优惠券
	public function addCoupon()
	{
		$validate = new Validate([
			'user_id'	=>	'require|number',
			'good_id'	=>	'require|number',
			'number'	=>	'require|number|between:100000001,999999999',
			'face_value'=>	'require|number|between:0,100',
			'descrbe'	=>	'require|max:64',
			'full_money'=>	'require|number|between:0,10000',
			'past_time'	=>	'require|number|between:0,100000000000',
		]); 
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}

		$post['past_time'] += time();
		$res = $this->data($post)->save();
		return $res;
	}

	# 查询需要插入的优惠券编号
	public function selectNumber()
	{
		$res = $this->where('1=1')->order('number', 'desc')->find();
		return $res->number + 1;
	}

	# 搜索优惠券信息
	public function searchCoupon()
	{
		$search = input('param.search');
		$res = $this->where('user_id', 'eq', $search)
			 ->whereOr('good_id', 'eq', $search)
			 ->whereOr('number', 'eq', $search)
			 ->paginate('6');
		return $res;
	}
}