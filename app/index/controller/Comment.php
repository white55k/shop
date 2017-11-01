<?php

namespace app\index\controller;

use app\index\model\Comment as CommentRel;
use app\index\model\Good;
use think\Controller;

class Comment extends Controller
{
	protected $comment;
	protected $good;

	public function _initialize()
	{
		parent::_initialize();
		$this->good = new Good;
		$this->comment = new CommentRel;
	}

	public function comment()
	{
		$res = $this->good->commentNew();
		$order_number = input('param.order_number');
		return $this->fetch('/commentlist',[
			'resultp' => $res,
			'order_number' => $order_number,
		]);
	}

	# 评论
	public function docommon()
	{
		$res = $this->comment->docommon();
		return $res;
	}
}