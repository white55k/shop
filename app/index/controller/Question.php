<?php
namespace app\index\controller;

use app\index\model\User as UserModel;
use think\Controller;
use think\Validate;
class Question extends Controller
{
	protected $user;

	public function _initialize()
	{
		parent::_initialize();

		$this->user = new UserModel;

	}

	public function questionAns()
	{
		
		return $this->fetch('/question');
	}
	# 密保问题
	public function addQuestion()
	{
		$question = input('post.question');
		$answer = htmlspecialchars(input('post.answer'));
		$validate = new Validate([
			'answer' => 'require|max:32|min:1'
		]);
		$data = [
			'answer' => $answer,
		];
		if (!$validate->check($data)) {
			return( $validate->getError());
		} else {
			$res = $this->user->question();
			return $res;
		}
	}

}