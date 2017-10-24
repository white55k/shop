<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------
//session->code 邮箱验证码
//session->code_phone手机验证码
// 应用公共文件
	# 邮箱验证
use send_email\PHPMailer;
use send_email\SMTP;
	# 手机验证
use send_message\Ucpaas;
//邮箱验证
function sendEmail($email,$code)
{
	$mail = new PHPMailer();
	$mail->isSMTP();
	$mail->CharSet = "utf8";// 编码格式为utf8，不设置编码的话，中文会出现乱码
	$mail->Host = "smtp.163.com";// 发送方的SMTP服务器地址
	$mail->SMTPAuth = true;// 是否使用身份验证
	$mail->Username = "someonecallmefly@163.com";// 发送方的163邮箱用户名
	$mail->Password = "fly623651729";
	$mail->SMTPSecure = "ssl";// 使用ssl协议方式
	$mail->Port = 994;// 163邮箱的ssl协议方式端口号是465/994
	$mail->setFrom("someonecallmefly@163.com","XiaoFei");
	$mail->addAddress("$email",'小飞飞');
	$mail->Subject = "邮箱登录验证";// 邮件标题
	$mail->Body = "亲爱的顾客您好，你本次的验证码是" . $code . "请妥善保管";// 邮件正文
	$result = $mail->send();
	if($result){
		return true;
	}else{
		return false;
	}
}
//手机验证
function sendMessage($get,$code) 
{
	$options['accountsid']='586d5bc716d7f35a6c45eaa54c74624d';
	$options['token']='41a7dadc29b5ad6e492e72e6628ea42d';
	$ucpass = new Ucpaas($options);
	header("Content-Type:text/html;charset=utf-8");
	$appId = "b600fed721aa44838e55dc28bbf12940";
	$to = $get;
	$templateId = "183284";
	$param= $code;
	$res = $ucpass->templateSMS($appId,$to,$templateId,$param);
	if ($res) {
		return true;
	} else {
		return false;
	}

}
