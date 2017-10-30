<?php 
namespace app\index\controller;

use app\index\model\Site;
use app\index\model\User as UserModel;

use think\Controller;
use think\Validate;

class User extends Controller
{
	protected $site;
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		$this->site = new Site;
		$this->user = new UserModel;
	
		$res_site = $this->site->selectAll();
        $this->assign('res_site', $res_site);
	}

	# 登录主页
	public function login()
	{
		return $this->fetch('/login');
	}
	public function dologin()
	{
		$res = $this->user->dologin();
		return $res;
	}

	# 邮箱注册主页
	public function register()
	{
		return $this->fetch('/register');
	}
	# 发送邮箱验证码
	public function send()
	{
		$post = request()->post();
		$validate = new Validate([
			'email' => 'require|email'
		]);
		if (!$validate->check($post)) {
			return '格式错误';
		}
		$res = $this->user->checkMail();
		if ($res) {
			return '邮箱已存在';
		}
		$code = substr(str_shuffle(md5(time())), 2,6);
		$newcode = sendEmail($post['email'],$code);
		if($newcode){
			session('code',$code);
			return '邮件已发送';
		}else{
			return '邮箱发送失败,请认真核对您的邮箱号码';
		}
	}
	# 邮箱验证注册
	public function doregister()
	{
		$validate = new Validate([
			'email' => 'require|email',
			'password' => 'require|max:32|min:8|alphaNum'
		]);
		$data = [
			'email' => htmlspecialchars(input('post.email')),
			'password' => htmlspecialchars(input('post.password'))
		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->doregister();
			return $res;
		}

	}

	# 手机注册  
	//获取手机验证码
	public function phonemes()
	{
		$code = substr(str_shuffle('0123456789'), 2,6);
		$post = request()->post();
		$validate = new Validate([
			'phone'	=>	'require|number|between:10000000000,20000000000',
		]);
		if (!$validate->check($post)) {
			return '格式错误';
		}
		$res = $this->user->checkPhone();
		if ($res) {
			return '手机号已存在';
		}
		$phonemes = sendMessage($post['phone'],$code);
		if ($phonemes) {
			session('code_phone',$code);
			return '验证码已发送';
		} else {
			return "短信发送失败,请认真核对您的手机号码";
		}
	}
	# 手机验证注册
	public function doregister_2()
	{
		$validate = new Validate([
			'phone' => 'require|number|length:11',
			'password' => 'require|max:32|min:8|alphaDash'
		]);
		$data = [
			'phone' => htmlspecialchars(input('post.phone')),
			'password' => htmlspecialchars(input('post.password'))
		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->doregister_2();
			return $res;
		}

	}

	# 注销登陆
	public function quiet()
	{
		session('username', null);
		cookie('username', null);

		return $this->fetch('/login');
	}

	
	
}