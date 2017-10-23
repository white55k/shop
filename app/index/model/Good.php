<?php

namespace app\index\model;

/*use app\index\model\Sort;*/

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Good extends Model
{
	use SoftDelete;

	protected $pk = 'gid';

	public function allSimilar()
	{
		$sort_id = $this::get(input('param.gid'))->sort_id;
		$res = $this->where('sort_id', 'eq', $sort_id)
			 ->order('update_time', 'desc')
			 ->paginate(12);
		return $res;
	}

	public function recommend()
	{
		$res = $this->where('is_recommend', 'eq', 1)->limit(3)->select();
		return $res;
	}

	public function selectOne()
	{
		return $this->where('gid', 'eq', input('param.gid'))->find();
	}

	public function similar()
	{
		$sort_id = $this::get(input('param.gid'))->sort_id;
		$sort = new Sort;
		$res = $sort::get($sort_id);
		return $res->good;
		
	}

	public function car()
	{
		return $this->hasOne('Car', 'good_id');
	}

	public function comment()
	{
		return $this->hasMany('Comment', 'good_id');
	}

	public function consume()
	{
		return $this->hasMany('Consume', 'good_id');
	}

	public function coupon()
	{
		return $this->belongsTo('Coupon', 'good_id');
	}

	public function param()
	{
		return $this->hasOne('Param', 'good_id');
	}

	public function picture()
	{
		return $this->hasMany('Picture', 'good_id');
	}

	public function sort()
	{
		return $this->belongsTo('Sort', 'sort_id');
	}

	public function taste()
	{
		return $this->hasMany('Taste', 'good_id');
	}
}