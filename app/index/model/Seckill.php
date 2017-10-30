<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Seckill extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	public function aliveAll()
	{
		$time = time();
		$res = $this->where('end_time', 'gt', $time)->select();
		return $res;
	}

	public function selectOne()
	{
		return $this->where('sid', 'eq', input('param.sid'))->find();
	}

	public function similar()
	{
		$sort_id = $this::get(input('param.sid'))->sort_id;
		$sort = new Sort;
		$res = $sort::get($sort_id);
		return $res->good;
	}

	public function allSimilar()
	{
		$sort_id = $this::get(input('param.sid'))->sort_id;
		$res = $this->where('sort_id', 'eq', $sort_id)
			 ->order('update_time', 'desc')
			 ->paginate(12);
		return $res;
	}

	public function car()
	{
		return $this->hasOne('Car', 'seckill_id');
	}

	public function comment()
	{
		return $this->hasMany('Comment', 'good_id');
	}

	public function consume()
	{
		return $this->hasMany('Consume', 'good_id');
	}

	public function param()
	{
		return $this->hasOne('Param', 'good_id');
	}

	public function picture()
	{
		return $this->hasMany('Picture', 'seckill_id');
	}

	public function sort()
	{
		return $this->belongsTo('Sort', 'sort_id');
	}

	public function taste()
	{
		return $this->hasMany('Taste', 'seckill_id');
	}
}