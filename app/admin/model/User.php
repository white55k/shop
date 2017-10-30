<?php

namespace app\admin\model;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class User extends Model
{
	use SoftDelete;

	protected $pk = 'uid';

	# 管理员身份验证
	public function yanZheng()
	{
		$username = input('param.username');
		$password = md5(input('param.password'));

		$validate = new Validate([
			'username' => 'require|max:25',
			'password' => 'require|max:32'
		]);
		$data = [
			'username' => $username,
			'password' => $password
		];
		if (!$validate->check($data)) {
			return false;
		}
		$res = $this->where('username', 'eq', $username)
			 ->whereOr('phone', 'eq', $username)
			 ->whereOr('email', 'eq', $username)
			 ->find();

		if (!$res) {
			return false;
		}
		if (strcmp($res->password, $password)) {
			return false;
		}

		$data = [
			'update_time' => time(),
			'logip'		  => ip2long($_SERVER['REMOTE_ADDR'])
		];
		$this->where('username', 'eq', $username)
			 ->whereOr('phone', 'eq', $username)
			 ->whereOr('email', 'eq', $username)
			 ->update($data);
		return $res->admin;
	}

	# 查询所有用户
	public function selectAll()
	{
		$res = $this->where('1=1')->paginate(6);
		return $res;
	}

	# 查询一个用户
	public function selectOne()
	{
		$res = $this->where('uid', 'eq', input('param.uid'))->find();
		return $res;
	}

	# 搜索一个用户
	public function searchUser()
	{
		$name = input('param.name');
		$res = $this->where('username', 'like', '%' . $name . '%')
			 ->whereOr('phone', 'like', '%' . $name . '%')
			 ->whereOr('email', 'like', '%' . $name . '%')
			 ->whereOr('uid', 'like', '%' . $name . '%')
			 ->paginate(5);
		return $res;
	}

	# 更新一个用户信息
	public function updateUser()
	{
		$validate = new Validate([
			'username'	=> 'require|max:25',
			'password'	=> 'require|max:32',
			'level'		=> 'require|number|between:1,175',
			'email'		=> 'require|email',
			'phone'		=> 'require|number|between:10000000000,20000000000',
			'realname'	=> 'require|max:16',
			'question'	=> 'require|max:32',
			'answer'	=> 'require|max:32'
		]);
		$post = request()->post();
		$res_user = $this::get(input('param.uid'));
		if (!strcmp($res_user->password, input('param.password'))) {
			$post['password'] = md5(input('param.password'));
		}
		if (!$validate->check($post)) {
			return $validate->getError();
		}
		$res = $res_user->allowField(['username', 'password', 'level', 'email', 'phone', 'realname', 'question', 'answer'])->save($post);
		return $res;
	}

	#删除用户
	public function delUser()
	{
		$user = $this::get(input('param.uid'));
		$res = $user->delete();
		return $res;
	}

	# 添加一个用户
	public function addUser()
	{
		$validate = new Validate([
			'username' => 'require|min:2|max:32',
			'password' => 'require|min:8|max:32'
		]);

		$post = request()->post();
		if (!$validate->check($post)) {
			return $validate->getError();
		}

		$post['regip'] = ip2long($_SERVER['REMOTE_ADDR']);
		$post['logip'] = $post['regip'];
		$post['password'] = md5($post['password']);
		$res = $this->data($post)->save();
		return $res;
	}

	public function address()
	{
		return $this->hasMany('Address', 'user_id');
	}

	public function admin()
	{
		return $this->hasOne('Admin', 'user_id');
	}

	public function level()
	{
		return $this->belongsTo('Level', 'level_id');
	}
}