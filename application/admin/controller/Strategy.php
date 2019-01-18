<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\UserModel;
use app\model\StrategyModel;

class Strategy extends common
{
    public function index()
    {

        $lists=StrategyModel::order('create_time','desc')->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $dada=request()->file('image');
            $strategy=new StrategyModel();
            $strategy->title=$data['title'];
            $strategy->from=$data['from'];
            $strategy->content=$data['content'];
			$strategy->is_hot=$data['is_hot'];
			$strategy->summary=$data['summary'];
            if (empty($dada)) {
                $this->error('请选择要上传的图片!');
                exit;
            }
            $info=$dada->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
            //var_dump($info['filename']);die;
            if($info){
            $filePathss = '/uploads'.'/'.$info->getSaveName();
            $filePath= str_replace('\\', '/', $filePathss);
            }

            $strategy->photo=$filePath;
            if($strategy->save()){
                $this->redirect('Strategy/index');
            }else{
                $this->error('攻略添加失败!');
            }
        }



        return $this->fetch();
    }

    public function edit()
    {
        if($_POST){
            $dada=request()->file('image');
            $data=request()->post();
            $strategy=StrategyModel::find($data['id']);
            $strategy->title=$data['title'];
            $strategy->from=$data['from'];
            $strategy->content=$data['content'];
			$strategy->is_hot=$data['is_hot'];
			$strategy->summary=$data['summary'];
            if($dada){
                $info=$dada->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                }

                $strategy->photo=$filePath;
            }
           

            if($strategy->save()){
                $this->redirect('Strategy/index');
            }else{
                $this->error('攻略修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=StrategyModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $strategy=StrategyModel::where('id',$id)->find();
        if($strategy->delete()){
            $this->redirect('Strategy/index');
        }else{
            $this->error('删除失败!');
        }
    }



}