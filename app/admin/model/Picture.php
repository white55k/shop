<?php

namespace app\admin\model;

use app\admin\model\Good;

use think\Model;
use think\Validate;
use traits\model\SoftDelete;

class Picture extends Model
{
	use SoftDelete;

	protected $pk = 'pid';

	# 查询一个商品的大小图片
	public function selectAll()
	{
		$res_picture = $this::get(['good_id'=>input('param.gid')]);
		$small_pic = explode(';', $res_picture->small_picture);
		$mid_pic = explode(';', $res_picture->mid_picture);
		$big_pic = explode(';', $res_picture->big_picture);
		$picture = [];
		for ($i=0; $i < count($small_pic); $i++) { 
			$picture[$i]['small_picture'] = $small_pic[$i];
			$picture[$i]['mid_picture'] = $mid_pic[$i];
			$picture[$i]['big_picture'] = $big_pic[$i];
		}
		return $picture;
	}

	# 查询一个商品的详情图
	public function selectDetails()
	{
		$res_picture = $this::get(['good_id'=>input('param.gid')]);
		$res = explode(';', $res_picture->details_picture);
		return $res;
	}

	# 修改一个商品的大小图片
	public function updatePicture()
	{
		$s_pic = request()->file('small_picture');
		$m_pic = request()->file('mid_picture');
		$b_pic = request()->file('big_picture');

		if (!$s_pic || !$m_pic || !$b_pic) {
			return '请选择上传的图片';
		}

		$s_info = $s_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		$m_info = $m_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		$b_info = $b_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$s_info) {
			return $s_pic->getError();
		}
		if (!$m_info) {
			return $m_pic->getError();
		}
		if (!$b_info) {
			return $b_pic->getError();
		}
		$s_url = DS . 'static' . DS . 'upload' . DS . $s_info->getSaveName();
		$m_url = DS . 'static' . DS . 'upload' . DS . $m_info->getSaveName();
		$b_url = DS . 'static' . DS . 'upload' . DS . $b_info->getSaveName();

		$post = request()->post();
		$res_picture = $this->where('good_id', 'eq', $post['gid'])->find();

		$small_picture = str_replace($post['small_picture'], $s_url, $res_picture->small_picture);
		$mid_picture = str_replace($post['mid_picture'], $m_url, $res_picture->mid_picture);
		$big_picture = str_replace($post['big_picture'], $b_url, $res_picture->big_picture);

		unset($post['gid']);
		$post['small_picture'] = $small_picture;
		$post['mid_picture'] = $mid_picture;
		$post['big_picture'] = $big_picture;
		$res = $res_picture->save($post);
		return $res;
	}

	# 修改一个商品的详情图
	public function updateDetails()
	{
		$pic = request()->file('details_picture');
		if (!$pic) {
			return '请选择上传的图片';
		}

		$info = $pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$info) {
			return $pic->getError();
		}

		$url = DS . 'static' . DS . 'upload' . DS . $info->getSaveName();

		$res_picture = $this->where('good_id', 'eq', input('param.gid'))->find();
		$details = str_replace(input('param.details_picture'), $url, $res_picture->details_picture);

		$res = $res_picture->save(['details_picture'=>$details]);
		return $res;
	}

	# 添加一组商品的大中小图
	public function addPicture()
	{
		$s_pic = request()->file('small_picture');
		$m_pic = request()->file('mid_picture');
		$b_pic = request()->file('big_picture');

		if (!$s_pic || !$m_pic || !$b_pic) {
			return '请选择上传的图片';
		}

		$s_info = $s_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		$m_info = $m_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		$b_info = $b_pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$s_info) {
			return $s_pic->getError();
		}
		if (!$m_info) {
			return $m_pic->getError();
		}
		if (!$b_info) {
			return $b_pic->getError();
		}
		$s_url = DS . 'static' . DS . 'upload' . DS . $s_info->getSaveName();
		$m_url = DS . 'static' . DS . 'upload' . DS . $m_info->getSaveName();
		$b_url = DS . 'static' . DS . 'upload' . DS . $b_info->getSaveName();

		$res_picture = $this->where('good_id', 'eq', input('param.gid'))->find();
		if ($res_picture->small_picture) {
			$small_picture = $res_picture->small_picture . ';' . $s_url;
			$mid_picture = $res_picture->mid_picture . ';' . $m_url;
			$big_picture = $res_picture->big_picture . ';' . $b_url;
		} else {
			$small_picture = $s_url;
			$mid_picture = $m_url;
			$big_picture = $b_url;
		}

		$data = [
			'small_picture'	=>	$small_picture,
			'mid_picture'	=>	$mid_picture,
			'big_picture'	=>	$big_picture
		];

		$res = $res_picture->save($data);
		return $res;
	}

	# 添加一个商品的详情图
	public function addDetails()
	{
		$pic = request()->file('details_picture');
		if (!$pic) {
			return '请选择上传的图片';
		}

		$info = $pic->validate(['size'=>1024*1024*15, 'ext'=>'jpg,jpeg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'static' . DS . 'upload');
		if (!$info) {
			return $pic->getError();
		}

		$url = DS . 'static' . DS . 'upload' . DS . $info->getSaveName();

		$res_picture = $this->where('good_id', 'eq', input('param.gid'))->find();
		if ($res_picture->details_picture) {
			$details = $res_picture->details_picture . ';' . $url;
		} else {
			$details = $url;
		}

		$res = $res_picture->save(['details_picture'=>$details]);
		return $res;
	}

	public function good()
	{
		return $this->belongsTo('Good', 'good_id');
	}
}