<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:64:"C:\wamp64\www\my_obj\shop\public/../app/index\view\shopcart.html";i:1508763523;}*/ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

		<title>购物车页面</title>

		<link href="__AMAZEUI_CSS__/amazeui.css" rel="stylesheet" type="text/css" />
		<link href="__BASIC_CSS__/demo.css" rel="stylesheet" type="text/css" />
		<link href="__CSS__/cartstyle.css" rel="stylesheet" type="text/css" />
		<link href="__CSS__/optstyle.css" rel="stylesheet" type="text/css" />

		<script type="text/javascript" src="__JS__/jquery.js"></script>

	</head>

	<body>

		<!--顶部导航条 -->
		<div class="am-container header">
			<ul class="message-l">
				<div class="topMessage">
					<div class="menu-hd">
					<?php if(empty(\think\Session::get('username')) AND empty(\think\Cookie::get('username'))): ?>
						<a href="<?php echo url('user/login'); ?>" target="_top" class="h">亲，请登录</a>
						<a href="<?php echo url('user/reg'); ?>" target="_top">免费注册</a>
					<?php else: ?>
						欢迎您！<a href="#" target="_top" class="h"><?php echo (\think\Session::get('username')) ? \think\Session::get('username') :  \think\Cookie::get('username'); ?></a>
					<?php endif; ?>
					</div>
				</div>
			</ul>
			<ul class="message-r">
				<div class="topMessage home">
					<div class="menu-hd"><a href="#" target="_top" class="h">商城首页</a></div>
				</div>
				<div class="topMessage my-shangcheng">
					<div class="menu-hd MyShangcheng"><a href="#" target="_top"><i class="am-icon-user am-icon-fw"></i>个人中心</a></div>
				</div>
				<div class="topMessage mini-cart">
					<div class="menu-hd"><a id="mc-menu-hd" href="#" target="_top"><i class="am-icon-shopping-cart  am-icon-fw"></i><span>购物车</span><strong id="J_MiniCartNum" class="h">0</strong></a></div>
				</div>
				<div class="topMessage favorite">
					<div class="menu-hd"><a href="#" target="_top"><i class="am-icon-heart am-icon-fw"></i><span>收藏夹</span></a></div>
			</ul>
			</div>

			<!--悬浮搜索框-->

			<div class="nav white">
				<div class="logo"><img src="__IMAGES__/logo.png" /></div>
				<div class="logoBig">
					<li><img src="__IMAGES__/logobig.png" /></li>
				</div>

				<div class="search-bar pr">
					<a name="index_none_header_sysc" href="#"></a>
					<form>
						<input id="searchInput" name="index_none_header_sysc" type="text" placeholder="搜索" autocomplete="off">
						<input id="ai-topsearch" class="submit am-btn" value="搜索" index="1" type="submit">
					</form>
				</div>
			</div>

			<div class="clear"></div>

			<!--购物车 -->
			<div class="concent">
				<div id="cartTable">
					<div class="cart-table-th">
						<div class="wp">
							<div class="th th-chk">
								<div id="J_SelectAll1" class="select-all J_SelectAll">

								</div>
							</div>
							<div class="th th-item">
								<div class="td-inner">商品信息</div>
							</div>
							<div class="th th-price">
								<div class="td-inner">单价</div>
							</div>
							<div class="th th-amount">
								<div class="td-inner">数量</div>
							</div>
							<div class="th th-sum">
								<div class="td-inner">金额</div>
							</div>
							<div class="th th-op">
								<div class="td-inner">操作</div>
							</div>
						</div>
					</div>
					<div class="clear"></div>

					<tr class="item-list">
						<div class="bundle  bundle-last ">
							<div class="bundle-hd">
								<div class="bd-promos">
									<div class="bd-has-promo"></div>
									<div class="act-promo">
										
									</div>
									<span class="list-change theme-login">编辑</span>
								</div>
							</div>
							<div class="clear"></div>
							<div class="bundle-main">
								<?php foreach($res_car as $v): ?>
								<ul class="item-content clearfix">
									<li class="td td-chk">
										<div class="cart-checkbox ">
											<input class="check j_check<?php echo $v['cid']; ?>" id="J_CheckBox_170037950254" name="items[]" value="<?php echo $v['cid']; ?>" type="checkbox">
											<label for="J_CheckBox_170037950254"></label>
										</div>
									</li>

									<li class="td td-item">
										<div class="item-pic">
											<a href="#" target="_blank" data-title="<?php echo $v->good['details']; ?>" class="J_MakePoint" data-point="tbcart.8.12">
												<img src="<?php echo $v->good->picture[0]['path_url']; ?>" class="itempic J_ItemImg"></a>
										</div>
										<div class="item-info">
											<div class="item-basic-info">
												<a href="#" target="_blank" title="<?php echo $v->good['details']; ?>" class="item-title J_MakePoint" data-point="tbcart.8.11"><?php echo $v->good['details']; ?></a>
											</div>
										</div>
									</li>
									<li class="td td-info">
										<div class="item-props item-props-can">
											
										</div>
									</li>
									<li class="td td-price">
										<div class="item-price price-promo-promo">
											<div class="price-content">
												<div class="price-line">
													<em class="price-original"><?php echo $v->good['price']; ?></em>
												</div>
												<div class="price-line">
													<em class="J_Price price-now j_price<?php echo $v['cid']; ?>" tabindex="0"><?php echo $v->good['money']; ?></em>
												</div>
											</div>
										</div>
									</li>
									<li class="td td-amount">
										<div class="amount-wrapper ">
											<div class="item-amount ">
												<div class="sl">
													<input class="min am-btn min<?php echo $v['cid']; ?>" name="" type="button" value="-" />
													<input class="text_box text_box<?php echo $v['cid']; ?>" name="" type="text" value="<?php echo $v['quantity']; ?>" style="width:30px;" />
													<input class="add am-btn add<?php echo $v['cid']; ?>" name="" type="button" value="+" />
												</div>
											</div>
										</div>
									</li>
									<li class="td td-sum">
										<div class="td-inner">
											<em tabindex="0" class="J_ItemSum number j_money<?php echo $v['cid']; ?>"><?php echo $v->quantity * $v->good['money']; ?></em>
										</div>
									</li>
									<li class="td td-op">
										<div class="td-inner">
											<a title="移入收藏夹" class="btn-fav" href="#">
                  移入收藏夹</a>
											<a href="<?php echo url('DelCar/index', ['cid'=>$v->cid]); ?>" data-point-url="#" class="delete">
                  删除</a>
										</div>
									</li>
								</ul>
								<script type="text/javascript">
									$(document).ready(function(){
										$('.j_check<?php echo $v['cid']; ?>').click(function(){
											if ($('.j_check<?php echo $v['cid']; ?>').prop('checked')) {
												var j_total = parseFloat($('#J_Total').html()) + parseFloat($('.j_money<?php echo $v['cid']; ?>').html());
												$('#J_Total').html(j_total.toFixed(2));
											} else {
													var j_total = parseFloat($('#J_Total').html()) - parseFloat($('.j_money<?php echo $v['cid']; ?>').html());
													$('#J_Total').html(j_total.toFixed(2));
											}
										})
										$('.min<?php echo $v['cid']; ?>').click(function(){
											if ($('.text_box<?php echo $v['cid']; ?>').val() == 0) {
												return ;
											}
											$.get("<?php echo url('AddCar/delQuantity'); ?>",{cid:<?php echo $v['cid']; ?>},function(data){
												var allMoney = data.quantity * $('.j_price<?php echo $v['cid']; ?>').html();
												$('.j_money<?php echo $v['cid']; ?>').html(allMoney.toFixed(2));
											});
											if ($('.j_check<?php echo $v['cid']; ?>').prop('checked')) {
												var j_total = parseFloat($('#J_Total').html()) - parseFloat($('.j_price<?php echo $v['cid']; ?>').html());
												$('#J_Total').html(j_total.toFixed(2));
											}
										});
										$('.add<?php echo $v['cid']; ?>').click(function(){
											$.get("<?php echo url('AddCar/addQuantity'); ?>",{cid:<?php echo $v['cid']; ?>},function(data){
												var allMoney = data.quantity * $('.j_price<?php echo $v['cid']; ?>').html();
												$('.j_money<?php echo $v['cid']; ?>').html(allMoney.toFixed(2));
											});
											if ($('.j_check<?php echo $v['cid']; ?>').prop('checked')) {
												var j_total = parseFloat($('#J_Total').html()) + parseFloat($('.j_price<?php echo $v['cid']; ?>').html());
												$('#J_Total').html(j_total.toFixed(2));
											}
										});
									});
								</script>
								<?php endforeach; ?>

								
							</div>
						</div>
					</tr>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>

				<div class="float-bar-wrapper">
					<div id="J_SelectAll2" class="select-all J_SelectAll">
						<div class="cart-checkbox">
							<input class="check-all check" id="J_SelectAllCbx2" name="select-all" value="true" type="checkbox">
							<label for="J_SelectAllCbx2"></label>
						</div>
						<span>全选</span>
					</div>
					<div class="operations">
						<a href="#" hidefocus="true" class="deleteAll">删除</a>
						<a href="#" hidefocus="true" class="J_BatchFav">移入收藏夹</a>
					</div>
					<div class="float-bar-right">
						<div class="amount-sum">
							<div class="arrow-box">
								<span class="selected-items-arrow"></span>
								<span class="arrow"></span>
							</div>
						</div>
						<div class="price-sum">
							<span class="txt">合计:</span>
							<strong class="price">¥<em id="J_Total">0.00</em></strong>
						</div>
						<div class="btn-area">
							<a href="javascript:void(0)" id="J_Go" class="submit-btn submit-btn-disabled" aria-label="请注意如果没有选择宝贝，将无法结算">
								<span>结&nbsp;算</span></a>
						</div>
						<script type="text/javascript">
							$(document).ready(function(){
								$('#J_Go').click(function(){
									if ($('#J_Total').html() <= 0) {
										return ;
									}
									var cid = [];
									var i = 0;
									<?php foreach($res_car as $v): ?>
									if ($('.j_check<?php echo $v['cid']; ?>').prop('checked')) {
										cid[i] = <?php echo $v['cid']; ?>;
									}
									i++;
									<?php endforeach; ?>
									var url = "<?php echo url('Pay/index', ['cid'=>'Cid']); ?>";
									url = url.replace('Cid', cid);
									if (url.length) {
										$(location).attr('href', url);
									}
								});
							});
						</script>
					</div>

				</div>

				<div class="footer">
					<div class="footer-hd">
						<p>
							<a href="#">恒望科技</a>
							<b>|</b>
							<a href="#">商城首页</a>
							<b>|</b>
							<a href="#">支付宝</a>
							<b>|</b>
							<a href="#">物流</a>
						</p>
					</div>
					<div class="footer-bd">
						<p>
							<a href="#">关于恒望</a>
							<a href="#">合作伙伴</a>
							<a href="#">联系我们</a>
							<a href="#">网站地图</a>
							<em>© 2015-2025 Hengwang.com 版权所有</em>
						</p>
					</div>
				</div>

			</div>

			<!--操作页面-->

			<div class="theme-popover-mask"></div>

			<div class="theme-popover">
				<div class="theme-span"></div>
				<div class="theme-poptit h-title">
					<a href="javascript:;" title="关闭" class="close">×</a>
				</div>
				<div class="theme-popbod dform">
					<form class="theme-signin" name="loginform" action="" method="post">

						<div class="theme-signin-left">

							<li class="theme-options">
								<div class="cart-title">颜色：</div>
								<ul>
									<li class="sku-line selected">12#川南玛瑙<i></i></li>
									<li class="sku-line">10#蜜橘色+17#樱花粉<i></i></li>
								</ul>
							</li>
							<li class="theme-options">
								<div class="cart-title">包装：</div>
								<ul>
									<li class="sku-line selected">包装：裸装<i></i></li>
									<li class="sku-line">两支手袋装（送彩带）<i></i></li>
								</ul>
							</li>
							<div class="theme-options">
								<div class="cart-title number">数量</div>
								<dd>
									<input class="min am-btn am-btn-default" name="" type="button" value="-" />
									<input class="text_box" name="" type="text" value="1" style="width:30px;" />
									<input class="add am-btn am-btn-default" name="" type="button" value="+" />
									<span  class="tb-hidden">库存<span class="stock">1000</span>件</span>
								</dd>

							</div>
							<div class="clear"></div>
							<div class="btn-op">
								<div class="btn am-btn am-btn-warning">确认</div>
								<div class="btn close am-btn am-btn-warning">取消</div>
							</div>

						</div>
						<div class="theme-signin-right">
							<div class="img-info">
								<img src="__IMAGES__/kouhong.jpg_80x80.jpg" />
							</div>
							<div class="text-info">
								<span class="J_Price price-now">¥39.00</span>
								<span id="Stock" class="tb-hidden">库存<span class="stock">1000</span>件</span>
							</div>
						</div>

					</form>
				</div>
			</div>
		<!--引导 -->
		<div class="navCir">
			<li><a href="home.html"><i class="am-icon-home "></i>首页</a></li>
			<li><a href="sort.html"><i class="am-icon-list"></i>分类</a></li>
			<li class="active"><a href="shopcart.html"><i class="am-icon-shopping-basket"></i>购物车</a></li>	
			<li><a href="person/index.html"><i class="am-icon-user"></i>我的</a></li>					
		</div>
	</body>

</html>