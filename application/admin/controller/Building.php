<?php
namespace app\admin\controller;
use think\Controller;
use think\Db;
use app\model\BuildingModel;
use app\model\BuildingDynamicModel;
use app\model\AreaModel;
use app\model\PriceModel;
use app\model\Price2Model;
use app\model\LayoutModel;
use app\model\ThemeModel;
use app\model\StateModel;
use app\model\HouseTypeModel;
use app\model\HouseShowModel;
use app\model\VideoModel;
use app\model\BuildLayoutModel;
use app\model\BuildStateModel;
use app\model\BuildThemeModel;
use app\model\BuildPriceModel;
use app\model\BuildPrice2Model;
use think\Request;

class Building extends common
{
    public function index()
    {
        $data=[
            'name'=>isset($_GET['name']) ? $_GET['name'] : ""
        ];
        $lists=BuildingModel::where(function($query)use($data){
            if($data['name']){
                $query->where('name','like','%'.$data['name'].'%');
            }
        })->order('create_time','desc')->where('is_delete',BuildingModel::$isDelete['no']['val'])->paginate(10,false,['query' => request()->param()]);
        $this->assign('lists',$lists);
        return $this->fetch();
    }

    public function add()
    {        
        if($_POST){
            $data=request()->post();
            $building=new BuildingModel();
            $building->name=$data['name'];
            $building->price=$data['price'];
            $building->area_id=$data['area_id'];
            $building->price_id=$data['price_id'];
            $building->theme_id=$data['theme_id'];
            $building->area=$data['city'].",".$data['period'];
            $building->type=$data['type'];
            $building->address=$data['address'];
            $building->finish_at=$data['finish_at'];
            $building->telephone=$data['telephone'];
            $building->state=$data['state'];
			$building->is_hot=$data['is_hot'];
            if($building->save()){
                if(!empty($data['layout_id'])){
                    foreach($data['layout_id'] as $layout_id){
                        $bl=new BuildLayoutModel();
                        $bl->build_id=$building->id;
                        $bl->layout_id=$layout_id;
                        $bl->save();
                    }
                }
                if(!empty($data['theme_id'])){
                    foreach($data['theme_id'] as $theme_id){
                        $bl=new BuildThemeModel();
                        $bl->build_id=$building->id;
                        $bl->theme_id=$theme_id;
                        $bl->save();
                    }
                }
                if(!empty($data['price_id'])){
                    foreach($data['price_id'] as $price_id){
                        $bl=new BuildPriceModel();
                        $bl->build_id=$building->id;
                        $bl->price_id=$price_id;
                        $bl->save();
                    }
                }
                if(!empty($data['state_id'])){
                    foreach($data['state_id'] as $state_id){
                        $bl=new BuildStateModel();
                        $bl->build_id=$building->id;
                        $bl->state_id=$state_id;
                        $bl->save();
                    }
                }
                if(!empty($data['price2_id'])){
                    foreach($data['price2_id'] as $price2_id){
                        $bl=new BuildPrice2Model();
                        $bl->build_id=$building->id;
                        $bl->price_id=$price2_id;
                        $bl->save();
                    }
                }
                $this->redirect('Building/index');
            }else{
                $this->error('添加失败!');
            }
        }
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->select();
        $state=StateModel::where('is_delete',StateModel::$isDelete['no']['val'])->select();
        $price2=Price2Model::where('is_delete',Price2Model::$isDelete['no']['val'])->select();
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('price2',$price2);
        $this->assign('layout',$layout);
        $this->assign('theme',$theme);
        $this->assign('state',$state);
        return $this->fetch();
    }

    public function edit()
    {
        if($_POST){
            $data=request()->post();
            $building=BuildingModel::find($data['id']);
            $building->name=$data['name'];
            $building->price=$data['price'];
            $building->area_id=$data['area_id'];
            $building->price_id=$data['price_id'];
            
            $building->theme_id=$data['theme_id'];
            $building->type=$data['type'];
            $building->area=$data['city'].",".$data['period'];
            $building->address=$data['address'];
            $building->finish_at=$data['finish_at'];
            $building->telephone=$data['telephone'];
            $building->state=$data['state'];
			$building->is_hot=$data['is_hot'];
            if($building->save()){
                BuildLayoutModel::where('build_id',$building->id)->delete();
                if(!empty($data['layout_id'])){
                    foreach($data['layout_id'] as $layout_id){
                        $bl=new BuildLayoutModel();
                        $bl->build_id=$building->id;
                        $bl->layout_id=$layout_id;
                        $bl->save();
                    }
                }
                BuildPriceModel::where('build_id',$building->id)->delete();
                if(!empty($data['price_id'])){
                    foreach($data['price_id'] as $price_id){
                        $bl=new BuildPriceModel();
                        $bl->build_id=$building->id;
                        $bl->price_id=$price_id;
                        $bl->save();
                    }
                }
                BuildPrice2Model::where('build_id',$building->id)->delete();
                if(!empty($data['price2_id'])){
                    foreach($data['price2_id'] as $price2_id){
                        $bl=new BuildPrice2Model();
                        $bl->build_id=$building->id;
                        $bl->price_id=$price2_id;
                        $bl->save();
                    }
                }
                BuildThemeModel::where('build_id',$building->id)->delete();
                if(!empty($data['theme_id'])){
                    foreach($data['theme_id'] as $theme_id){
                        $bl=new BuildThemeModel();
                        $bl->build_id=$building->id;
                        $bl->theme_id=$theme_id;
                        $bl->save();
                    }
                }
                BuildStateModel::where('build_id',$building->id)->delete();
                if(!empty($data['state_id'])){
                    foreach($data['state_id'] as $state_id){
                        $bl=new BuildStateModel();
                        $bl->build_id=$building->id;
                        $bl->state_id=$state_id;
                        $bl->save();
                    }
                }
                $this->redirect('Building/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=BuildingModel::where('id',$id)->find();
        $area=AreaModel::where('is_delete',AreaModel::$isDelete['no']['val'])->select();
        $price=PriceModel::where('is_delete',PriceModel::$isDelete['no']['val'])->select();
        $price2=Price2Model::where('is_delete',Price2Model::$isDelete['no']['val'])->select();
        $layout=LayoutModel::where('is_delete',LayoutModel::$isDelete['no']['val'])->select();
        $theme=ThemeModel::where('is_delete',ThemeModel::$isDelete['no']['val'])->select();
        $state=StateModel::where('is_delete',StateModel::$isDelete['no']['val'])->select();
        $layout_ids=BuildLayoutModel::where('build_id',$id)->column('layout_id');
        $theme_ids=BuildThemeModel::where('build_id',$id)->column('theme_id');
        $price_ids=BuildPriceModel::where('build_id',$id)->column('price_id');
        $price2_ids=BuildPrice2Model::where('build_id',$id)->column('price_id');
        $state_ids=BuildStateModel::where('build_id',$id)->column('state_id');
        $this->assign('area',$area);
        $this->assign('price',$price);
        $this->assign('price2',$price2);
        $this->assign('layout',$layout);
        $this->assign('state',$state);
        $this->assign('layout_ids',$layout_ids);
        $this->assign('theme_ids',$theme_ids);
        $this->assign('price_ids',$price_ids);
        $this->assign('price2_ids',$price2_ids);
        $this->assign('state_ids',$state_ids);
        $this->assign('theme',$theme);
        $this->assign('list',$list); 
        return $this->fetch();
    }

    public function edit_detail()
    {
        if($_POST){
            $data=request()->post();
            $building=BuildingModel::find($data['id']);
            $building->sale_address=$data['sale_address'];
            $building->ownership=$data['ownership'];
            $building->purpose=$data['purpose'];
            $building->high=$data['high'];
            $building->build_state=$data['build_state'];
            $building->facilities=$data['facilities'];
            $building->developer=$data['developer'];
            $building->web=$data['web'];
            $building->designer=$data['designer'];
            $building->architect=$data['architect'];
            $building->sale_company=$data['sale_company'];
            $building->operator=$data['operator'];
            if($building->save()){
                $this->redirect('Building/index');
            }else{
                $this->error('修改失败!');
            }

        }
        $id=$_GET['id'];
        $list=BuildingModel::where('id',$id)->find();
        $this->assign('list',$list); 
        return $this->fetch();
    }

    public function delete()
    {
        $id=$_GET['id'];
        $building=BuildingModel::where('id',$id)->find();
        $building->is_delete=BuildingModel::$isDelete['yes']['val'];
        if($building->save()){
            $this->redirect('Building/index');
        }else{
            $this->error('删除失败!');
        }
    }


    public function dynamic()
    {
        $id=$_GET['id'];
        $lists=BuildingDynamicModel::where('building_id',$id)->order('create_time','desc')->paginate(10);
        $build=BuildingModel::find($id);
		$this->assign('build',$build);
		$this->assign('building_id',$id);
        $this->assign('lists',$lists); 
        return $this->fetch();
    }

    public function dynamic_add()
    {
        if($_POST){
            $data=request()->post();
            $dynamic=new BuildingDynamicModel();
            $dynamic->title=$data['title'];
			$dynamic->summary=$data['summary'];
            $dynamic->content=$data['content'];
            $dynamic->building_id=$data['building_id'];

            if($dynamic->save()){
                $url='/admin/building/dynamic?id='.$data['building_id'];
				$this->success("添加成功",$url);
            }else{
                $this->error('添加失败!');
            }
        }
        $building_id=$_GET['id'];
        $this->assign('building_id',$building_id);
        return $this->fetch();
    }

    public function dynamic_edit()
    {
        if($_POST){
            $data=request()->post();
            $dynamic=BuildingDynamicModel::find($data['id']);
            $dynamic->title=$data['title'];
			$dynamic->summary=$data['summary'];
            $dynamic->content=$data['content'];
            if($dynamic->save()){
                $url='/admin/building/dynamic?id='.$data['building_id'];
				$this->success("修改成功",$url);
            }else{
               $this->error('修改失败!'); 
            }
        }
        $id=$_GET['id'];
        $dynamic=BuildingDynamicModel::find($id);
        $this->assign('dynamic',$dynamic);
        return $this->fetch();
    }

    public function dynamic_delete()
    {
        $building_id=$_GET['building_id'];
        $id=$_GET['id'];
        $dynamic=BuildingDynamicModel::find($id);
        if($dynamic->delete()){
            $url='/admin/building/dynamic?id='.$building_id;
			$this->success('删除成功',$url);
        }else{
            $this->error('删除失败!');
        }
        return $this->fetch();
    }
    public function house_type()
    {
        $id=$_GET['id'];
        $houseType=HouseTypeModel::order('sort','desc')->where('building_id',$id)->paginate(5,false,['query'=>['id'=>$id]]);
        $build=BuildingModel::find($id);
		$this->assign('houseType',$houseType);
        $this->assign('houseid',$id);
		$this->assign('build',$build);

        return $this->fetch();
    }
    //这是新增户型的方法
    public function houseadd()
    {
        if($_POST){
           $id=$_POST['id'];
            //print_r($data);die;
            $houseType=new HouseTypeModel();
            $data=request()->post();
            $image=request()->file('image');
            $houseType->building_id=$id;
            $houseType->type=$data['hname'];
            $houseType->acreage=$data['hmianji'];
            $houseType->state=$data['hstatus'];
            $houseType->sort=$data['sort'];

            if (empty($image)) {
                $this->error('请选择要上传的图片!');
                exit;
            }
            $info=$image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
            //var_dump($info['filename']);die;
            if($info){
                $filePathss = '/uploads'.'/'.$info->getSaveName();
                $filePath= str_replace('\\', '/', $filePathss);
            }

            $houseType->photo=$filePath;
            if($houseType->save())
            {
                $url='/admin/building/house_type?id='.$id;
				$this->success('添加成功!',$url);
            }else
            {
                $this->error('添加失败!');
            }


        }
        $id=$_GET['id'];
        $this->assign('houseid',$id);

        return $this->fetch();
    }

    public function house_edit()
    {
        if($_POST){
            $data=request()->post();
            $image=request()->file('image');
            $house=HouseTypeModel::find($data['id']);
            $house->type=$data['type'];
            $house->state=$data['state'];
            $house->acreage=$data['acreage'];
            $house->sort=$data['sort'];
            if($image){
                $info=$image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                    $house->photo=$filePath;
                }


            }

            
            if($house->save()){
                $url='/admin/building/house_type?id='.$data['building_id'];
				$this->success("修改成功",$url);
            }else{
               $this->error('修改失败!'); 
            }
        }
        $id=$_GET['id'];
        $house=HouseTypeModel::find($id);
        $this->assign('house',$house);
        return $this->fetch();
    }

    public function housetype_delete()
    {
        $building_id=$_GET['building_id'];
        $id=$_GET['id'];
        $house=HouseTypeModel::find($id);
        if($house->delete()){
            $url='/admin/building/house_type?id='.$building_id;
            $this->success('删除成功',$url);
        }else{
            $this->error('删除失败!');
        }
        return $this->fetch();
    }

    public function video(){
        $id=$_GET['id'];
        $video=VideoModel::where('building_id',$id)->order('sort','desc')->paginate(10,false,['query'=>['id'=>$id]]);
        $this->assign('video',$video);
        $this->assign('houseid',$id);
        return $this->fetch();
    }

    public function video_add()
    {
        if($_POST){
           $id=$_POST['id'];
            //print_r($data);die;
            $video=new VideoModel();
            $data=request()->post();
 //           $file=request()->file('video')->getInfo();
 //           $name=explode(".",$file['name']);
 //           $count=count($name);
 //           $ext=$name[$count-1];
 //           $name=PUBLIC_PATH."/video/".time().".".$ext;
 //           move_uploaded_file($file["tmp_name"],$name);
 //           $video->path="/static/video/".time().".".$ext;
            $video->building_id=$id;
            $video->sort=$data['sort'];
			$video->path=$data['path'];
            if($video->save())
            {
                $url='/admin/building/video?id='.$id;
                $this->success("添加成功",$url);
            }else
            {
                $this->error('添加失败!');
            }


        }
        $id=$_GET['id'];
        $this->assign('houseid',$id);

        return $this->fetch();
    }

    public function video_edit()
    {
        if($_POST){
            $data=request()->post();
			$video=VideoModel::find($data['id']);
//            $file=request()->file('video')->getInfo();
//            $name=explode(".",$file['name']);
//            $count=count($name);
//            $ext=$name[$count-1];
//            $name=PUBLIC_PATH."/video/".time().".".$ext;
//            move_uploaded_file($file["tmp_name"],$name);
//            $video->path="/static/video/".time().".".$ext;
			$video->path=$data['path'];
            $video->sort=$data['sort'];
            if($video->save()){
                $url='/admin/building/video?id='.$data['building_id'];
                $this->success("修改成功",$url);
            }else{
               $this->error('修改失败!'); 
            }
        }
        $id=$_GET['id'];
        $video=VideoModel::find($id);
        $this->assign('video',$video);
        return $this->fetch();
    }




    public function video_delete()
    {
        $building_id=$_GET['building_id'];
        $id=$_GET['id'];
        $video=VideoModel::find($id);
        if($video->delete()){
            $url='/admin/building/video?id='.$building_id;
            $this->success('删除成功',$url);
        }else{
            $this->error('删除失败!');
        }
        return $this->fetch();
    }
	
	
	public function house_show()
    {
        $id=$_GET['id'];
        $houseShow=HouseShowModel::order('sort','desc')->where('building_id',$id)->paginate(5,false,['query'=>['id'=>$id]]);
        $this->assign('houseShow',$houseShow);
        $this->assign('houseid',$id);

        return $this->fetch();
    }

    public function show_add()
    {
        if($_POST){
           $id=$_POST['id'];
            //print_r($data);die;
            $houseShow=new HouseShowModel();
            $data=request()->post();
            $image=request()->file('image');
            $houseShow->building_id=$id;
            $houseShow->sort=$data['sort'];

            if (empty($image)) {
                $this->error('请选择要上传的图片!');
                exit;
            }
            $info=$image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
            //var_dump($info['filename']);die;
            if($info){
                $filePathss = '/uploads'.'/'.$info->getSaveName();
                $filePath= str_replace('\\', '/', $filePathss);
            }

            $houseShow->photo=$filePath;
            if($houseShow->save())
            {
                $url='/admin/building/house_show?id='.$id;
				$this->success('添加成功!',$url);
            }else
            {
                $this->error('添加失败!');
            }


        }
        $id=$_GET['id'];
        $this->assign('houseid',$id);

        return $this->fetch();
    }

    public function show_edit()
    {
        if($_POST){
            $data=request()->post();
            $image=request()->file('image');
            $house=HouseShowModel::find($data['id']);
            if($image){
                $info=$image->validate(['size'=>2097152,'ext'=>'jpg,png,gif'])->move(ROOT_PATH.'public'.DS.'uploads');
                if($info){
                    $filePathss = '/uploads'.'/'.$info->getSaveName();
                    $filePath= str_replace('\\', '/', $filePathss);
                }

                $house->photo=$filePath;
            }

            $house->sort=$data['sort'];
            if($house->save()){
                $url='/admin/building/house_show?id='.$data['building_id'];
				$this->success("修改成功",$url);
            }else{
               $this->error('修改失败!'); 
            }
        }
        $id=$_GET['id'];
        $house=HouseShowModel::find($id);
        $this->assign('house',$house);
        return $this->fetch();
    }

    public function show_delete()
    {
        $building_id=$_GET['building_id'];
        $id=$_GET['id'];
        $house=HouseShowModel::find($id);
        if($house->delete()){
            $url='/admin/building/house_show?id='.$building_id;
            $this->success('删除成功',$url);
        }else{
            $this->error('删除失败!');
        }
        return $this->fetch();
    }

}