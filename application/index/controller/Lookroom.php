<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Db;
use app\model\StrategyModel;

class Lookroom extends Controller
{
    //这是看房攻略的方法
    public function kanfanggonglue()
    {
        Session::set('title','strategy');
       //这是处理分页的方法
       $sql=Db::table('strategy')->order('create_time','desc')->paginate(5);
        //print_r($sql);die;
        $this->assign('list',$sql);
        //这是处理阅读排行的方法
        $sqll=Db::table('strategy')->order('read_count desc')->count();
        if($sqll<10)
        {
            $sqll=Db::table('strategy')->order('is_hot desc')->order('read_count desc')->select();
        }else if($sqll>=10)
        {
            $sqll=Db::table('strategy')->order('is_hot desc')->order('read_count desc')->limit(0,10)->select();
        }
        //var_dump($sqll);die;
        $this->assign('litt',$sqll);
        return $this->fetch();
    }
    //这是看房攻略详情的处理方法
    public function kanfanggonglue_msg()
    {
        $id=$_GET['id'];
        //var_dump($id);die;
        $data=StrategyModel::where(['id'=>$id])->find();
        $data->read_count=$data->read_count+1;
        $data->save();
        //print_r($data);die;
        $this->assign('menu',$data);
        //这是处理上一篇的方法
        $date=Db::table('strategy')->where('id','<',$id)->order('id desc')->find();
        $this->assign('prev',$date);
        //var_dump($date);die;
        //这是处理下一篇的方法
        $dat=Db::table('strategy')->where('id','>',$id)->find();
        $this->assign('next',$dat);
        //这是处理阅读次数的方法
        $yuedu=Db::table('strategy')->order('read_count desc')->count();
        if($yuedu<10)
        {
            $yuedu=Db::table('strategy')->order('is_hot desc')->order('read_count desc')->select();
        }else if($yuedu>=10)
        {
            $yuedu=Db::table('strategy')->order('is_hot desc')->order('read_count desc')->limit(0,10)->select();
        }
        //var_dump($yuedu);die;
        $this->assign('yue',$yuedu);

        return $this->fetch();
    }

}
