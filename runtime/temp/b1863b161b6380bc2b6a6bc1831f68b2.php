<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:67:"C:\wamp64\www\my_obj\shop\public/../app/index\view\new_address.html";i:1508757455;}*/ ?>
<?php foreach($res_address as $v): ?>
	<li class="user-addresslist defaultAddr">

		<div class="address-left">
			<div class="user DefaultAddr">

				<span class="buy-address-detail">   
				<span class="buy-user"><?php echo $v['consignee']; ?></span>
				<span class="buy-phone"><?php echo $v['phone']; ?></span>
				</span>
			</div>
			<div class="default-address DefaultAddr">
				<span class="buy-line-title buy-line-title-type">收货地址：</span>
				<span class="buy--address-detail">
		   <span class="province"><?php echo $v['province']; ?></span>
				<span class="city"><?php echo $v['city']; ?></span>
				<span class="dist"><?php echo $v['country']; ?></span>
				<span class="street"><?php echo $v['address']; ?></span>
				</span>

				</span>
			</div>
			<?php if($v['is_default'] == '1'): ?>
			<ins class="deftip">默认地址</ins>
			<?php endif; ?>
		</div>
		<div class="address-right">
			<a href="person/address.html">
				<span class="am-icon-angle-right am-icon-lg"></span></a>
		</div>
		<div class="clear"></div>

		<div class="new-addr-btn">
			<a href="#" class="hidden">设为默认</a>
			<span class="new-addr-bar hidden">|</span>
			<a href="#" class="theme-login editAddr<?php echo $v['aid']; ?>">编辑</a>
			<span class="new-addr-bar">|</span>
			<a href="javascript:void(0);" onclick="delClick(this);">删除</a>
		</div>

	</li>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.useAddr').click(function(){
				$('.newAddr').html('新增地址');
				$('#address-aid').val(0);
			});
			$('.editAddr<?php echo $v['aid']; ?>').click(function(){
				$('.newAddr').html('变更地址');
				$('#address-aid').val(<?php echo $v['aid']; ?>);
			})
		});
	</script>
	<div class="per-border"></div>
<?php endforeach; ?>