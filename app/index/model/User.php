<?php

namespace app\index\model;

use think\Model;
use think\Validate;
class User extends Model
{
	# 登录
	public function dologin()
	{
		$name = input('post.name');
		$password = md5(input('post.password'));
		$res = $this->where('username','eq',$name)->find();
		if (!$res) {
			return 1; //用户名不存在
		} else if (strcmp($password, $res->password) == 0){
			session('username',$name);
			session('password',$password);
			return 3;  //ok
		} else {
			return 2;  //密码错误
		}	
	}

	# 邮箱注册
	public function doregister()
	{
		$email = input('post.email');
		$password = md5(input('post.password'));
		$repassword = md5(input('post.repassword'));
		$code = input('post.code');
		if ($code != session('code')) {
			return '验证码错误';
		}
		if ($password != $repassword) {
			return '两次密码不一致';
		} else {
			$this->username = $email;
			$this->password = $password;
			return $res = $this->save();
		}

	}
	# 手机注册
	public function doregister_2()
	{
		$phone = input('post.phone');
		$password = md5(input('post.password'));
		$repassword = md5(input('post.repassword'));
		$code = input('post.code');
		if ($code != session('code_phone')) {
			return '验证码错误';
		}
		if ($password != $repassword) {
			return '两次密码不一致';
		} else {
			$this->username = $phone;
			$this->password = $password;
			return $res = $this->save();
		}
	}

	public function address()
	{
		return $this->hasMany('Address', 'user_id');
	}

	public function car()
	{
		return $this->hasOne('Car', 'user_id');
	}

	public function coupon()
	{
		return $this->belongsTo('Coupon', 'user_id');
	}


	

}