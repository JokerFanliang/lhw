<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\CooperationModel;

class Cooperation extends common
{
    public function index()
    {

        $list=CooperationModel::where('id',1)->find();
        if($_POST){
            $channel_image=request()->file('channel_img');
            $media_image=request()->file('media_img');
            $link_image=request()->file('link_img');
            $adchange_image=request()->file('adchange_img');
            $adsend_image=request()->file('adsend_img');
            $other_image=request()->file('other_img');
            $data=request()->post();
            if($channel_image){
                $info=$channel_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $channel_img= str_replace('\\', '/', $filePathss);
                    $list->channel_img=$channel_img;

                }

            }
            if($media_image){
                $info=$media_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $media_img= str_replace('\\', '/', $filePathss);
                    $list->media_img=$media_img;

                }

            }
            if($adchange_image){
                $info=$adchange_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $adchange_img= str_replace('\\', '/', $filePathss);
                    $list->adchange_img=$adchange_img;

                }

            }
            if($adsend_image){
                $info=$adsend_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $adsend_img= str_replace('\\', '/', $filePathss);
                    $list->adsend_img=$adsend_img;

                }

            }
            if($other_image){
                $info=$other_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $other_img= str_replace('\\', '/', $filePathss);
                    $list->other_img=$other_img;
                }

            }
            if($link_image){
                $info=$link_image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $link_img= str_replace('\\', '/', $filePathss);
                    $list->link_img=$link_img;

                }

            }

            $list->channel_content=$data['channel_content'];
            $list->media_content=$data['media_content'];
            $list->link_content=$data['link_content'];
            $list->adchange_content=$data['adchange_content'];
            $list->adsend_content=$data['adsend_content'];
            $list->other_content=$data['other_content'];

            if($list->save()){
                $this->redirect('Cooperation/index');
            }else{
                $this->error('修改失败!');
            }
        }
        $this->assign('list',$list);
        return $this->fetch();
    }
}
