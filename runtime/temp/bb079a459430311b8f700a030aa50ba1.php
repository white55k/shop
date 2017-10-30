<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:61:"C:\wamp64\www\my_obj\shop\public/../app/index\view\index.html";i:1509324516;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>首页</title>

		<link href="__AMAZEUI_CSS__/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="__AMAZEUI_CSS__/admin.css" rel="stylesheet" type="text/css" />

		<link href="__BASIC_CSS__/demo.css" rel="stylesheet" type="text/css" />

		<link href="__CSS__/hmstyle.css" rel="stylesheet" type="text/css"/>
		<link href="__CSS__/skin.css" rel="stylesheet" type="text/css" />
		<script src="__AMAZEUI_JS__/jquery.min.js"></script>
		<script src="__AMAZEUI_JS__/amazeui.min.js"></script>

	</head>

	<body>
		<div class="hmtop">
			<!--顶部导航条 -->
			<div class="am-container header">
				<ul class="message-l">
					<div class="topMessage">
						<div class="menu-hd">
							<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
							<a href="<?php echo url('user/login'); ?>" target="_top" class="h">亲，请登录</a>
							<a href="<?php echo url('user/register'); ?>" target="_top">免费注册</a>
							<?php else: ?>
							欢迎您！<a href="#" target="_top" class="h"><?php echo (\think\Session::get('username')) ? \think\Session::get('username') :  \think\Cookie::get('username'); ?></a>
							<a href="<?php echo url('User/quiet'); ?>">注销</a>
							<?php endif; ?>
						</div>
					</div>
				</ul>
				<ul class="message-r">
					<div class="topMessage home">
						<div class="menu-hd"><a href="<?php echo url('Index/index'); ?>" target="_top" class="h">商城首页</a></div>
					</div>
					<div class="topMessage my-shangcheng">
						<div class="menu-hd MyShangcheng"><a href="index/user/center.html" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
					</div>
					<div class="topMessage mini-cart">
						<div class="menu-hd">
						<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
							<a id="mc-menu-hd" href="<?php echo url('User/login'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span></a>
						<?php else: ?>
							<a id="mc-menu-hd" href="<?php echo url('ShowCar/index'); ?>" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span></a>
						<?php endif; ?>
						</div>
					</div>
					<div class="topMessage favorite">
						<div class="menu-hd">
						<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
							<a href="<?php echo url('User/login'); ?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
						<?php else: ?>
							<a href="<?php echo url('Collect/index'); ?>" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a>
						<?php endif; ?>
						</div>
				</ul>
				</div>

				<!--悬浮搜索框-->

				<div class="nav white">
					<div class="logo"><img src="<?php echo $res_site['logo']; ?>" /></div>
					<div class="logoBig">
						<li><img src="<?php echo $res_site['logo']; ?>" /></li>
					</div>

					<div class="search-bar pr">
						<a name="index_none_header_sysc" href="#"></a>
						<form action="<?php echo url('Search/index'); ?>" method="get">
							<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
							<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
						</form>
					</div>
				</div>

				<div class="clear"></div>
			</div>
			<div class="banner">
                      <!--轮播 -->
						<div class="am-slider am-slider-default scoll" data-am-flexslider id="demo-slider-0">
							<ul class="am-slides">
							<?php foreach($res_figure as $v): ?>
								<li class="banner<?php echo $v['fid']; ?>"><a href="<?php echo $v['url']; ?>"><img src="<?php echo $v['picture']; ?>" /></a></li>
							<?php endforeach; ?>
							</ul>
						</div>
						<div class="clear"></div>	
			</div>
			<div class="shopNav">
				<div class="slideall">
					
					   <div class="long-title"><span class="all-goods">全部分类</span></div>
					   <div class="nav-cont">
							<ul>
								<li class="index"><a href="<?php echo url('Index/index'); ?>">首页</a></li>
                                <li class="qc"><a href="#">闪购</a></li>
                                <li class="qc"><a href="#">限时抢</a></li>
                                <li class="qc"><a href="#">团购</a></li>
                                <li class="qc last"><a href="#">大包装</a></li>
							</ul>
						    <div class="nav-extra">
						    	<i class="am-icon-user-secret am-icon-md nav-user"></i><b></b>我的福利
						    	<i class="am-icon-angle-right" style="padding-left: 10px;"></i>
						    </div>
						</div>					
		        				
						<!--侧边导航 -->
						<div id="nav" class="navfull">
							<div class="area clearfix">
								<div class="category-content" id="guide_2">
									
									<div class="category">
										<ul class="category-list" id="js_climit_li">
										<?php foreach($res_menu as $v): ?>
											<li class="appliance js_toggle relative">
												<div class="category-info">
													<h3 class="category-name b-category-name"><i><img src="<?php echo $v['icon']; ?>"></i><a class="ml-22" title="<?php echo $v['name']; ?>"><?php echo $v['name']; ?></a></h3>
													<em>&gt;</em></div>
												<div class="menu-item menu-in top">
													<div class="area-in">
														<div class="area-bg">
															<div class="menu-srot">
																<div class="sort-side">
																	<dl class="dl-sort">
																		<dt><span title="蛋糕"><?php echo $v['name']; ?></span></dt>
																		<?php foreach($v->sort as $val): ?>
																		<dd><a title="<?php echo $v['name']; ?>" href="<?php echo url('Search/index', ['index_none_header_sysc'=>$val->name]); ?>"><span><?php echo $val['name']; ?></span></a></dd>
																		<?php endforeach; ?>
																	</dl>
																</div>
																<div class="brand-side">
																	<dl class="dl-sort"><dt><span>实力商家</span></dt>
																		<dd><a rel="nofollow" title="呵官方旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >呵官方旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="格瑞旗舰店" target="_blank" href="#" rel="nofollow"><span >格瑞旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="飞彦大厂直供" target="_blank" href="#" rel="nofollow"><span  class="red" >飞彦大厂直供</span></a></dd>
																		<dd><a rel="nofollow" title="红e·艾菲妮" target="_blank" href="#" rel="nofollow"><span >红e·艾菲妮</span></a></dd>
																		<dd><a rel="nofollow" title="本真旗舰店" target="_blank" href="#" rel="nofollow"><span  class="red" >本真旗舰店</span></a></dd>
																		<dd><a rel="nofollow" title="杭派女装批发网" target="_blank" href="#" rel="nofollow"><span  class="red" >杭派女装批发网</span></a></dd>

																	</dl>
																</div>
															</div>
														</div>
													</div>
												</div>
											</li>
										<?php endforeach; ?>
										</ul>
									</div>
								</div>

							</div>
						</div>
						
						
						<!--轮播-->
						
						<script type="text/javascript">
							(function() {
								$('.am-slider').flexslider();
							});
							$(document).ready(function() {
								$("li").hover(function() {
									$(".category-content .category-list li.first .menu-in").css("display", "none");
									$(".category-content .category-list li.first").removeClass("hover");
									$(this).addClass("hover");
									$(this).children("div.menu-in").css("display", "block")
								}, function() {
									$(this).removeClass("hover")
									$(this).children("div.menu-in").css("display", "none")
								});
							})
						</script>



					<!--小导航 -->
					<div class="am-g am-g-fixed smallnav">
						<div class="am-u-sm-3">
							<a href="sort.html"><img src="__IMAGES__/navsmall.jpg" />
								<div class="title">商品分类</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="__IMAGES__/huismall.jpg" />
								<div class="title">大聚惠</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="__IMAGES__/mansmall.jpg" />
								<div class="title">个人中心</div>
							</a>
						</div>
						<div class="am-u-sm-3">
							<a href="#"><img src="__IMAGES__/moneysmall.jpg" />
								<div class="title">投资理财</div>
							</a>
						</div>
					</div>

					<!--走马灯 -->

					<div class="marqueen">
						<span class="marqueen-title">商城头条</span>
						<div class="demo">

							<ul>
								<li class="title-first"><a target="_blank" href="#">
									<img src="__IMAGES__/TJ2.jpg"></img>
									<span>[特惠]</span>商城爆品1分秒								
								</a></li>
								<li class="title-first"><a target="_blank" href="#">
									<span>[公告]</span>商城与广州市签署战略合作协议
								     <img src="__IMAGES__/TJ.jpg"></img>
								     <p>XXXXXXXXXXXXXXXXXX</p>
							    </a></li>
							    
						<div class="mod-vip">
						<?php if(!empty(\think\Session::get('username')) OR !empty(\think\Cookie::get('username'))): ?>
							<div class="m-baseinfo">
								<a href="person/index.html">
									<img src="<?php echo $res_user['picture']; ?>">
								</a>
								<em>
									Hi,<span class="s-name"><?php echo $res_user['username']; ?></span>
									<a href="#"><p>点击更多优惠活动</p></a>									
								</em>
							</div>
						<?php else: ?>
							<div class="member-logout">
								<a class="am-btn-warning btn" href="login.html">登录</a>
								<a class="am-btn-warning btn" href="register.html">注册</a>
							</div>
						<?php endif; ?>
							<div class="member-login">
								<a href="#"><strong>0</strong>待收货</a>
								<a href="#"><strong>0</strong>待发货</a>
								<a href="#"><strong>0</strong>待付款</a>
								<a href="#"><strong>0</strong>待评价</a>
							</div>
							<div class="clear"></div>	
						</div>																	    
							    
								<li><a target="_blank" href="#"><span>[特惠]</span>洋河年末大促，低至两件五折</a></li>
								<li><a target="_blank" href="#"><span>[公告]</span>华北、华中部分地区配送延迟</a></li>
								<li><a target="_blank" href="#"><span>[特惠]</span>家电狂欢千亿礼券 买1送1！</a></li>
								
							</ul>
                        <div class="advTip"><img src="__IMAGES__/advTip.jpg"/></div>
						</div>
					</div>
					<div class="clear"></div>
				</div>
				<script type="text/javascript">
					if ($(window).width() < 640) {
						function autoScroll(obj) {
							$(obj).find("ul").animate({
								marginTop: "-39px"
							}, 500, function() {
								$(this).css({
									marginTop: "0px"
								}).find("li:first").appendTo(this);
							})
						}
						$(function() {
							setInterval('autoScroll(".demo")', 3000);
						})
					}
				</script>
			</div>
			<div class="shopMainbg">
				<div class="shopMain" id="shopmain">

					<!--今日推荐 -->

					<div class="am-g am-g-fixed recommendation">
						<div class="clock am-u-sm-3" ">
							<img src="__IMAGES__/2016.png "></img>
							<p>今日<br>推荐</p>
						</div>
						<?php foreach($res_good as $v): ?>
						<div class="am-u-sm-4 am-u-lg-3 ">
							<div class="info ">
								<h3><?php echo $v['keyword']; ?></h3>
								<h4><?php echo $v['name']; ?></h4>
							</div>
							<div class="recommendationMain one">
								<a href="<?php echo url('Introduct/good', ['gid'=>$v['gid']]); ?>"><img src="<?php echo $v->picture->path_url; ?>"></img></a>
							</div>
						</div>	
						<?php endforeach; ?>					
					</div>
					<div class="clear "></div>
					<!--热门活动 -->

					<div class="am-container activity ">
						<div class="shopTitle ">
							<h4>活动</h4>
							<h3>每期活动 优惠享不停 </h3>
							<span class="more ">
                              <a href="# ">全部活动<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					  <div class="am-g am-g-fixed ">
						<?php foreach($res_seckill as $v): ?>
							<div class="am-u-sm-3 ">
							  <div class="icon-sale two "></div>	
								<h4>秒杀</h4>
								<div class="activityMain ">
									<a href="<?php echo url('Introduct/good', ['gid'=>$v['gid']]); ?>"><img src="<?php echo $v->picture->path_url; ?>"></img></a>
								</div>
								<div class="info ">
									<h3><?php echo $v['name']; ?></h3>								
								</div>							
							</div>						
						<?php endforeach; ?>
					  </div>
          </div>
					<div class="clear "></div>


                    
					<!--甜点-->
					<?php foreach($res_menu as $v): ?>
					<div id="f<?php echo $v['mid']; ?>">
					<div class="am-container ">
						<div class="shopTitle ">
							<h4><?php echo $v['name']; ?></h4>
							<h3>每一道美食都有一个故事</h3>
							<div class="today-brands ">
							<?php foreach($v->sort as $val): ?>
								<a href="<?php echo url('Search/index', ['index_none_header_sysc'=>$val->name]); ?>"><?php echo $val['name']; ?></a>
							<?php endforeach; ?>
							</div>
							<span class="more ">
                    <a href="<?php echo url('Search/index', ['index_none_header_sysc'=>$val->name]); ?>">更多美味<i class="am-icon-angle-right" style="padding-left:10px ;" ></i></a>
                        </span>
						</div>
					</div>
					
					<div class="am-g am-g-fixed floodFour">
						<div class="am-u-sm-5 am-u-md-4 text-one list ">
							<div class="word">
							<?php $__FOR_START_9686__=0;$__FOR_END_9686__=6;for($i=$__FOR_START_9686__;$i < $__FOR_END_9686__;$i+=1){ ?>
								<a class="outer" href="<?php echo url('Search/index', ['index_none_header_sysc'=>$v->sort[$i]['name']]); ?>"><span class="inner"><b class="text"><?php echo $v->sort[$i]['name']; ?></b></span></a>
							<?php } ?>									
							</div>
							<img src="<?php echo $v['picture']; ?>" />								
							<div class="triangle-topright"></div>						
						</div>
						
							<div class="am-u-sm-7 am-u-md-4 text-two sug">
								<div class="outer-con ">
									<div class="title ">
										<?php echo $v->sort[0]->good[0]['name']; ?>
									</div>									
									<div class="sub-title ">
										&yen;<?php echo $v->sort[0]->good[0]['money']; ?>
									</div>
									<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
									<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
									<?php else: ?>
									<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[0]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
									<?php endif; ?>
								</div>
								<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[0]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[0]->picture['path_url']; ?>" /></a>
							</div>

							<div class="am-u-sm-7 am-u-md-4 text-two">
								<div class="outer-con ">
									<div class="title ">
										<?php echo $v->sort[0]->good[1]['name']; ?>
									</div>
									<div class="sub-title ">
										&yen;<?php echo $v->sort[0]->good[1]['money']; ?>
									</div>
									<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
									<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
									<?php else: ?>
									<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[1]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
									<?php endif; ?>
								</div>
								<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[1]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[1]->picture['path_url']; ?>" /></a>
							</div>


						<div class="am-u-sm-3 am-u-md-2 text-three big">
							<div class="outer-con ">
								<div class="title ">
									<?php echo $v->sort[0]->good[2]['name']; ?>
								</div>
								<div class="sub-title ">
									&yen;<?php echo $v->sort[0]->good[2]['money']; ?>
								</div>
								<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
								<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php else: ?>
								<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[2]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php endif; ?>
							</div>
							<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[2]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[2]->picture['path_url']; ?>" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three sug">
							<div class="outer-con ">
								<div class="title ">
									<?php echo $v->sort[0]->good[3]['name']; ?>
								</div>
								<div class="sub-title ">
									&yen;<?php echo $v->sort[0]->good[3]['money']; ?>
								</div>
								<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
								<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php else: ?>
								<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[3]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md seprate"></i></a>
								<?php endif; ?>
							</div>
							<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[3]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[3]->picture['path_url']; ?>" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three ">
							<div class="outer-con ">
								<div class="title ">
									<?php echo $v->sort[0]->good[4]['name']; ?>
								</div>
								<div class="sub-title ">
									&yen;<?php echo $v->sort[0]->good[4]['money']; ?>
								</div>
								<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
								<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php else: ?>
								<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[4]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php endif; ?>
							</div>
							<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[4]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[4]->picture['path_url']; ?>" /></a>
						</div>

						<div class="am-u-sm-3 am-u-md-2 text-three last big ">
							<div class="outer-con ">
								<div class="title ">
									<?php echo $v->sort[0]->good[5]['name']; ?>
								</div>
								<div class="sub-title ">
									&yen;<?php echo $v->sort[0]->good[5]['money']; ?>
								</div>
								<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
								<a href="<?php echo url('User/login'); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php else: ?>
								<a href="<?php echo url('Collect/addCollect', ['gid'=>$v->sort[0]->good[5]['gid']]); ?>"><i class="am-icon-shopping-basket am-icon-md  seprate"></i></a>
								<?php endif; ?>
							</div>
							<a href="<?php echo url('Introduct/good', ['gid'=>$v->sort[0]->good[5]['gid']]); ?>"><img src="<?php echo $v->sort[0]->good[5]->picture['path_url']; ?>" /></a>
						</div>

					</div>
                 <div class="clear "></div>  
                 </div>
          <?php endforeach; ?>
   
   
					<div class="footer ">
						<div class="footer-hd ">
							<p>
								<a href="# ">恒望科技</a>
								<b>|</b>
								<a href="<?php echo url('Index/index'); ?>">商城首页</a>
								<b>|</b>
								<a href="# ">支付宝</a>
								<b>|</b>
								<a href="# ">物流</a>
							</p>
						</div>
						<div class="footer-bd ">
							<p>
								<a href="# ">关于恒望</a>
								<a href="# ">合作伙伴</a>
								<a href="# ">联系我们</a>
								<a href="# ">网站地图</a>
								<em>(<?php echo $res_site['record']; ?>)</em>
							</p>
						</div>
					</div>

		</div>
		</div>
		<!--引导 -->
		<div class="navCir">
			<li class="active"><a href="<?php echo url('Index/index'); ?>"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>


		<!--菜单 -->
		<div class=tip>
			<div id="sidebar">
				<div id="wrap">
					<div id="prof" class="item ">
						<a href="# ">
							<span class="setting "></span>
						</a>
						<div class="ibar_login_box status_login ">
							<div class="avatar_box ">
								<p class="avatar_imgbox "><img src="__IMAGES__/no-img_mid_.jpg " /></p>
								<ul class="user_info ">
									<li>用户名sl1903</li>
									<li>级&nbsp;别普通会员</li>
								</ul>
							</div>
							<div class="login_btnbox ">
								<a href="# " class="login_order ">我的订单</a>
								<a href="# " class="login_favorite ">我的收藏</a>
							</div>
							<i class="icon_arrow_white "></i>
						</div>

					</div>
					<div id="shopCart " class="item ">
						<a href="# ">
							<span class="message "></span>
						</a>
						<p>
							购物车
						</p>
						<p class="cart_num ">0</p>
					</div>
					<div id="asset " class="item ">
						<a href="# ">
							<span class="view "></span>
						</a>
						<div class="mp_tooltip ">
							我的资产
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="foot " class="item ">
						<a href="# ">
							<span class="zuji "></span>
						</a>
						<div class="mp_tooltip ">
							我的足迹
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="brand " class="item ">
						<a href="#">
							<span class="wdsc "><img src="__IMAGES__/wdsc.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我的收藏
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div id="broadcast " class="item ">
						<a href="# ">
							<span class="chongzhi "><img src="__IMAGES__/chongzhi.png " /></span>
						</a>
						<div class="mp_tooltip ">
							我要充值
							<i class="icon_arrow_right_black "></i>
						</div>
					</div>

					<div class="quick_toggle ">
						<li class="qtitem ">
							<a href="# "><span class="kfzx "></span></a>
							<div class="mp_tooltip ">客服中心<i class="icon_arrow_right_black "></i></div>
						</li>
						<!--二维码 -->
						<li class="qtitem ">
							<a href="#none "><span class="mpbtn_qrcode "></span></a>
							<div class="mp_qrcode " style="display:none; "><img src="__IMAGES__/weixin_code_145.png " /><i class="icon_arrow_white "></i></div>
						</li>
						<li class="qtitem ">
							<a href="#top " class="return_top "><span class="top "></span></a>
						</li>
					</div>

					<!--回到顶部 -->
					<div id="quick_links_pop " class="quick_links_pop hide "></div>

				</div>

			</div>
			<div id="prof-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					我
				</div>
			</div>
			<div id="shopCart-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					购物车
				</div>
			</div>
			<div id="asset-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					资产
				</div>

				<div class="ia-head-list ">
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">优惠券</div>
					</a>
					<a href="# " target="_blank " class="pl ">
						<div class="num ">0</div>
						<div class="text ">红包</div>
					</a>
					<a href="# " target="_blank " class="pl money ">
						<div class="num ">￥0</div>
						<div class="text ">余额</div>
					</a>
				</div>

			</div>
			<div id="foot-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					足迹
				</div>
			</div>
			<div id="brand-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					收藏
				</div>
			</div>
			<div id="broadcast-content " class="nav-content ">
				<div class="nav-con-close ">
					<i class="am-icon-angle-right am-icon-fw "></i>
				</div>
				<div>
					充值
				</div>
			</div>
		</div>
		<script>
			window.jQuery || document.write('<script src="__BASIC_JS__/jquery.min.js "><\/script>');
		</script>
		<script type="text/javascript " src="__BASIC_JS__/quick_links.js "></script>
	</body>

</html>