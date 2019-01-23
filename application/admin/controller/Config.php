<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\ConfigModel;

class config extends common
{
    public function index()
    {

        $list=ConfigModel::where('id',1)->find();
        if($_POST){
            $filePath="";
            $image=request()->file('img');
            $data=request()->post();
            if($image){
                $info=$image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                }

            }
            $list->img=$filePath;
            $list->address=$data['address'];
            $list->phone=$data['phone'];
            $list->info=$data['info'];
            $list->copy=$data['copy'];
            $list->content=$data['content'];
            $list->email=$data['email'];
            if($list->save()){
                $this->redirect('Config/index');
            }else{
                $this->error('修改失败!');
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }
}
