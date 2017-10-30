<?php

namespace app\admin\model;

use app\admin\model\Menu;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Sort extends Model
{
	use SoftDelete;

	protected $pk = 'sid';

	public function selectAll()
	{
		$menu = new Menu;
		$res_mid = $menu->where('name', 'eq', input('param.name'))->find()->mid;
		$res = $this->where('menu_id', 'eq', $res_mid)->select();
		return $res;
	}

	public function allSelect()
	{
		$menu = new Menu;
		$res = $menu->where('1=1')->select();
		return $res;
	}

	public function good()
	{
		return $this->hasMany('Good', 'sort_id');
	}

	public function menu()
	{
		return $this->belongsTo('Menu', 'menu_id');
	}
}