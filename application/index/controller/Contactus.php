<?php
namespace app\index\controller;
use think\Controller;
use app\model\SystemModel;
use app\model\AdviceModel;
use think\Session;

class Contactus extends Controller
{
    //这是联系我们的方法
    public function callme()
    {
        Session::set('title', "callme");
        $list=SystemModel::where('name','contact_us')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //这是招聘信息的方法
    public function information()
    {
        Session::set('title', "information");
        $list=SystemModel::where('name','recruit')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //这是网络运营的方法
    public function network()
    {
        Session::set('title', "network");
        $list=SystemModel::where('name','network_marketing')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //这是服务声明的方法
    public function  service()
    {
        Session::set('title', "service");
        $list=SystemModel::where('name','service')->find();
        $this->assign('list',$list);
        return $this->fetch();
    }
    //这是意见反馈的方法
    public function suggestion()
    {
        if($_POST){
            $data=request()->post();
            $advice=new AdviceModel();
            $advice->name=$data['name'];
            $advice->contact=$data['contact'];
            $advice->content=$data['content'];
            if($advice->save()){
                $this->redirect('Contactus/suggestion');
            }else{
                $this->error('提交失败!');   
            }
        }
        Session::set('title', "suggestion");
        return $this->fetch();
    }

}
