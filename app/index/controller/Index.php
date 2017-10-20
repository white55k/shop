<?php

namespace app\index\controller;

use app\index\model\User;
use think\Controller;

class Index extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->user = new User;
	}

    public function index()
    {
        /*$res = $this->user->index();
        $data = [
			'captcha' => '1234'
		];
		$res = $this->validate($data, [
			'captcha|验证码' => 'require|captcha'
		]);
		echo $res;*/
        return $this->fetch('/index');
    }
}
