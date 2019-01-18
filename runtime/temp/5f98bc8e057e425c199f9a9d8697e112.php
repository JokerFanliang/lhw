<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:73:"/home/fan/workspace/lhw/public/../application/index/view/index/index.html";i:1547196006;s:63:"/home/fan/workspace/lhw/application/index/view/public/head.html";i:1547188996;s:63:"/home/fan/workspace/lhw/application/index/view/public/foot.html";i:1544091112;}*/ ?>
<!DOCTYPE html>
<html>
<head lang="zh-cn">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/index/css/rescss.css"/>
    <link rel="stylesheet" href="/static/index/css/index.css"/>
    <style type="text/css">
        .newUp .newBox:first-child,.newDown .newBox:first-child{
            font-size: 18px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            color:#ee0000;
            text-align: center;
        }
        .newBox:first-child a,.newDown .newBox:first-child a{
            color:#ee0000;
            font-weight: bold;
        }
        .shenglue{
            color:#000;
        }

.newUp .newBox:first-child :not(:last-child),.newDown .newBox:first-child :not(:last-child){
    display: none;
}
    .footerPhoneBox{
        width: 25%;
        padding-left:120px;
    }
    .footerPhoneBox>img{
        display: block;
        height:100px;
        width:200px;
        border-radius: 10px;
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
    <!-- 头部公用 -->
</div>

<div id="main">
    <!-- 详情内容 -->
    <div class="longBannerBox">
        <!-- <img src="/static/index/image/banner-2.jpg" alt=""/> -->
        <a href="<?php echo $one_up['url']; ?>" target="_block">
            <img src="/static/<?php echo $one_up['path']; ?>" width="1200px" height="71px" alt="">
        </a>
    </div>
    <!-- 一楼 -->
    <div id="detaile1" class="clear">
        <div class="leftDetaile1 left">
            <div id="floorOne">
                <img src="/static/index/image/floor-1.jpg" alt=""/>
            </div>
            <div id="addressBox" class="clear">
                <!-- 一楼左侧 -->

                <!-- 按钮用 JS 实现 -->
                <?php if(is_array($area) || $area instanceof \think\Collection || $area instanceof \think\Paginator): $i = 0; $__LIST__ = $area;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$area): $mod = ($i % 2 );++$i;?>
                <a href="<?php echo url('Advancesale/louhuayushou'); ?>?area=<?php echo $area['id']; ?>&price=0&layout=0&theme=0">
                    <div class="btnAdd">
                        <p class="cName"><?php echo $area['name']; ?></p>
                        <!--<p class="eName">Vancouver</p>-->
                    </div>
                </a>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </div>
        </div>
        <!--一楼中间-->
        <div class="midDetaile1 left">
            <div class="midheng1"></div>
            <div class="mainBox1">
                <div class="floor1Main">
                    <div class="floor1Nav clear">
                        <a href="<?php echo url('Index/index'); ?>" class="floor1A <?php if($theme_id==0) echo 'active';?> left">楼盘预售</a>
                        <?php if(is_array($theme) || $theme instanceof \think\Collection || $theme instanceof \think\Paginator): $i = 0; $__LIST__ = $theme;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$theme): $mod = ($i % 2 );++$i;?>
                        <span class="floorSpan left">|</span>
                        <a href="<?php echo url('Index/index'); ?>?theme_id=<?php echo $theme['id']; ?>" class="floor1A <?php if($theme_id==$theme['id']) echo 'active';?> left"><?php echo $theme['name']; ?></a>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                    </div>
                    <div class="floor1img clear">
                        <!-- 循环产物 -->
                        <?php if(is_array($yushou) || $yushou instanceof \think\Collection || $yushou instanceof \think\Paginator): $i = 0; $__LIST__ = $yushou;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$yu): $mod = ($i % 2 );++$i;?>
                        <div class="floor1detailes left">
                            <div class="floor1imgBox">
                                <a href="<?php echo url('Advancesale/louhuayushou_detaile'); ?>?id=<?php echo $yu['id']; ?>">
                                    <img style="width:215px;height:143px" src="<?php echo $imgs[$yu['id']]; ?>" alt=""/>
                                </a>
                                <div class="downBg">
                                    <span class="fangName"><?php echo $yu['name']; ?></span>
                                </div>
                            </div>
                            <a href="<?php echo url('Advancesale/louhuayushou_detaile'); ?>?id=<?php echo $yu['id']; ?>">
                            <p class="loupanName"><?php echo $yu['name']; ?></p>
                            </a>
                            <span class="loupanDizhi"><?php echo $yu['address']; ?></span>
                            <span class="loupanleixing"><?php echo $yu['type']; ?></span>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                        <!-- 循环产物 -->
                    </div>
                </div>
            </div>
        </div>
        <div class="rightDetaile1 left">
            <div class="rightDetaile1title">
                <div class="rightDetaile1titleHeng">
                    <p><a href="<?php echo url('Asking/index'); ?>">房产资讯</a></p>
                </div>
                <div style="border:1px solid #ddd;width:100%;"></div>
                <div class="newUp">
                    <!-- 新闻循环产物 -->
                    <?php if(is_array($asking_up) || $asking_up instanceof \think\Collection || $asking_up instanceof \think\Paginator): $i = 0; $__LIST__ = $asking_up;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ask_up): $mod = ($i % 2 );++$i;?>
                    <div class="newBox shenglue">
                        <a href="<?php echo url('Asking/detail'); ?>?id=<?php echo $ask_up['id']; ?>">
                            <span class="newTitle"><?php echo $ask_up['type']; ?></span>
                            <span>|</span>
                            <span class="newMessage"><?php echo $ask_up['question']; ?></span>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
                <div class="newDown">
                    <!-- 新闻循环产物 -->
                    <?php if(is_array($asking_down) || $asking_down instanceof \think\Collection || $asking_down instanceof \think\Paginator): $i = 0; $__LIST__ = $asking_down;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$ask_down): $mod = ($i % 2 );++$i;?>
                    <div class="newBox shenglue">
                        <a href="<?php echo url('Asking/detail'); ?>?id=<?php echo $ask_down['id']; ?>">
                            <span class="newTitle"><?php echo $ask_down['type']; ?></span>
                            <span>|</span>
                            <span class="newMessage"><?php echo $ask_down['question']; ?></span>
                        </a>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                </div>
            </div>
        </div>
    </div>
    <div class="longBannerBox">
        <!-- <img src="/static/index/image/banner-2.jpg" alt=""/> -->
        <a href="<?php echo $two_up['url']; ?>" target="_block">
            <img src="/static/<?php echo $two_up['path']; ?>" width="1200px" height="71px" alt=""/>
        </a>
    </div>

    <!-- 二楼 -->

    <div id="detaile2" class="clear">
        <!-- 二楼左侧 -->
        <div class="leftDetaile2 left">
            <div id="floorTow">
                <img src="/static/index/image/floor-2.jpg" alt=""/>
            </div>
            <div id="floor2banner" class="clear">
                <!-- <img src="/static/index/image/leftBanner-1.jpg" alt=""/> -->
                <a href="<?php echo $two_left['url']; ?>" target="_block">
                    <img src="/static/<?php echo $two_left['path']; ?>" width="200px" height="326px" alt=""/>
                </a>
            </div>
        </div>
        <!-- 二楼中间 -->
        <div class="midDetaile2 left">
            <div class="midheng2"></div>
            <div class="mainBox2">
                <!--<div class="floor1Main">-->
                <div class="floor1img clear">
                    <!-- 循环产物 -->
                    <?php if(is_array($xianfang) || $xianfang instanceof \think\Collection || $xianfang instanceof \think\Paginator): $i = 0; $__LIST__ = $xianfang;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$xian): $mod = ($i % 2 );++$i;?>
                    <div class="floor2detailes left">
                        <div class="floor1imgBox">
                            <a href="<?php echo url('Hotroombed/repanxianfang_detaile'); ?>?id=<?php echo $xian['id']; ?>">
                            <img style="width:215px;height:143px" src="<?php echo $imgs[$xian['id']]; ?>" alt=""/>
                            </a>
                            <div class="downBg">
                                <span class="fangName"><?php echo $xian['name']; ?></span>
                            </div>
                        </div>
                        <a href="<?php echo url('Hotroombed/repanxianfang_detaile'); ?>?id=<?php echo $xian['id']; ?>">
                        <p class="loupanName"><?php echo $xian['name']; ?></p>
                        </a>
                        <span class="loupanDizhi"><?php echo $xian['address']; ?></span>
                        <span class="loupanleixing"><?php echo $xian['type']; ?></span>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>

                    <!-- 循环产物 -->
                </div>
                <!--</div>-->
            </div>
        </div>
        <!-- 二楼右侧 -->
        <div class="rightDetaile2 left">
            <div class="rightBannerBox">
                <!-- <img src="/static/index/image/floor2rightbanner-1.jpg" alt=""/> -->
                <a href="<?php echo $two_right_up['url']; ?>" target="_block">
                    <img src="/static/<?php echo $two_right_up['path']; ?>" width="270px" height="193px" alt=""/>
                </a>
            </div>
            <div class="rightBannerBox">
                <!-- <img src="/static/index/image/floor2rightbanner-2.jpg" alt=""/> -->
                <a href="<?php echo $two_right_down['url']; ?>" target="_block">
                    <img src="/static/<?php echo $two_right_down['path']; ?>" width="270px" height="193px" alt=""/>
                </a>
            </div>
        </div>
    </div>
    <div class="longBannerBox">
        <!--<img src="/static/index/image/banner-2.jpg" alt=""/>-->
        <a href="<?php echo $three_up['url']; ?>" target="_block">
            <img src="/static/<?php echo $three_up['path']; ?>" width="1200px" height="71px"  alt=""/>
        </a>
    </div>

    <!-- 三楼 -->
    <div id="detaile3" class="clear">
        <div class="leftDetaile2 left">
            <div id="floorThree">
                <img src="/static/index/image/floor-3.jpg" alt=""/>
            </div>
            <div id="floor3banner" class="clear">
                <!-- <img src="/static/index/image/leftbanner-2.jpg" alt=""/> -->
                <a href="<?php echo $three_left['url']; ?>" target="_block">
                    <img src="/static/<?php echo $three_left['path']; ?>" width="200px" height="379px"  alt=""/>
                </a>
            </div>
        </div>
        <!--三楼中间-->
        <!-- <div id="midDetaile3" class="left"> -->
        <div class="midDetaile2 left">
            <div class="midheng3"></div>
            <div class="mainBox3">
                <div class="floor1Main">
                    <div class="clear">
                        <a href="" class="floor1A active left">楼盘视频</a>
                        <!--<span class="floorSpan left">|</span>-->
                        <!--<a href="" class="floor1A left">资讯视频</a>-->
                        <!--<span class="floorSpan left">|</span>-->
                        <!--<a href="" class="floor1A left">其他视频</a>-->
                    </div>
                    <div id="floor3video" class="clear">
                        <!-- 循环产物 -->
                        <?php if(is_array($shipin) || $shipin instanceof \think\Collection || $shipin instanceof \think\Paginator): $i = 0; $__LIST__ = $shipin;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$shipin): $mod = ($i % 2 );++$i;?>
                        <div class="floor3detailes">
                            <div class="videoBox">
                            <iframe src="<?php echo $video[$shipin['id']]; ?>" frameborder="0" allowfullscreen="true" width="215" height="140"></iframe>
<!--                                 <video style="width:215px;height:143px" class="myVideo" src="/static/index/video/birds.mp4" poster="<?php echo $imgs[$shipin['id']]; ?>"></video>
                                <b class="videoPlay"></b> -->
                            </div>
                            <a href="<?php echo url('Videoroom/shipinkanfang_detaile'); ?>?id=<?php echo $shipin['id']; ?>">
                            <p class="videoName"><?php echo $shipin['name']; ?></p>
                            </a>
                        </div>
                        <?php endforeach; endif; else: echo "" ;endif; ?>

                        <!-- 循环产物 -->
                    </div>
                </div>
            </div>
        </div>
        <!-- 三楼右侧 -->
        <div class="rightDetaile2 left">
            <div class="rightBannerBox">
                <!-- <img src="/static/index/image/floor2rightbanner-1.jpg" alt=""/> -->
                <a href="<?php echo $three_right_up['url']; ?>" target="_block">
                    <img src="/static/<?php echo $three_right_up['path']; ?>" width="270px" height="193px" alt=""/>
                </a>
            </div>
            <div class="rightBannerBox">
                <!-- <img src="/static/index/image/floor2rightbanner-2.jpg" alt=""/> -->
                <a href="<?php echo $three_right_down['url']; ?>" target="_block">
                    <img src="/static/<?php echo $three_right_down['path']; ?>" width="270px" height="193px" alt=""/>
                </a>
            </div>
        </div>
    </div>
    <!-- 详情内容 -->
    <div id="footerNav" class="clear">
        <div class="footerSpanBox left">
            <p class="footerP">看房攻略</p>
            <a href="<?php echo url('Lookroom/kanfanggonglue'); ?>" class="footerBtn">点击查看</a>
        </div>
        <div class="footerSpanBox left">
            <p class="footerP">小编带你去看房</p>
            <a href="<?php echo url('Advancesale/louhuayushou'); ?>" class="footerBtn">点击查看</a>
        </div>
        <div class="footerSpanBox left">
            <p class="footerP">视频看房</p>
            <a href="<?php echo url('Videoroom/shipinkanfang'); ?>" class="footerBtn">点击查看</a>
        </div>
        <div class="footerPhoneBox left">
            <!-- <p class="footerP">服务热线</p>

            <p class="footerTel">400-8500-8080</p> -->
            <img src="<?php echo $config['img']; ?>" alt="" class="footerPhone">
        </div>
    </div>
</div>
<div id="foot">
    <!-- 底部公用 -->
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
    <!-- 底部公用 -->
</div>
<script src="/static/index/js/jquery-1.11.3.js"></script>
<script>
    $(function () {
        // alert($('.newUp .newBox:first-child :not(:last-child)').html());
        $('#floor3video').on('click', '.videoPlay', function () {
            $(this).hide();
            $(this).prev().attr('controls', true);
            $(this).prev().get(0).play();
            $.each($(this).parents('.floor3detailes').siblings('.floor3detailes').find('.myVideo'), function (i, e) {
                $(e).get(0).pause();
                $(e).attr('controls', false);
            });
            $(this).parents('.floor3detailes').siblings('.floor3detailes').find('.videoPlay').show();
        })
    });
</script>
</body>
</html>