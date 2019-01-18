<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:85:"/home/fan/workspace/lhw/public/../application/index/view/lookroom/kanfanggonglue.html";i:1527848518;s:63:"/home/fan/workspace/lhw/application/index/view/public/head.html";i:1547188996;s:63:"/home/fan/workspace/lhw/application/index/view/public/foot.html";i:1544091112;}*/ ?>
<!DOCTYPE html>
<html>

<head lang="zh-cn">
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="/static/index/css/rescss.css"/>
    <link rel="stylesheet" href="/static/index/css/kanfanggonglue.css"/>
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
<div id="main" class="clear">
    <div id="leftMain" class="left">
        <div id="dateils" class="clear">
            <div class="deteilsBox left">
                <h2 class="hongxian">看房攻略</h2>
                <!--攻略信息 循环区域-->


                <div class="deteilsMegBox">
                    <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$look): $mod = ($i % 2 );++$i;?>
                    <div class="megBox clear">
                        <div class="msgImg left">
                            <a href="<?php echo url('Lookroom/kanfanggonglue_msg'); ?>?id=<?php echo $look['id']; ?>" target="_blank"><img src="<?php echo $look['photo']; ?>" alt="" width="125px" height="85px"/></a>
                        </div>
                        <div class="msgTextBox">
                            <h3>
							<a href="<?php echo url('Lookroom/kanfanggonglue_msg'); ?>?id=<?php echo $look['id']; ?>" target="_blank" class="xiangqing">
							<?php echo $look['title']; ?>
							</a>
							</h3>
                            <span class="msgZhaiyao">
                                [简介]
                            </span>
                            <span class="msgText">
                                <?php echo mb_substr($look['summary'],0,40,'UTF-8');?>
                            </span>
                            <a href="<?php echo url('Lookroom/kanfanggonglue_msg'); ?>?id=<?php echo $look['id']; ?>" target="_blank" class="xiangqing">[详情]</a>
                        </div>
                    </div>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                    <div id="fenye" class="clear">
                        <?php echo $list->render(); ?>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div id="rightMain" class="left">
        <h2 class="rightTitle">热门阅读</h2>
        <?php if(is_array($litt) || $litt instanceof \think\Collection || $litt instanceof \think\Paginator): $k = 0; $__LIST__ = $litt;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$looks): $mod = ($k % 2 );++$k;?>
        <div class="paihangBox">
            <div class="yuduBox clear ">
                <div class="yuNum left"><?php echo $k; ?></div>
                <div class="yueMeg shenglue">
                    <a href="<?php echo url('Lookroom/kanfanggonglue_msg'); ?>?id=<?php echo $looks['id']; ?>"><?php echo $looks['title']; ?></a>
                </div>
            </div>
        </div>
        <?php endforeach; endif; else: echo "" ;endif; ?>
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
</body>

</html>