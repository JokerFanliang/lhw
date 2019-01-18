<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\PriceModel;

class Price extends common
{
    public function index()
    {

        $lists=PriceModel::order('sort','desc')->where('is_delete',PriceModel::$isDelete['no']['val'])->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $price=new PriceModel();
            $price->min=$data['min'];
			$price->max=$data['max'];
            $price->sort=$data['sort'];
            if($price->save()){
                $this->redirect('Price/index');
            }else{
                $this->error('添加失败!');
            }
        }
        return $this->fetch();
    }

    public function edit()
    {
        if($_POST){
            $data=request()->post();
            $price=PriceModel::find($data['id']);
            $price->min=$data['min'];
			$price->max=$data['max'];
            $price->sort=$data['sort'];
            if($price->save()){
                $this->redirect('Price/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=PriceModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }


    public function delete()
    {
        $id=$_GET['id'];
        $price=PriceModel::where('id',$id)->find();
        $price->is_delete=PriceModel::$isDelete['yes']['val'];
        if($price->save()){
            $this->redirect('Price/index');
        }else{
            $this->error('删除失败!');
        }
    }



}