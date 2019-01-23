<?php
namespace app\service;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use think\Config;

class EmailService
{
	public function sendEmail($type,$email,$title,$content){
        $mail = new PHPMailer(true);
        try {
            // 服务器设置
            $mail->SMTPDebug = 0; // 开启Debug
            $mail->isSMTP(); // 使用SMTP
            $mail->Host = Config::get('EmailHost'); // 服务器地址
            $mail->SMTPAuth = true; // 开启SMTP验证
            $mail->Username = Config::get('EmailSender'); // SMTP 用户名（你要使用的邮件发送账号）
            $mail->Password = Config::get('EmailSecret'); // SMTP 密码
            $mail->SMTPSecure = 'ssl'; // 开启TLS 可选
            $mail->Port = Config::get('EmailPort'); // 端口
			//$mail->FromName = '陕西畅通网络科技有限公司';
            // 收件人
            $mail->setFrom(Config::get('EmailSender'),$type); // 来自
            //$mail->addAddress('395696661@qq.com'); // 添加一个收件人
            $mail->addAddress($email); // 可以只传邮箱地址


            // 附件
            //$mail->addAttachment('1.jpg'); // 添加附件
            //$mail->addAttachment('2.zip'); // 可以设定名字

            // 内容
            $mail->isHTML(true); // 设置邮件格式为HTML
            $mail->Subject = $title; //邮件主题
            $mail->Body = $content; //邮件内容

            $mail->send();
            return true;
            //echo '邮件发送成功。<br>';
        } catch (Exception $e) {
            echo '邮件发送失败。<br>';
            echo 'Mailer Error: ' . $mail->ErrorInfo;
        }
	}

}
