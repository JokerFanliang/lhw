<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use think\Session;
use app\model\User;

 class Login extends Controller
{
    public function login()
 {
      if($_POST)//判断是否是post提交
      {
         $data=$this->request->post();
         $username = $data['username'];//用户提交的姓名

         $password = md5($data['password']);//用户提交的密码

         $where['username'] = $username;//用户的姓名与数据库中的姓名一致
         $where['password'] = $password;//用户的密码与数据库里的密码一致
         $sql = Db::table('user')->where($where)->find();

        if ($sql){
            //Db::table('user')->where(['username'=>$username])->save(['addtime'=>time()]);
         Session::set('admin_type', $sql['type']);
         Session::set('uname', $username);
         Session::get('uname');
         $this->redirect("Index/index","登录成功");
        } else {

            $this->error("用户名或密码错误!",'Login/login');
        }
          }
     return $this->fetch();
 }


}