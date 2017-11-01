<?php

namespace app\index\model;

use app\index\model\Good;
use app\index\model\Menu;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Sort extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	# 搜索商品的搭配商品
	public function searchSimilar()
	{
		$key = input('param.index_none_header_sysc');
		$good = new Good;
		$sort_id = $good->where('name', 'like', '%'.$key.'%')
			 ->whereOr('keyword', 'like', '%'.$key.'%')
			 ->find()->sort_id;
		$res = $this->where('sid', 'eq', $sort_id)->find();
		return $res->good;
	}

	# 查询搜索商品搭配
	public function collect()
	{
		$key = input('param.index_none_header_sysc');
		$good = new Good;
		$sort_id = $good->where('name', 'like', '%'.$key.'%')
			 ->whereOr('keyword', 'like', '%'.$key.'%')
			 ->find()->sort_id;
		$menu_id = $this->where('sid', 'eq', $sort_id)->find()->menu_id+1;
		$menu = new Menu;
		$res = $menu->where('mid', 'eq', $menu_id)->find();
		$res_good = $res->sort[0]->good;
		return $res_good;
	}

	public function good()
	{
		return $this->hasMany('Good', 'sort_id');
	}

	public function menu()
	{
		return $this->belongsTo('Menu', 'menu_id');
	}

	public function seckill()
	{
		return $this->hasMany('Seckill', 'sort_id');
	}
}