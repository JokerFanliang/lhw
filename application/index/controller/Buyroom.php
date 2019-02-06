<?php
namespace app\index\controller;
use think\Controller;
use think\Session;
use think\Config;
use app\model\AreaModel;
use app\model\PriceModel;
use app\model\LayoutModel;
use app\model\ThemeModel;
use app\model\SecondHandHouseModel;
use app\model\CustomImgModel;
use app\model\AdModel;
use app\model\ConfigModel;
use app\model\SecondPriceModel;
use app\model\SecondHouseModel;
use app\model\SecondLandModel;
use app\service\EmailService;

class Buyroom extends Controller
{
    public function dichanmaimai()
    {
      // $secs=SecondHandHouseModel::select();
      // foreach($secs as $sec){
      //   if($sec->give_date){
      //        $yea=explode("-",$sec->give_date);
      //        $house=SecondHandHouseModel::find($sec->id);
      //        $house->give_date=$yea[0];
      //        $house->save();
      //   }
      // }
      // exit;
        Session::set('title','sale');
        $data=request()->get();
        $data['area']=isset($data['area']) ? $data['area'] : '0';
        $data['price']=isset($data['price']) ? $data['price'] : '0';
        $data['house_s']=isset($data['house_s']) ? $data['house_s'] : '0';
        $data['land_s']=isset($data['land_s']) ? $data['land_s'] : '0';
        $data['layout']=isset($data['layout']) ? $data['layout'] : '0';
        $data['give_date']=isset($data['give_date']) ? $data['give_date'] : '0';
        $data['theme']=isset($data['theme']) ? $data['theme'] : '0';
        $data['price_min']=isset($data['price_min']) ? $data['price_min'] : '';
        $data['price_max']=isset($data['price_max']) ? $data['price_max'] : '';
        if($data['price_min']!="" || $data['price_max']!=""){
            $data['price']=0;
        }
        $data['house_min']=isset($data['house_min']) ? $data['house_min'] : '';
        $data['house_max']=isset($data['house_max']) ? $data['house_max'] : '';
        if($data['house_min']!="" || $data['house_max']!=""){
            $data['house_s']=0;
        }
        $data['land_min']=isset($data['land_min']) ? $data['land_min'] : '';
        $data['land_max']=isset($data['land_max']) ? $data['land_max'] : '';
        if($data['land_min']!="" || $data['land_max']!=""){
            $data['land_s']=0;
        }
        // if(!Session::has('layout')){
        //     $layouts=[];
        //     Session::set('layout',$layouts);
        // }
        // if($data['layout']){
        //     $layouts=Session::get('layouts');
        //     if(in_array($data['layout'], $layouts)){
        //         $layouts = array_diff($layouts, [$data['layout']]);
        //     }else{
        //         array_push($layouts,$data['layout']);
        //     }
        //
        // }else{
        //     $layouts=[];
        // }
        // Session::set('layouts',$layouts);
        if(isset($data['searchname'])){
            $searchname=$data["searchname"];
            $house = SecondHandHouseModel::order('update_time','desc')->where('title','like','%'.$searchname.'%')->where('type',SecondHandHouseModel::$types['sale']['val'])->where("checkout",1)->paginate(9,false,['query'=>['searchname'=>$searchname]]);
        }else{
            $house = SecondHandHouseModel::where(function($query)use($data){
                if(isset($data['area']) && $data['area']!='0'){
                    $query->where('hot_area',$data['area']);
                }
                if($data['give_date']!='0'){
                    $query->where('give_date',$data['give_date']);
                }
                if(isset($data['price']) && $data['price']!='0'){
                    $price_period=explode("--",$data['price']);
                    $min_price=$price_period[0];
                    $max_price=$price_period[1];
                    if($max_price==0){
                        $query->where('price1','>=',$min_price);
                    }else{
                        $query->where('price1','>=',$min_price)->where('price1','<=',$max_price);
                    }
                }
                if(isset($data['house_s']) && $data['house_s']!='0'){
                    $house_period=explode("--",$data['house_s']);
                    $min_house=$house_period[0];
                    $max_house=$house_period[1];
                    if($max_house==0){
                        $query->where('house_acreage','>=',$min_house);
                    }else{
                        $query->where('house_acreage','>=',$min_house)->where('house_acreage','<=',$max_house);
                    }
                }
                if(isset($data['land_s']) && $data['land_s']!='0'){
                    $land_period=explode("--",$data['land_s']);
                    $min_land=$land_period[0];
                    $max_land=$land_period[1];
                    if($max_land==0){
                        $query->where('land_acreage','>=',$min_land);
                    }else{
                        $query->where('land_acreage','>=',$min_land)->where('land_acreage','<=',$max_land);
                    }
                }
                if($data['price_min']!=""){
                    $query->where('price1','>=',$data['price_min']);
                }
                if($data['price_max']!=""){
                    $query->where('price1','<=',$data['price_max']);
                }
                if($data['house_min']!=""){
                    $query->where('house_acreage','>=',$data['house_min']);
                }
                if($data['house_max']!=""){
                    $query->where('house_acreage','<=',$data['house_max']);
                }
                if($data['land_min']!=""){
                    $query->where('land_acreage','>=',$data['land_min']);
                }
                if($data['land_max']!=""){
                    $query->where('land_acreage','<=',$data['land_max']);
                }
                if(isset($data['layout']) && $data['layout']!='0'){
                    $query->where('layout_diff',$data['layout']);
                }
                // if(!empty($layouts)){
                //     $query->wherein('layout_diff',$layouts);
                // }
                if(isset($data['theme']) && $data['theme']!='0'){
                    $query->where('theme',$data['theme']);
                }

                $query->where('type',SecondHandHouseModel::$types['sale']['val']);
            })->order('update_time','desc')->where("checkout",1)->paginate(10,false,['query' => request()->param()]);
        }

        $imgs=[];
        $lists=SecondHandHouseModel::column('id');
        foreach($lists as $list){
            $vid=CustomImgModel::order('update_time','desc')->where('second_id',$list)->find();
            if($vid){
                $imgs[$list]=$vid->path;
            }else{
                $imgs[$list]="";
            }


        }
        $hothouse=SecondHandHouseModel::order('is_hot','desc')->where('type',SecondHandHouseModel::$types['sale']['val'])->where("checkout",1)->order('read_count','desc')->limit(0,20)->select();

        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $price=SecondPriceModel::order('create_time','desc')->select();
        $house_s=SecondHouseModel::order('create_time','desc')->select();
        $land_s=SecondLandModel::order('create_time','desc')->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->order('sort','desc')->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->order('sort','desc')->select();


        $this->assign('hothouse',$hothouse);
        $this->assign('imgs',$imgs);
        $this->assign('house',$house);
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('house_s',$house_s);
        $this->assign('land_s',$land_s);
        $this->assign('layout',$layout);
        $this->assign('theme',$theme);
        $this->assign('data',$data);

        return $this->fetch();
    }
    public function maimaifabu()
    {
        if($_POST){
            $data=request()->post();

            $house=new SecondHandHouseModel();
            $house->title=$data['title'];
            //$house->area=$data['city'].','.$data['region'];
            $house->address=$data['address'];
            //$house->acreage=$data['acreage'];
            $house->house_acreage=$data['house_acreage'];
            $house->land_acreage=$data['land_acreage'];
            $house->price1=$data['price1'];
            $house->price2=$data['price2'];
            $house->give_date=$data['give_date'];


            $house->car=$data['car'];
            $house->email=$data['email'];
            $house->weixin=$data['weixin'];
            $house->layout=$data['count1'].'房,'.$data['count2'].'厅,'.$data['count3'].'厨,'.$data['count4'].'卫';
            $house->high="第".$data['num']."层,共".$data['all']."层";
            $house->orientation=$data['orientation'];
            //$house->decorate=$data['decorate'];
            if(isset($data['assort'])){
              $house->assort=implode(",",$data['assort']);
            }
            $house->info=$data['info'];
            $house->contact=$data['contact'];
            $house->phone=$data['phone'];
            $house->type=$data['type'];
            $house->hot_area=$data['hot_area'];
            //$house->price_period=$data['price_period'];
            $house->layout_diff=$data['layout_diff'];
            $house->theme=$data['theme'];
            $house->sn=uniqid().rand(1000000, 9999999);
            if($house->save()){
              $config=ConfigModel::where('id',1)->find();
              $email=new EmailService();
              $type="楼花王-发布房源";
              $receiver=$data['email'];
              $title=$data['title'];
              $link=Config::get('host')."/index/buyroom/maimaifabu_edit?sn=".$house->sn;
              //$content="<a href='".Config::get('host')."/index/buyroom/maimaifabu_edit?sn=".$house->sn."'>点击对您提交的房源进行修改</a>";
              $content=$config->content."<br/><a href='".Config::get('host')."/index/buyroom/maimaifabu_edit?sn=".$house->sn."'>点击对您提交的房源进行修改</a>";
              $email->sendEmail($type,$receiver,$title,$content);
            }



            $files=request()->file('img');
            $second_id=$house->id;
            if(!empty($files)){
              $id=0;
              foreach($files as $file){
                  $file=$file->getInfo();
                  $name=explode(".",$file['name']);
                  $count=count($name);
                  $ext=$name[$count-1];
                  $path=PUBLIC_PATH."/custom/".$second_id."/";
                  if (! file_exists($path)) {
                      mkdir($path,0777,true);
                  }
                  $name=$path.time().$id.".".$ext;
                  move_uploaded_file($file["tmp_name"],$name);
                  $img[]=[
                      'second_id'=>$second_id,
                      'path'=>"/custom/".$second_id."/".time().$id.".".$ext,
                      'create_time'=>date("Y-m-d H:i:s",time()),
                      'update_time'=>date("Y-m-d H:i:s",time())
                  ];
                  $id++;
              }
              $res=CustomImgModel::insertAll($img);
            }
              $this->success("提交成功，等待后台审核",'Buyroom/maimaifabu');
        }
        $hothouse=SecondHandHouseModel::where('type',SecondHandHouseModel::$types['sale']['val'])->order('read_count','desc')->select();
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->select();
        $buy_up=AdModel::where('position','buy_up')->find();
        $buy_down=AdModel::where('position','buy_down')->find();
        $this->assign('hothouse',$hothouse);
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('layout',$layout);
        $this->assign('theme',$theme);
        $this->assign('buy_up',$buy_up);
        $this->assign('buy_down',$buy_down);
        return $this->fetch();
    }

    public function maimaifabu_edit()
    {
        if($_POST){
            $data=request()->post();

            $house=SecondHandHouseModel::where('id',$data['id'])->find();
            $house->title=$data['title'];
            //$house->area=$data['city'].','.$data['region'];
            $house->address=$data['address'];
            //$house->acreage=$data['acreage'];
            $house->house_acreage=$data['house_acreage'];
            $house->land_acreage=$data['land_acreage'];
            $house->price1=$data['price1'];
            $house->price2=$data['price2'];
            $house->give_date=$data['give_date'];
            $house->car=$data['car'];
            $house->email=$data['email'];
            $house->weixin=$data['weixin'];
            $house->layout=$data['count1'].','.$data['count2'].','.$data['count3'].','.$data['count4'];
            $house->high=$data['high'];
            $house->orientation=$data['orientation'];
            //$house->decorate=$data['decorate'];
            if(isset($data['assort'])){
              $house->assort=implode(",",$data['assort']);
            }
            $house->info=$data['info'];
            $house->contact=$data['contact'];
            $house->phone=$data['phone'];
            $house->type=$data['type'];
            $house->type=$data['type'];
            $house->hot_area=$data['hot_area'];
            //$house->price_period=$data['price_period'];
            $house->layout_diff=$data['layout_diff'];
            $house->theme=$data['theme'];
            $house->save();


            $files=request()->file('img');
            $second_id=$house->id;
            if(!empty($files)){
              $id=0;
              foreach($files as $file){
                  $file=$file->getInfo();
                  $name=explode(".",$file['name']);
                  $count=count($name);
                  $ext=$name[$count-1];
                  $path=PUBLIC_PATH."/custom/".$second_id."/";
                  if (! file_exists($path)) {
                      mkdir($path,0777,true);
                  }
                  $name=$path.time().$id.".".$ext;
                  move_uploaded_file($file["tmp_name"],$name);
                  $img[]=[
                      'second_id'=>$second_id,
                      'path'=>"/custom/".$second_id."/".time().$id.".".$ext,
                      'create_time'=>date("Y-m-d H:i:s",time()),
                      'update_time'=>date("Y-m-d H:i:s",time())
                  ];
                  $id++;
              }
              $res=CustomImgModel::insertAll($img);
            }
              $this->success("提交成功，等待后台审核",'Buyroom/maimaifabu');
        }
        $sn=$_GET['sn'];
        $list=SecondHandHouseModel::where('sn',$sn)->find();
        if(!$list){
             $this->error('不要调皮=_=');
        }
        $hothouse=SecondHandHouseModel::where('type',SecondHandHouseModel::$types['sale']['val'])->order('read_count','desc')->select();
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->select();
        $buy_up=AdModel::where('position','buy_up')->find();
        $buy_down=AdModel::where('position','buy_down')->find();
        $this->assign('hothouse',$hothouse);
        $this->assign('area',$area);
        $this->assign('list',$list);
        $this->assign('price',$price);
        $this->assign('layout',$layout);
        $this->assign('theme',$theme);
        $this->assign('buy_up',$buy_up);
        $this->assign('buy_down',$buy_down);
        return $this->fetch();
    }

    public function maimai_detaile()
    {
        $id=$_GET['id'];
        $house=SecondHandHouseModel::where('type',SecondHandHouseModel::$types['sale']['val'])->find($id);
        if(!$house){
             $this->error('不要调皮=_=');
        }
        $imgs=CustomImgModel::where('second_id',$id)->select();
        $show=CustomImgModel::where('second_id',$id)->find();
        if(isset($_GET['img_id'])){
            $show=CustomImgModel::where('second_id',$id)->where('id',$_GET['img_id'])->find();
        }
        $house->read_count=$house->read_count+1;
        $house->save();

        $sale_up=AdModel::where('position','sale_up')->find();
        $sale_down=AdModel::where('position','sale_down')->find();
        $this->assign('sale_up',$sale_up);
        $this->assign('sale_down',$sale_down);
        $this->assign('show',$show);
        $this->assign('imgs',$imgs);
        $this->assign('house',$house);
        return $this->fetch();
    }



}
