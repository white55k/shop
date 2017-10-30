<?php 
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;
use think\Session;
use think\Validate;

class User extends Controller
{
	//自定义一个构造函数
	
	protected $user;

	public function _initialize()
	{
		parent::_initialize();
		
		$this->user = new UserModel;
	
	}
	# 记住密码
	public function remember()
	{
		$name = input('post.name');
		$password = input('post.password');
		cookie('username',$name,86400*7);
		cookie('password',$password,86400*7);
	}
	# 取消记住密码
	public function unremember()
	{
		session('username','null');
		session('password','null');
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

	# 个人中心 邮箱验证
	public function sendYou()
	{
		$post = request()->post();
		$validate = new Validate([
			'email' => 'require|email'
		]);
		if (!$validate->check($post)) {
			return '格式错误';
		}
		$userEmail = $this->user->userEmail();
		if ($userEmail) {
			return '您已绑定过该邮箱';
		}
		$res = $this->user->checkMail();
		if ($res) {
			return '该邮箱已绑定其他用户';
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
	# 验证原手机号码验证
	public function phoneRe()
	{
		$code = substr(str_shuffle('0123456789'), 2,6);
		$phone = input('post.phone');
		$phonemes = sendMessage($phone,$code);
		if ($phonemes) {
			session('code_phone',$code);
			return '1';
		} else {
			return "0";
		}
	}
	# 再次获取验证码
	//获取手机验证码
	public function rphonemes()
	{
		$code=substr(str_shuffle('0123456789'), 2,6);
		$phone = input('param.phone');

		$validate = new Validate([
			'phone'	=>	'require|number|between:10000000000,20000000000',
		]);
		if (!$validate->check(['phone'=>$phone])) {
			return '0';
		}
		#检查是否已经被其他用户绑定
		$res = $this->user->checkPhone();
		if ($res) {
			return '1';
		}
		$phonemes = sendMessage($phone,$code);
		if ($phonemes) {
			session('newcode',$code);
			return '2';
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
			'phone' => input('post.phone'),
			'password' => input('post.password')
		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->doregister_2();
			return $res;
		}

	}
	# 修改手机验证

	public function doregisters()
	{
		$acode = input('post.acode');
		$phone = input('post.phone');
		$ancode = input('post.ancode');

		if ($acode != session('code_phone')) {
			return "原始手机验证码错误";
		}

		$validate = new Validate([
			'phone' => 'require|number|length:11',
		]);
		$data = [
			'phone' => input('post.phone'),

		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->changePhone();
			return $res;
		}

	}
	# 修改邮箱验证
	public function changeEmail()
	{
		$validate = new Validate([
			'email' => 'require|email',
		]);
		$data = [
			'email' => input('post.email'),
		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->changeEmail();
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