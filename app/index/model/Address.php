<?php

namespace app\index\model;

use app\index\model\User;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Address extends Model
{
	use SoftDelete;

	protected $pk = 'aid';

	# 获取用户所有收货地址信息
	public function getAddress()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 添加新地址
	public function newAddress()
	{
		$validate = new Validate([
			'consignee' =>	'require|max:32',
			'phone' 	=>	'require|number|between:10000000000,20000000000',
			'province'	=>	'require|max:16|notIn:1,2',
			'city'		=>	'require|max:16|notIn:1,2',
			'country'	=>	'require|max:16|notIn:1,2',
			'address'	=>	'require|max:128'
		]);
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$post['user_id'] = $res_uid;
		$this->save($post);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	# 更改收货地址
	public function updateAddress()
	{
		$validate = new Validate([
			'consignee' =>	'require|max:32',
			'phone' 	=>	'require|number|between:10000000000,20000000000',
			'province'	=>	'require|max:16|notIn:1,2',
			'city'		=>	'require|max:16|notIn:1,2',
			'country'	=>	'require|max:16|notIn:1,2',
			'address'	=>	'require|max:128'
		]);
		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$res = $this->get(input('param.aid'));
		$post['user_id'] = $res_uid;
		$res->save($post);
		$res = $this->where('user_id', 'eq', $res_uid)->select();
		return $res;
	}

	public function updateAdd()
	{
		$data = [];
		$aid = input('post.aid');
		$consignee = input('post.consignee');
		$phone = input('post.phone');
		$province = input('post.province');
		$city = input('post.city');
		$country = input('post.country');
		$address = input('post.address');
		if ($consignee) {
			$data['consignee'] = input('post.consignee');
		}if ($phone) {
			$data['phone'] = input('post.phone');
		}
		if ($province != '请选择省份') {
			$data['province'] = input('post.province');
		}
		if ($city != '请选择城市') {
			$data['city'] = input('post.city');
		}
		if ($country != '县/区') {
			$data['country'] = input('post.country');
		}
		if ($address) {
			$data['address'] = input('post.address');
		}
		if ($data == null) {
			return "您未修改任何内容";
		}
		$res = $this->where('aid','eq',$aid)->find();
		$res = $res->data($data)->save();
		if ($res) {
			return "修改成功";
		} else {
			return "修改失败";
		}
	}

	# 删除收货地址
	public function delAddr()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$address = $this->where('aid', 'eq', input('param.aid'))
			 ->where('user_id', 'eq', $res_uid)
			 ->find();
		$res = $address->delete();
		return $res;
	}

	# 修改默认地址
	public function defaultAddr()
	{
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$res_uid = $user->getByUsername($username)->uid;
		$addr = $this::get(['user_id'=>$res_uid])->all();
		foreach ($addr as $v) {
			$v->save(['is_default'=>0]);
		}
		$address = $this::get(input('param.aid'));
		$res = $address->save(['is_default'=>1]);
		$res_address = $this->where('user_id', 'eq', $res_uid)->select();
		return $res_address;
	}

	public function address()
	{
		$username = session('username') ? session('username') : cookie('username');
		# 获取user——ID
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;
		# 遍历所有的收货地址
		$addressAll = $this->where('user_id','eq',$user_id)->select();
		return $addressAll;
	}

	# 设置默认
	public function changeMoren()
	{
		$aid = input('param.mid');
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;
		# 修改当前user所有的默认收货地址
		$addr = $this->where('user_id','eq',$user_id)->find();
		$result = $addr->data(['is_default'=>0])->save();
		# 指定默认
		$address = $this->where('aid','eq',$aid)->find();
		$res = $address->data(['is_default'=>1])->save();
		return $res;
	}

	# 新增收货地址
	public function addAddress()
	{
		$data = [];
		$user = new User;
		$username = session('username') ? session('username') : cookie('username');
		$user_id = $user->getByUsername($username)->uid;
		$data['user_id'] = $user_id;
		$consignee = input('post.consignee');
		$phone = input('post.phone');
		$province = input('post.province');
		$city = input('post.city');
		$country = input('post.country');
		$address = input('post.address');
		if ($consignee) {
			$data['consignee'] = input('post.consignee');
		}if ($phone) {
			$data['phone'] = input('post.phone');
		}
		if ($province != '请选择省份') {
			$data['province'] = input('post.province');
		}
		if ($city != '请选择城市') {
			$data['city'] = input('post.city');
		}
		if ($country != '县/区') {
			$data['country'] = input('post.country');
		}
		if ($address) {
			$data['address'] = input('post.address');
		}
		if ($data == null) {
			return "您未添加任何内容";
		}
		$res = $this->data($data)->save();
		if ($res) {
			return "添加成功";
		} else {
			return "添加失败";
		}
	}
	# 删除收货地址
	public function changeDel()
	{
		$aid = input('post.aid');
		$res = $this::get($aid);
		return $res->delete();
	}

	public function user()
	{
		return $this->belongsTo('User', 'user_id');
	}
}