<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\SystemModel;

class System extends common
{
    public function contact_us()
    {

        $list=SystemModel::where('name','contact_us')->find();
        if($_POST){
            $data=request()->post();
            $list->content=$data['content'];
            if($list->save()){
                $this->redirect('System/contact_us');
            }else{
                $this->error('修改失败!');   
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function network_marketing()
    {

        $list=SystemModel::where('name','network_marketing')->find();
        if($_POST){
            $data=request()->post();
            $list->content=$data['content'];
            if($list->save()){
                $this->redirect('System/network_marketing');
            }else{
                $this->error('修改失败!');   
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function recruit()
    {

        $list=SystemModel::where('name','recruit')->find();
        if($_POST){
            $data=request()->post();
            $list->content=$data['content'];
            if($list->save()){
                $this->redirect('System/recruit');
            }else{
                $this->error('修改失败!');   
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function service()
    {

        $list=SystemModel::where('name','service')->find();
        if($_POST){
            $data=request()->post();
            $list->content=$data['content'];
            if($list->save()){
                $this->redirect('System/service');
            }else{
                $this->error('修改失败!');   
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }






}