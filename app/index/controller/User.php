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
	#取消记住密码
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
		$email = input('post.email');
		$code = substr(str_shuffle(md5(time())), 2,6);
		$newcode = sendEmail($email,$code);
		if($newcode){
			session('code',$code);
		}else{
			return '邮件发送失败';
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
			'email' => input('post.email'),
			'password' => input('post.password')
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
		$code=substr(str_shuffle('0123456789'), 2,6);
		$get = input('post.phone');
		$phonemes = sendMessage($get,$code);
		if ($phonemes) {
			session('code_phone',$code);
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

	
	
}