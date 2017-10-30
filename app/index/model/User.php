<?php

namespace app\index\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;
class User extends Model
{
	
	use SoftDelete;
	# 登录
	public function dologin()
	{
		$name = input('post.name');
		$password = md5(input('post.password'));
		$res = $this->where('username','eq',$name)->whereOr('email','eq',$name)->whereOr('phone','eq',$name)->find();
		if (!$res) {
			return 1; //用户名不存在
		} else if (strcmp($password, $res->password) == 0){
			$name = $res['username'];
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
			$this->email = $email;
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
			$this->phone = $phone;
			return $res = $this->save();
		}
	}

	public function checkMail()
	{
		return $this->where('email', 'eq', input('post.email'))->find();
	}
	public function userEmail()
	{
		$username = session('username') ? session('username') : cookie('username');
		return $this->where('email', 'eq', input('post.email'))->where('username','eq',$username)->find();
	}

	public function checkPhone()
	{
		return $this->where('phone', 'eq', input('post.phone'))->find();
	}
	
	# 用户基本信息
	public function message()
	{
		$username = session('username') ? session('username') : cookie('username');
		$res = $this->where('username','eq',$username)->find();
		return $res;
	}


	# 更改用户信息
	public function change()
	{
		$data = [];
		$name = session('username') ? session('username') : cookie('username');
		$username = input('post.username');
		if ($username) {
			$data['username'] = $username;
		}

		$realname = input('post.realname');
		if ($realname) {
			$data['realname'] = $realname;
		}

		$sex = input('post.sex');
		if ($sex) {
			$data['sex'] = $sex;
		}

		$birthday = input('post.birthday');
		if ($birthday) {
			$data['birthday'] = $birthday;
		}

		$phone = input('post.phone');
		if ($phone) {
			$data['phone'] = $phone;
		}

		$email = input('post.email');
		if ($email) {
			$data['email'] = $email;
		}
		if ($data == null) {
			return 2;
		}

		$res = $this->where('username','eq',$name)->update($data);
		return $res;
	} 
	# 更改头像
	public function changePic()
	{
		// 获取表单上传文件 
    	$file = request()->file('file');
    	// 移动到框架应用根目录/public/uploads/ 目录下
   		$info = $file->move(ROOT_PATH . 'public' . DS .'static' . DS.'upload');
   		if ($info) {
   			$picture = '\static'. DS .'upload'. DS .$info->getSaveName();
   		}else{
        // 上传失败获取错误信息
        return($file->getError()) ;
    	}
    	# 保存头像
    	$username = session('username') ? session('username') : cookie('username');
    	$res = $this->where('username','eq',$username)->update(['picture' => $picture]);
    	return $res;
	}
	# 更改密码
	public function newpwd()
	{
		$username = session('username') ? session('username') : cookie('username');
		$oldpwd = md5(input('post.password'));
		$newpwd = md5(input('post.newpwd'));
		$repwd = md5(input('post.repwd'));
		if ($newpwd != $repwd) {
			return "2";
		} else if($oldpwd == $newpwd) {
			return 1;
		} else{
			$res = $this->where('username','eq',$username)->update(['password' => $newpwd]);
			if ($res) {
				return 1;
			} else {
				return 0;
			}
		}	
	}
	# 更改绑定的手机号码
	public function changePhone()
	{
		$username = session('username') ? session('username') : cookie('username');
		$phone =  input('post.phone');
		$sql = $this->where('phone','eq',$phone)->find();
		if ($sql) {
			if ($sql['username'] == $username) {
				return "您之前已经完成了该手机的绑定";
			}
			return "该手机号码已绑定其他用户";
		}
		$res = $this->where('username','eq',$username)->update(['phone' => $phone]);
		if ($res) {
			# 查看原始手机号是否为空
			$oldPhone = $this->where('username','eq',$username)->find();
			if (!$oldPhone['Phone']) {
				$old_score =$oldPhone['safe_score'] + 20;
				$end = $this->where('username','eq',$username)->update(['safe_score' => $old_score]);
			}
			return "修改成功";
		}else{
			return "修改失败，请重新确认后再提交";
		}
	}

	# 更改邮箱绑定

	public function changeEmail()
	{
		$username = session('username') ? session('username') : cookie('username');
		$email = input('post.email');
		$code = session('code');
		$ncode = input('post.code');
		# 判断验证码
		if ($code != $ncode) {
			return "验证码错误，请重新填写";
		}
		$res = $this->where('username','eq',$username)->update(['email' => $email]);
		if ($res) {
			# 判断之前邮箱是否为空
			$oldEmail = $this->where('username','eq',$username)->find();
			if (!$oldEmail['email']) {
				$oldEmail['safe_score'] +=20;
				$end = $this->where('username','eq',$username)->update(['safe_score' => $oldEmail['safe_score']]);
			}
			return "修改成功";
		}else{
			return "修改失败，请重新确认后再提交";
		} 
	}
	public function question()
	{
		$username = session('username') ? session('username') : cookie('username');
		$question = input('post.question');
		$answer = input('post.answer');
		$res = $this->where('username','eq',$username)->update([
			'answer' => $answer,
			'question' => $question,
		]);
		if ($res) {
			return "保存成功";
		} else {
			return "保存失败,原因有可能是您的密保答案和上次的答案一致";
		}
	}
	public function findLevel()
	{
		$username = session('username') ? session('username') : cookie('username');
		$res = $this->where('username','eq',$username)->find();
		return $res;
	}

	# 建立关联关系 
	public function level()
	{
		return $this->belongsTo('Level','level_id');
	}


	

}