<template>
	<view>
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
			<text>所在学校没开通 ?</text>
			<text>成为跑男</text>
		</view>
	</view>
</template>
<script>
	export default {};
</script>

<style scoped lang="scss">
	@mixin w_ {
		width: 750rpx;
		display: flex;

		.w {
			flex: 1;
		}

		font-size: 32rpx !important;
		color: #474747;
	}

	.school_ {
		@include w_;

		.w {
			height: 100rpx;
			background: white;

			.box_ {
				width: calc(100% - 30rpx);
				height: calc(100% - 1rpx);
				margin: 0 auto;
				border-bottom: 1rpx solid #e4e7ed;
				display: flex;
				line-height: 100rpx;

				view:first-child {
					flex: 1;
				}

				view:last-child {
					width: 50rpx;
					height: 50rpx;
					background: url(../../static/images/more.png);
					background-size: 100%;
					margin-top: 25rpx;
				}
			}
		}
	}

	.msg_ {
		font-size: 30rpx;
		color: #808080;
		width: 100%;
		text-align: center;
		padding: 50rpx 0rpx;

		text:last-child {
			color: rgb(25, 88, 156);
			margin-left: 10rpx;
		}
	}
</style>
