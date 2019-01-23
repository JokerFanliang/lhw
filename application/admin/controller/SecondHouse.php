<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\SecondHandHouseModel;
use app\model\CustomImgModel;
use app\model\AreaModel;

class SecondHouse extends common
{
    public function index()
    {

        $lists=SecondHandHouseModel::order('create_time','desc')->paginate(10);
        $this->assign('lists',$lists);
        return $this->fetch();
    }


    public function edit()
    {
        if($_POST){
            $data=request()->post();
            $house=SecondHandHouseModel::find($data['id']);
            $house->title=$data['title'];
            //$house->area=$data['city'].','.$data['region'];
            $house->address=$data['address'];
            //$house->acreage=$data['acreage'];
            //$house->price=$data['price'];
            $house->layout=$data['count1'].','.$data['count2'].','.$data['count3'].','.$data['count4'].'';
            $house->high=$data['num'];
            $house->orientation=$data['orientation'];
            //$house->lease_type=$data['lease_type'];
            //$house->decorate=$data['decorate'];
            if(isset($data['assort'])){
                $house->assort=implode(",",$data['assort']);
            }
            $house->info=$data['info'];
            $house->contact=$data['contact'];
            $house->phone=$data['phone'];
            $house->type=$data['type'];
            $house->hot_area=$data['hot_area'];
            $house->house_acreage=$data['house_acreage'];
            $house->land_acreage=$data['land_acreage'];
            $house->price1=$data['price1'];
            $house->price2=$data['price2'];
            if($house->type==1){
              $house->give_date=$data['give_date'];
            }else{
              $house->age=$data['age'];
            }

            $house->car=$data['car'];
            $house->email=$data['email'];
            $house->weixin=$data['weixin'];
            //$house->price_period=$data['price_period'];
            //$house->layout_diff=$data['layout_diff'];
            //$house->theme=$data['theme'];

            $house->checkout=$data['checkout'];
			      $house->is_hot=$data['is_hot'];
            $house->checkout_at=date("Y-m-d H:i:s",time());
            $files=request()->file('img');
            $id=0;
            if(!empty($files)){
              foreach($files as $file){
                  $file=$file->getInfo();
                  $name=explode(".",$file['name']);
                  $count=count($name);
                  $ext=$name[$count-1];
                  $path=PUBLIC_PATH."/custom/".$data['id']."/";
                  if (! file_exists($path)) {
                      mkdir($path,0777,true);
                  }
                  $name=$path.time().$id.".".$ext;
                  move_uploaded_file($file["tmp_name"],$name);
                  $img[]=[
                      'second_id'=>$data['id'],
                      'path'=>"/custom/".$data['id']."/".time().$id.".".$ext,
                      'create_time'=>date("Y-m-d H:i:s",time()),
                      'update_time'=>date("Y-m-d H:i:s",time())
                  ];
                  $id++;
              }
              $res=CustomImgModel::insertAll($img);
            }


            if($house->save()){
                $this->redirect('SecondHouse/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=SecondHandHouseModel::where('id',$id)->find();
        $imgs=CustomImgModel::where('second_id',$id)->select();
        $areas=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->select();
        $this->assign('areas',$areas);
        $this->assign('imgs',$imgs);
        $this->assign('list',$list);
        return $this->fetch();
    }

    public function delete(){
        $list=SecondHandHouseModel::where('id',$_GET['id'])->find();
        $list->delete();
        $this->success('删除成功');
    }

    public function delimg(){
        $img=CustomImgModel::where('id',$_GET['id'])->find();
        $img->delete();
        $this->success('删除成功');
    }



}
