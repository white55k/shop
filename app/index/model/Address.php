<?php

namespace app\index\model;

use app\index\model\User;
use think\Model;
use traits\model\SoftDelete;
class Address extends Model
{
	use SoftDelete;

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
		$res = $this->where('aid','eq',$aid)->update($data);
		if ($res) {
			return "修改成功";
		} else {
			return "修改失败";
		}
	}
	# 设置默认
	public function changeMoren()
	{
		$aid = input('post.aid');
		$username = session('username') ? session('username') : cookie('username');
		$user = new User;
		$user_id = $user->getByUsername($username)->uid;
		# 修改当前user所有的默认收货地址
		$result = $this->where('user_id','eq',$user_id)->update(['is_default' => 0]);
		# 指定默认
		$res = $this->where('aid','eq',$aid)->update(['is_default' => 1]);
		return $res;
	}
	# 删除默认
	public function changDel()
	{
		$aid = input('param.aid');
		$address = $this::get($aid);
		$res = $address->delete();
		return $res;
	}
	# 新增收货地址
	public function addAddress()
	{
		$data = [];
		$user = new User;
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
		$res = $this->insert($data);
		return $res;
	}
}