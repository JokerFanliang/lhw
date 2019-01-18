<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:86:"/home/fan/workspace/lhw/public/../application/index/view/hotroombed/repanxianfang.html";i:1547734262;s:63:"/home/fan/workspace/lhw/application/index/view/public/head.html";i:1547188996;s:63:"/home/fan/workspace/lhw/application/index/view/public/foot.html";i:1544091112;}*/ ?>
<!DOCTYPE html>
<html>

	<head lang="zh-cn">
		<meta charset="UTF-8">
		<title></title>
		<link rel="stylesheet" href="/static/index/css/rescss.css" />
		<link rel="stylesheet" href="/static/index/css/louhuayushou.css" />
		<style>
			/*#rightUp:first-child :first-child a{*/
			/*color: #F7743C;*/
			/*}*/
			
			.newsBox:first-child a span {
				color: #F7743C;
			}
			
			.newsBox:first-child {
				border-bottom: 1px dotted #ddd;
				padding-bottom: 5px;
			}
			#radioBox label{
				background:#F7F7F7;
				color:#000;
			}
			#radioBox label.active{
				background:#CC0000;
				color:#fff;
			}
		</style>
	</head>

	<body>
		<div id="header">
			<!-- 头部公用 -->
			<style type="text/css">
      #bannerBox {
        width: 890px;
        height: 100px;
        overflow: hidden;
        position: relative;
      }
      
      .bannerImg {
        width: 890px;
        height: 100px;
      }
      
      .slideBox {
        height: 100px;
      }
      
      .slide {
        width: 890px;
        height: 100px;
        display: inline-block;
        position: absolute;
        top: 0;
        left: 0;
        opacity: 0;
      }
      
      .slide.active {
        opacity: 1;
      }
    </style>
<div id="top" class="clear">
    <div id="logoBox" class="left">
        <a href="<?php echo url('Index/index'); ?>">            
            <img src="/static/index/image/logo_03.png" alt="楼花王LOGO"/>
        </a>
    </div>
    <?php $path=getHeadPath();?>
    <div id="bannerBox" class="right">
          <div class="slideBox">
            <?php if(is_array($path) || $path instanceof \think\Collection || $path instanceof \think\Paginator): $i = 0; $__LIST__ = $path;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$pa): $mod = ($i % 2 );++$i;?>
            <a class="slide active" target="_blank" href="<?php echo $pa['url']; ?>">
              <img class="bannerImg" src="/static/<?php echo $pa['path']; ?>" alt="" height="79px;" width="890px;" />
            </a>
            <?php endforeach; endif; else: echo "" ;endif; ?>

          </div>

        </div>
</div>
<div id="nav">
    <div id="navBox" class="clear">
        <a href="<?php echo url('Index/index'); ?>" class="navA <?php if(getTitleSession()=='shouye') echo 'active'?>">首页</a>
        <a href="<?php echo url('Advancesale/louhuayushou'); ?>" class="navA <?php if(getTitleSession()=='yushou') echo 'active'?>">楼花预售</a>
        <a href="<?php echo url('Hotroombed/repanxianfang'); ?>" class="navA <?php if(getTitleSession()=='xianfang') echo 'active'?>">热盘现房</a>
        
        <a href="<?php echo url('Lookroom/kanfanggonglue'); ?>" class="navA <?php if(getTitleSession()=='strategy') echo 'active'?>">看房攻略</a>
        <a href="<?php echo url('Buyroom/dichanmaimai'); ?>" class="navA <?php if(getTitleSession()=='sale') echo 'active'?>">楼花买卖</a>
        <a href="<?php echo url('Sellroom/chuzuqiuzu'); ?>" class="navA <?php if(getTitleSession()=='lease') echo 'active'?>">商业地产</a>
        <a href="<?php echo url('Videoroom/shipinkanfang'); ?>" class="navA <?php if(getTitleSession()=='video') echo 'active'?>">视频看房</a>
    </div>
</div>
<script src="/static/index/js/jquery-1.11.3.js"></script>
<script type="text/javascript" src="/static/index/js/wangEditor.min.js"></script>
<script type="text/javascript" src="/static/index/js/date/laydate.js"></script>

<script type="text/javascript">
    $(function(){
    //轮播图方法
        var slideNum = 1;
        var slideLength = $('.slideBox a').length;
//        定时器方法
        var slideFun=function() {
          $('.slideBox .slide').eq(slideNum).animate({
            'opacity':'1',
            'z-index':'1'
          },2000);
          $('.slideBox .slide').eq(slideNum).siblings().animate({
            'opacity':'0',
            'z-index':'0'
          },2000);
          slideNum++;
          console.log(slideNum);
          if(slideNum >= slideLength) {
            slideNum = 0;
          }
        }
//        执行 轮播图定时器
        var slideTime = setInterval(slideFun, 5000);
//        移入轮播图 停止定时器
        $('.slideBox').mouseenter(function() {
          clearInterval(slideTime);
        });
//        移出轮播图 重启定时器
        $('.slideBox').mouseleave(function() {
          slideTime = setInterval(slideFun, 5000);
        })

      });

</script>
		</div>
		<form action="<?php echo url('Hotroombed/repanxianfang'); ?>" method="get" id="form">
			<input type="hidden" class="area_form" name="area" value="<?php echo $data['area']; ?>">
			<input type="hidden" class="price_form" name="price" value="<?php echo $data['price']; ?>">
			<input type="hidden" class="layout_form" name="layout" value="<?php echo $data['layout']; ?>">
			<input type="hidden" class="theme_form" name="theme" value="<?php echo $data['theme']; ?>">
			<input type="hidden" class="state_form" name="state" value="<?php echo $data['state']; ?>">
		</form>
		<div id="main" class="clear">
			<div id="leftMain" class="left">
				<!-- 选择框 -->
				<div id="radioBox">
					<!--热门区域-->
					<div class="radioSunBox clear">
						<div class="fenlei left">热门区域：</div>
						<div class="fenleiDetailes">
						<label <?php if($data['area']=='0') {echo "class='active'";}?>>
	                        <input type="radio" name="area_form" value="0"/>
	                        不限
	                    </label>
	                    <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$area): $mod = ($i % 2 );++$i;?>
						<label <?php if($data['area']==$area->id) {echo "class='active'";}?>>
	                        <input type="radio" name="area_form" value="<?php echo $area['id']; ?>"/>
	                        <?php echo $area['name']; ?>
	                    </label>
	                    <?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>

					<!--户型划分-->
					<div class="radioSunBox clear">
						<div class="fenlei left">户型划分：</div>
						<div class="fenleiDetailes">						
						<label  <?php if($data['layout']=='0') {echo "class='active'";}?>>
                        	<input type="radio" name="layout_form" value="0"/>
                        不限
                    	</label>                  	
                    	<?php if(is_array($layout) || $layout instanceof \think\Collection || $layout instanceof \think\Paginator): $i = 0; $__LIST__ = $layout;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$layout): $mod = ($i % 2 );++$i;?>
                    	<label <?php if($data['layout']==$layout->id) {echo "class='active'";}?>>
                        	<input type="radio" name="layout_form" value="<?php echo $layout['id']; ?>"/>
                        	<?php echo $layout['name']; ?>
                    	</label>
						<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<!--特色主题-->
					<div class="radioSunBox clear">
						<div class="fenlei left">特色主题：</div>
						<div class="fenleiDetailes">

						<label  <?php if($data['theme']=='0') {echo "class='active'";}?>>
                        	<input type="radio" name="theme_form" value="0"/>
                        不限
                    	</label>
						<?php if(is_array($theme) || $theme instanceof \think\Collection || $theme instanceof \think\Paginator): $i = 0; $__LIST__ = $theme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$theme): $mod = ($i % 2 );++$i;?>
						<label <?php if($data['theme']==$theme->id) {echo "class='active'";}?>>
                        	<input type="radio" name="theme_form" value="<?php echo $theme['id']; ?>"/>
                        	<?php echo $theme['name']; ?>
                    	</label>
                    	<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<!--楼盘状态-->
					<div class="radioSunBox clear">
						<div class="fenlei left">楼盘状态：</div>
						<div class="fenleiDetailes">

						<label  <?php if($data['state']=='0') {echo "class='active'";}?>>
                        	<input type="radio" name="state_form" value="0"/>
                        不限
                    	</label>
						<?php if(is_array($state) || $state instanceof \think\Collection || $state instanceof \think\Paginator): $i = 0; $__LIST__ = $state;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$state): $mod = ($i % 2 );++$i;?>
						<label <?php if($data['state']==$state->id) {echo "class='active'";}?>>
                        	<input type="radio" name="state_form" value="<?php echo $state['id']; ?>"/>
                        	<?php echo $state['name']; ?>
                    	</label>
                    	<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
					<!--价格区间-->
					<div class="radioSunBox clear">
						<div class="fenlei left">价格区间：</div>
						<div class="fenleiDetailes ">
						<label  <?php if($data['price']=='0') {echo "class='active'";}?>>
                        <input type="radio" name="price_form" value="0"/>
                        不限
                    	</label>
                    	<?php if(is_array($price) || $price instanceof \think\Collection || $price instanceof \think\Paginator): $i = 0; $__LIST__ = $price;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$price): $mod = ($i % 2 );++$i;?>
						<label <?php if($data['price']==$price->id) {echo "class='active'";}?>>
                        	<input type="radio" name="price_form" value="<?php echo $price['id']; ?>"/>
                        	<?php echo $price['min']; ?>--<?php echo $price['max']; ?>
                    	</label>
                    	<?php endforeach; endif; else: echo "" ;endif; ?>
						</div>
					</div>
				</div>
				<form action="<?php echo url('Hotroombed/repanxianfang'); ?>" method="get" id="search">
					<div id="serchBox" class="clear">
						<input type="text" id="serchText" name="searchname" class="left searchname" />

						<div id="serchBtn" class="left">
							<b id="serchIcon"></b> 搜索
						</div>
						<div id="goGoogleBox" class="right">
							<b id="goGoogleIcon"></b>
							<a href="https://www.google.com/maps" target="_block" id="goGoogle">地图找房</a>
						</div>
					</div>
				</form>
				<div id="dateils" class="clear">
					<!--图片展示 循环区域-->
					<?php if(is_array($build) || $build instanceof \think\Collection || $build instanceof \think\Paginator): $i = 0; $__LIST__ = $build;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bu): $mod = ($i % 2 );++$i;?>
					<div class="deteilsBox left">
						<a href="<?php echo url('Hotroombed/repanxianfang_detaile'); ?>?id=<?php echo $bu['id']; ?>">
							<div class="deteileImgBox">
								<img style="width:286px;height:191px" src="<?php echo $imgs[$bu['id']]; ?>" alt="" />
							</div>
						

						<p class="yushouName"><?php echo $bu['name']; ?></p>
						<p class="yushouMsg"><?php echo $bu['address']; ?></p>
						</a>
					</div>
					<?php endforeach; endif; else: echo "" ;endif; ?>

					<div id="fenye" class="clear">
						<?php echo $build->render(); ?>
					</div>

<!-- 					<div id="fenye" class="clear">
						<div id="fenyeBox" class="clear">
							<div class="fenyeDetails left">
								<span>每页显示：15条 共</span>
								<span class="page">25</span>
								<span>页 当前第</span>
								<span class="yeNum">1</span>
								<span>页，共</span>
								<span class="allNum">500</span>
								<span>条记录</span>
							</div>
							<div class="fenyeBtnBox left">
								<span>第</span>
								<input type="number" value="1" id="zixuan" />
								<span>页</span>
							</div>
							<div class="fenyeBtnBox left">
								<a href="javascript:;">首页</a>
							</div>
							<div class="fenyeBtnBox left">
								<a href="javascript:;">上页</a>
							</div>
							<div class="fenyeBtnBox left">
								<a href="javascript:;">下页</a>
							</div>
							<div class="fenyeBtnBox left">
								<a href="javascript:;">尾页</a>
							</div>
						</div>
					</div> -->
				</div>

			</div>
			<div id="rightMain" class="left">
				<div id="rightUp">
					<div class="newHot">
						<b id="hotIcon"></b> 热点新盘
					</div>
					<div id="newDetaile">
						<?php if(is_array($hotbuild) || $hotbuild instanceof \think\Collection || $hotbuild instanceof \think\Paginator): $i = 0; $__LIST__ = $hotbuild;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$hot): $mod = ($i % 2 );++$i;?>
						<div class="newsBox">
							<a href="<?php echo url('Hotroombed/repanxianfang_detaile'); ?>?id=<?php echo $hot['id']; ?>" class="clear">
							<div class="clear">
								<span class="newTle shenglue left"><?php echo $hot->name; ?></span>
								<?php $area=explode(",",$hot->area);?>
								<span class="newDizhi right"><?php echo $area[0]; ?></span>
							</div>
							<p class="price"><?php echo $hot->price; ?></p>
							</a>
						</div>
						<?php endforeach; endif; else: echo "" ;endif; ?>


					</div>
				</div>
				<div id="rightMid">
					<a href="<?php echo $xianfang_up['url']; ?>" target="_block">
						<img src="/static/<?php echo $xianfang_up['path']; ?>" width="270" height="380" alt="" />
					</a>
				</div>
				<div id="rightDown">
					<!-- <img src="/static/index/image/guanggaoTel-1.jpg" alt="" /> -->
					<a href="<?php echo $xianfang_down['url']; ?>" target="_block">
						<img src="/static/<?php echo $xianfang_down['path']; ?>" width="270" height="142" alt="" />
					</a>
				</div>
			</div>
		</div>

		<div id="foot">
			<?php
    $config=getConfig();
?>
<div id="footBox">
    <div id="footNav" class="clear">
        <a href="<?php echo url('Contactus/callme'); ?>" class="footA">联系我们</a><span class="footSpan">|</span>
        <a href="<?php echo url('Contactus/network'); ?>" class="footA">网络运营</a><span class="footSpan">|</span>
        <a href="<?php echo url('Contactus/information'); ?>" class="footA">招聘信息</a><span class="footSpan">|</span>
        <a href="<?php echo url('Contactus/suggestion'); ?>" class="footA">意见反馈</a><span class="footSpan">|</span>
        <a href="<?php echo url('Contactus/service'); ?>" class="footA">服务声明</a>
    </div>
    <div id="footMessage">
        <span>地址：<?php echo $config->address; ?>&nbsp;&nbsp;</span>
        <span>&nbsp;&nbsp;服务电话：<?php echo $config->phone; ?></span>

        <p><?php echo $config->info; ?></p>

        <p><?php echo $config->copy; ?></p>
    </div>
</div>
		</div>
		<script src="/static/index/js/jquery-1.11.3.js"></script>
		<script>
			$("#serchBtn").click(function(){
				var name=$.trim($(".searchname").val());
				if(name==""){
					alert("请输入查询条件");
					return false;
				}
				$("#search").submit();
			})
		</script>
		<script>
			$(function() {
				$('#radioBox').on('click', 'input', function() {
					var cla=$(this).attr('name');
					var val=$(this).val();
					$("."+cla).val(val);
					$("#form").submit();
				});

				/**
				 *
				 *      选择框 获取 value 功能  临时用的BUTTON
				 *
				 */
				$('button').click(function() {
					$.each($('#radioBox').find('input[type="radio"]'), function(i, e) {
						if($(e).is(':checked')) {
							alert($(e).val());
						}

					});
				});
			});
		</script>
	</body>

</html>