<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\UserModel;
use think\Session;
class Editmanager extends common
{
    public function manager()
    {
        $data = Db::table('user')->select();//接收数据
        if(Session::get('admin_type')==1){
            $data = Db::table('user')->where(['type',1])->where('username',Session::get('uname'))->select();
        }
        $this->assign('list', $data);
        return $this->fetch();
    }

    //这是增加管理员的方法
    public function addmanager()
    {
        if($_POST){
            $data = request()->post();
            //var_dump($data);die;
            $username = $data['user_name'];//用户提交的姓名与数据库的姓名一致
            $user=UserModel::where('username',$username)->find();
            if($user){
               $this->error('该用户名已存在!');
            }
            $password = md5($data['password']);//用户提交的密码与数据库的密码一致
            $where['username'] = $username;
            $where['password'] = $password;
            $where['create_time'] = date("Y-m-d H:i:s",time());
            $where['update_time'] = date("Y-m-d H:i:s",time());
            $res = Db::table('user')->insert($where);
        if($res)
        {
            $this->redirect('Editmanager/manager');
        }else
            {
                $this->error('管理员添加失败!');
            }
        }
        return $this->fetch();
    }
    //这是编辑管理员的方法
    public function edit()
    {
        if($_POST)
        {
            $date=request()->post();
            $user_id=$date['user_id'];//用户提交的数据
            //var_dump($user);die;
            $sqll=Db::table('user')->where('id','<>',$user_id)->where('username',$date['username'])->find();
            //var_dump($sqll);die;
            if($sqll)
            {
                $this->error("该用户名已存在!");
            }
            $data['password']=md5($date['password']);
            $data['update_time'] = date("Y-m-d H:i:s",time());
            $sql=Db::table('user')->where(['id'=>$user_id])->update($data);
            if($sql)
            {
                $this->success('修改成功','Editmanager/manager');
            }else
            {
                $this->error('管理员修改失败');
            }
        }
        $id=$_GET['uid'];//接收传过来的ID
        //var_dump($id);die;
        $rows=Db::table('user')->where(['id'=>$id])->find();
        //var_dump($rows);die;
        $this->assign('uid',$rows);

        return $this->fetch();
    }
    //这是删除管理员的方法
    public function delete()
    {
        $did=$_GET['did'];
        //var_dump($did);die;
        $del=Db::table('user')->where(['id'=>$did])->delete();
        if($del)
        {
            $this->redirect('Editmanager/manager');
        }else
            {
                $this->error('管理员删除失败');
            }

    }

}