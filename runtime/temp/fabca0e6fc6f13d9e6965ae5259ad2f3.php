<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:81:"/home/fan/workspace/lhw/public/../application/admin/view/editmanager/manager.html";i:1526956534;s:63:"/home/fan/workspace/lhw/application/admin/view/public/head.html";i:1527848518;s:65:"/home/fan/workspace/lhw/application/admin/view/public/header.html";i:1526950464;s:63:"/home/fan/workspace/lhw/application/admin/view/public/left.html";i:1547733712;s:63:"/home/fan/workspace/lhw/application/admin/view/public/foot.html";i:1526956534;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>管理中心 - 网站管理员 </title>
    <meta name="Copyright" content="Douco Design." />
    <link href="/static/admin/css/public.css" rel="stylesheet" type="text/css">
    <script type="text/javascript" src="/static/admin/js/jquery.min.js"></script>
    <script type="text/javascript" src="/static/admin/js/global.js"></script>
    <script type="text/javascript" src="/static/admin/js/wangEditor.min.js"></script>
	<script type="text/javascript" src="/static/index/js/date/laydate.js"></script>
	
	
    <script type="text/javascript" charset="utf-8" src="/static/admin/umeditor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/static/admin/umeditor/ueditor.all.min.js"></script>
    <script type="text/javascript" src="/static/admin/umeditor/lang/zh-cn/zh-cn.js"></script>
    <!--<style>
    /*分页样式*/  
    .pagination{text-align:center;margin-top:20px;margin-bottom: 20px;}  
    .pagination li{margin:0px 10px; border:1px solid #e6e6e6;padding: 3px 8px;display: inline-block;}  
    .pagination .active{background-color: #dd1a20;color: #fff;}  
    .pagination .disabled{color:#aaa;}  
</style>-->
</head>
<body>
<div id="dcWrap"> <div id="dcHead">
    <div id="head">
        <div class="logo"><a href="index.html"><!--<img src="images/dclogo.gif" alt="logo">-->
        </a></div>
        <div class="nav">
            <ul class="navRight">
                <li class="M noLeft"><a href="JavaScript:void(0);">您好,&nbsp;&nbsp;<?php echo \think\Request::instance()->session('uname'); ?></a>
                </li>
                <li class="noRight"><a href="<?php echo url('Index/loginout'); ?>">安全退出</a></li>
            </ul>
        </div>
    </div>
</div></div>
<div id="dcLeft"><div id="menu">
    <ul>
        <li><a href="<?php echo url('Editmanager/manager'); ?>"><i class="manager"></i><em>网站管理员</em></a></li>
        <!--
        <li><a href="nav.html"><i class="nav"></i><em>自定义导航栏</em></a></li>
        <li><a href="show.html"><i class="show"></i><em>首页幻灯广告</em></a></li>
        <li><a href="page.html"><i class="page"></i><em>单页面管理</em></a></li>
        -->
    </ul>

    <ul>
        <li><a href="<?php echo url('Strategy/index'); ?>"><i class="productCat"></i><em>看房攻略</em></a></li>
        <li><a href="<?php echo url('Asking/index'); ?>"><i class="productCat"></i><em>房产资讯</em></a></li>
    </ul>

    <ul>
        <li><a href="<?php echo url('Area/index'); ?>"><i class="productCat"></i><em>热门区域</em></a></li>
        <li><a href="<?php echo url('Price/index'); ?>"><i class="productCat"></i><em>价格区间/平尺</em></a></li>
        <li><a href="<?php echo url('Price2/index'); ?>"><i class="productCat"></i><em>价格区间/套</em></a></li>
        <li><a href="<?php echo url('Layout/index'); ?>"><i class="productCat"></i><em>户型划分</em></a></li>
        <li><a href="<?php echo url('Theme/index'); ?>"><i class="productCat"></i><em>特色主题</em></a></li>
        <li><a href="<?php echo url('State/index'); ?>"><i class="productCat"></i><em>楼盘状态</em></a></li>
    </ul>

    <ul>
        <li><a href="<?php echo url('Building/index'); ?>"><i class="productCat"></i><em>楼盘管理</em></a></li>
    </ul>
    <ul>
        <li><a href="<?php echo url('SecondHouse/index'); ?>"><i class="productCat"></i><em>房源审核</em></a></li>
    </ul>
    <ul>
        <li><a href="<?php echo url('Ad/index'); ?>"><i class="productCat"></i><em>广告管理</em></a></li>
    </ul>
    <ul>
        <li><a href="<?php echo url('System/contact_us'); ?>"><i class="productCat"></i><em>联系我们</em></a></li>
        <li><a href="<?php echo url('System/network_marketing'); ?>"><i class="productCat"></i><em>网络营销</em></a></li>
        <li><a href="<?php echo url('System/recruit'); ?>"><i class="productCat"></i><em>招聘信息</em></a></li>
        <li><a href="<?php echo url('System/service'); ?>"><i class="productCat"></i><em>服务声明</em></a></li>
    </ul>
    <ul>
        <li><a href="<?php echo url('Advice/index'); ?>"><i class="productCat"></i><em>意见反馈</em></a></li>
    </ul>
    <ul>
        <li><a href="<?php echo url('Config/index'); ?>"><i class="productCat"></i><em>底部配置</em></a></li>
    </ul>
</div></div>
<script type="text/javascript">

    function del() {
        var msg = "确定要删除么！";
        if (confirm(msg)==true){
            return true;
        }else{
            return false;
        }
    }
</script>
<div id="dcMain"><!-- 当前位置 -->
    <div id="urHere">管理中心<b>></b><strong>网站管理员</strong> </div>   <div id="manager" class="mainBox" style="height:auto!important;height:550px;min-height:550px;">
    <h3>
        <?php if(getAdminType()==0): ?>
        <a href="<?php echo url('Editmanager/addmanager'); ?>" class="actionBtn">添加管理员</a>
        <?php endif; ?>网站管理员
    </h3>
        <table width="100%" border="0" cellpadding="8" cellspacing="0" class="tableBasic">
     <tr>
         <th width="30" align="center">编号</th>
         <th align="center">管理员名称</th>
         <th align="center">添加时间</th>
         <th align="center">操作</th>
     </tr>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$user): $mod = ($i % 2 );++$i;?>
         <tr>

      <td align="center"><?php echo $user['id']; ?></td>
      <td align="center"><?php echo $user['username']; ?></td>
      <td align="center"><?php echo $user['create_time']; ?></td>
      <td align="center">
        <a href="<?php echo url('Editmanager/edit'); ?>?uid=<?php echo $user['id']; ?>">编辑</a> 
        <?php if($user['type']==1 && getAdminType()==0): ?>
        | <a href="<?php echo url('Editmanager/delete'); ?>?did=<?php echo $user['id']; ?>" onclick="javascript:return del()">删除</a>
        <?php endif; ?>
        </td>
         </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
         </table>
                       </div>
 </div>
<div class="clear"></div>
<div id="dcFooter">
    <div id="footer">
        <div class="line"></div>
        <ul>
            楼花王为您提供最新的楼盘信息，全面及时的新盘展示
            版权所有 ©2015  楼花王版权所有  琼ICP备0000000000号。
        </ul>
    </div>
</div><!-- dcFooter 结束 -->
<div class="clear"></div> </div>
</body>
</html>