<template>
	<view>
		<view class="dingwei_">
			<view class="w">
				<view class="dw_fle">
					<view>当前定位:</view>
					<view>四川省 · 成都市</view>
					<view>[重新获取]</view>
				</view>
			</view>
		</view>
		<view class="school_">
			<view class="w">
				<view class="box_">
					<view>海南热带海洋学院</view>
					<view></view>
				</view>
			</view>
		</view>
		<view class="school_">
			<view class="w">
				<view class="box_">
					<view>海南热带海洋学院</view>
					<view></view>
				</view>
			</view>
		</view>
		<view class="school_">
			<view class="w">
				<view class="box_" style="border-bottom:none">
						<view>海南热带海洋学院</view>
						<view></view>
				</view>
			</view>
		</view>
		<view class="msg_">
			<text>没有找到你的学校 ? </text>
			<text>查看全部</text>
		</view>
	</view>
</template>

<script></script>

<style scoped lang="scss">
@mixin w_ {
	width: 750rpx;
	display: flex;
	.w {
		flex: 1;
		margin: 0rpx 20rpx;
	}
	font-size: 32rpx !important;
	color: #474747;
}
.dingwei_ {
	@include w_;
	.dw_fle{
		width:100%;
		line-height: 60rpx;
		margin: 35rpx auto;
		display: flex;
		view:nth-child(2){
			min-width: 100rpx;
			padding: 0rpx 20rpx;
			border-radius: 10rpx;	
			background: white;
			margin: 0rpx 20rpx;
		}
		view:nth-child(3){
			flex: 1;
			text-align: left;
		}
	}
	
}
.school_{
	@include w_;
	.w{
		height: 100rpx;
		background: white;
		.box_{
			width: calc(100% - 30rpx);
			height: calc(100% - 1rpx);
			margin: 0 auto;
			border-bottom: 1rpx solid #E4E7ED;
			display: flex;
			line-height: 100rpx;
			view:first-child{
				flex: 1;
			}
			view:last-child{
				width: 50rpx;
				height:50rpx;
				background: url(../static/images/more.png);
				background-size: 100%;
				margin-top: 25rpx;
			}
		}
		
	}
}
.msg_{
	font-size:30rpx;
	color: #808080;
	width: 100%;
	text-align: center;
	padding: 50rpx 0rpx;
	text:last-child{
		color: rgb(25, 88, 156);
		margin-left: 10rpx;
	}
}
</style>
