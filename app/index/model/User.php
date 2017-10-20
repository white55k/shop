<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class User extends Model
{
	use SoftDelete;

	protected $pk = 'uid';

	public function index()
	{
		/*$data = [
			'captcha' => '1234'
		];
		$res = $this->validate($data, [
			'captcha|验证码' => 'require|captcha'
		]);
		dump($res->toArray());*/
	}

	public function shop()
	{
		return $this->hasOne('Shop', 'uid');
	}
}