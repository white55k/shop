<?php

namespace app\admin\model;

use app\admin\model\Picture;
use app\admin\model\Sort;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Good extends Model
{
	use SoftDelete;

	protected $pk = 'gid';

	# 查询分类商品
	public function selectAll()
	{
		$sort = new Sort;
		$res_sid = $sort->where('name', 'eq', input('param.name'))->find()->sid;
		$res = $this->where('sort_id', 'eq', $res_sid)->paginate(5, false, ['query'=>request()->get()]);
		return $res;
	}

	# 搜索商品信息
	public function searchAll()
	{
		$name = input('param.name');
		$res = $this->where('name', 'like', '%' . $name . '%')
			 ->whereOr('shop_number', 'like', '%' . $name . '%')
			 ->whereOr('keyword', 'like', '%' . $name . '%')
			 ->whereOr('gid', 'like', '%' . $name . '%')
			 ->paginate(5, false, ['query'=>request()->get()]);
		return $res;
	}

	# 查询商品信息
	public function selectGood($name)
	{
		$sort = new Sort;
		$res_sid = $sort->where('name', 'eq', $name)->find()->sid;
		$res = $this->where('sort_id', 'eq', $res_sid)->paginate(5, false, ['query'=>request()->get()]);
		return $res;
	}

	# 查询一个商品
	public function selectOne()
	{
		$res = $this->where('gid', 'eq', input('param.gid'))->find();
		return $res;
	}

	# 更新一个商品
	public function updateShop()
	{
		$validate = new Validate([
			'name'			=>	'require|max:32',
			'shop_number'	=>	'require|number|between:1000000000,5000000000',
			'keyword'		=>	'require|max:128',
			'price'			=>	'require|number',
			'money'			=>	'require|number',
			'stock'			=>	'require|number',
			'is_recommend'	=>	'require|number|between:0,1',
			'is_seckill'	=>	'require|number|between:0,1'
		]);

		$post = request()->post();
		$res_good = $this->where('gid', 'eq', $post['gid'])->find();

		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$res = $res_good->save($post);
		return $res;
	}

	# 添加一个商品
	public function addShop()
	{
		$post = request()->post();
		$path_url = request()->file('path_url');

		$validate = new Validate([
			'sort_id'		=>	'require|max:32',
			'name'			=>	'require|max:32',
			'keyword'		=>	'require|max:128',
			'price'			=>	'require|number',
			'money'			=>	'require|number',
			'stock'			=>	'require|number',
			'is_recommend'	=>	'require|number|between:0,1',
			'is_seckill'	=>	'require|number|between:0,1'
		]);
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		if (!$path_url) {
			return '请传入图片';
		}

		$path_info = $path_url->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$path_info) {
			return '请检查图片';
		}

		$url_p = DS . 'static' . DS . 'upload' . DS . $path_info->getSaveName();

		$shop_number = $this->where('1=1')->order('shop_number', 'desc')->find()->shop_number+1;

		$this->sort_id = $post['sort_id'];
		$this['name'] = $post['name'];
		$this->shop_number = $shop_number;
		$this->keyword = $post['keyword'];
		$this->price = $post['price'];
		$this->money = $post['money'];
		$this->stock = $post['stock'];
		$this->is_recommend = $post['is_recommend'];
		$this->is_seckill = $post['is_seckill'];
		$picture = new Picture;
		$picture->path_url = $url_p;
		$this->picture = $picture;
		$res = $this->together('picture')->save();
		return $res;
	}

	# 删除一个商品
	public function delShop()
	{
		$gid = input('param.gid');
		$good = $this::get($gid);
		$res = $good->delete();
		return $res;
	}

	public function picture()
	{
		return $this->hasOne('Picture', 'good_id');
	}

	public function sort()
	{
		return $this->belongsTo('Sort', 'sort_id');
	}
}