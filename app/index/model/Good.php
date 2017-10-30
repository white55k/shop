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

	# 查询商品类似商品
	public function allSimilar()
	{
		$sort_id = $this::get(input('param.gid'))->sort_id;
		$res = $this->where('sort_id', 'eq', $sort_id)
			 ->order('update_time', 'desc')
			 ->paginate(12);
		return $res;
	}

	# 查询所有搜索商品
	public function searchAll()
	{
		$key = input('param.index_none_header_sysc');
		$res_good = $this->where('name', 'like', '%'.$key.'%')
				  ->whereOr('keyword', 'like', '%'.$key.'%')
				  ->order('update_time', 'desc')
				  ->find();
		if (!$res_good) {
			return null;
		}
		$res = $this->where('name', 'like', '%'.$key.'%')
			 ->whereOr('keyword', 'like', '%'.$key.'%')
			 ->order('update_time', 'desc')
			 ->paginate(8,false,['query' => request()->param()]);
		return $res;
	}

	# 搜索商品销售量排序
	public function searchSell()
	{
		$key = input('param.index_none_header_sysc');
		$res = $this->where('name', 'like', '%'.$key.'%')
			 ->whereOr('keyword', 'like', '%'.$key.'%')
			 ->order('stock', 'desc')
			 ->paginate(8,false,['query' => request()->param()]);
		return $res;
	}

	# 搜索商品价格排序
	public function searchPrice()
	{
		$key = input('param.index_none_header_sysc');
		$res = $this->where('name', 'like', '%'.$key.'%')
			 ->whereOr('keyword', 'like', '%'.$key.'%')
			 ->order('money', 'asc')
			 ->paginate(8,false,['query' => request()->param()]);
		return $res;
	}

	# 查询前三推荐商品
	public function recommend()
	{
		$res = $this->where('is_recommend', 'eq', 1)->limit(3)->select();
		return $res;
	}

	# 查询前四秒杀商品
	public function seckillGood()
	{
		$res = $this->where('is_seckill', 'eq', 1)->limit(4)->select();
		return $res;
	}

	# 查询商品基本信息
	public function selectOne()
	{
		return $this->where('gid', 'eq', input('param.gid'))->find();
	}

	# 查询商品图片信息
	public function selectPicture()
	{
		$res_good = $this->where('gid', 'eq', input('param.gid'))->find();
		$small_pic = explode(';', $res_good->picture->small_picture);
		$mid_pic = explode(';', $res_good->picture->mid_picture);
		$big_pic = explode(';', $res_good->picture->big_picture);
		$picture = [];
		for ($i=0; $i < count($small_pic); $i++) { 
			$picture[$i]['small_picture'] = $small_pic[$i];
			$picture[$i]['mid_picture'] = $mid_pic[$i];
			$picture[$i]['big_picture'] = $big_pic[$i];
		}
		return $picture;
	}

	# 查询相似商品
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

	public function collection()
	{
		return $this->hasMany('Collection', 'good_id');
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

	public function foot()
	{
		return $this->hasMany('Foot', 'good_id');
	}

	public function param()
	{
		return $this->hasOne('Param', 'good_id');
	}

	public function picture()
	{
		return $this->hasOne('Picture', 'good_id');
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