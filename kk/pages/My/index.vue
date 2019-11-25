<template>
	<view class="my_">
		<view :class="[userinfo ? 'my_header_sqh' : 'my_header']">
			<view class="my_header_tx" v-if="!userinfo"><img src="../../static/images/touxiang.jpg" /></view>
			<view class="my_header_tx" v-if="userinfo"><img :src="userinfo.avatarUrl" /></view>
			<view class="my_header_name">
				<view v-if="userinfo">{{ userinfo.nickName }}</view>
			</view>
			<view v-if="!userinfo"><button class="public_btn1" open-type="getUserInfo" @getuserinfo="wxGetUserInfo" withCredentials="true">微信快捷登陆</button></view>
		</view>
		<view class="my_content">
			<view class="my_content_nav" @click="ddh()">
				<view class="my_nav_ico xuexiao"></view>
				<view class="my_nav_msg">所在学校设置</view>
			</view>
			<view class="my_content_nav" @click="dizhi()">
				<view class="my_nav_ico dizhi"></view>
				<view class="my_nav_msg">收货地址管理</view>
			</view>
			<view class="my_content_nav" @click="ddh()">
				<view class="my_nav_ico lianmeng"></view>
				<view class="my_nav_msg" style="color:rgb(2, 91, 163)">联盟招聘书</view>
			</view>
		</view>
	</view>
</template>

<script> 
export default {
	data() {
		return {
			title: 'Hello',
			btn_: 'btn1',
			btn1: '微信快捷登陆',
			userinfo: false,
			qx: {
				fxy: false,
				sh: false
			}
		};
	},
	onLoad() {
		this.userinfo = uni.getStorageSync('userinfo');
	},
	methods: {
		dizhi() {
			uni.navigateTo({
				url: '/pages/My/dizhi'
			});
		},
		//微信授权
		wxGetUserInfo(e) {
			let thiz = this;
			if (e.detail.userInfo == undefined || e.detail.userInfo == '' || e.detail.userInfo == null) {
				uni.showToast({
					title: '无授权',
					icon: 'none',
					duration: 1400,
					position: 'top'
				});
			} else {
				let userInfo = e.detail.userInfo;
				this.userinfo = userInfo;
				uni.showLoading({
					title: 'Loading'
				});
				uni.request({
					method: 'POST',
					url: thiz.myconfig.url + 'index.php/home/xlogin/userinfo',
					data: {
						avatarUrl: userInfo.avatarUrl,
						nickName: userInfo.nickName
					},
					header: {
						'content-type': 'application/x-www-form-urlencoded;charset=utf-8',
						Cookie: uni.getStorageSync('sessionid')
					},
					success: res => {
						uni.hideLoading();
					}
				});
			}
		},
		
	}
};
</script>

<style lang="scss" scoped>
.xuexiao{
    background: url("../../static/images/xuexiao.png")
}
.dizhi{
    background: url("../../static/images/dizhi.png")
}
.lianmeng{
    background: url("../../static/images/union.png");
	width: 30rpx !important;
	height: 30rpx !important;
	background-size: 100% 100%;
	text-align: center;
	margin-top: 30rpx !important;
    margin-left: 13rpx !important;
}
.clear {
	clear: both;
}
.my_header {
	width: 100vw;
	height: 304rpx;
	background: white;
	padding-top: 40rpx;
}
.my_header_sqh {
	width: 100vw;
	height: 264rpx;
	background: white;
	padding-top: 30rpx;
}
.my_header_tx {
	width: 137rpx;
	height: 137rpx;
	margin: 0 auto;
	border-radius: 50%;
	overflow: hidden !important;
}
.my_header_tx img {
	width: 100%;
	height: 100%;
}
.my_header_name {
	width: 750rpx;
	margin-top: 21rpx;
	text-align: center;
	color: black;
	font-size: 32rpx;
	padding-bottom: 30rpx;
}
.my_content {
	width: 710rpx;
	background: white;
	padding: 0rpx 20rpx 0 20rpx;
	margin: 0 auto;
	margin-top: 30rpx;
	padding-bottom: 20vh;
}
.my_content_nav {
	width: 100%;
	height: 88rpx;
	line-height: 88rpx;
	margin: 0 auto;
	border-bottom: 1px solid #e5e5e5;
}
.my_nav_ico,
.my_nav_msg {
	float: left;
	line-height: 88rpx;
	margin-left: 10rpx;
}
.my_nav_ico {
	width: 35rpx;
	height: 35rpx;
	background-size: 100% 100%;
	text-align: center;
	margin-top: 26.5rpx;


}
.my_nav_ico > .iconfont {
	font-size: 36rpx;
}
.my_nav_msg {
	margin-left: 18rpx;
	font-size: 31rpx;
	color: #474747;
}
.my_ico_dd {
	color: #3da1ff;
}
.my_ico_jm {
	color: #90c847;
}
.public_btn1 {
	margin: 0 auto !important;
	width: 552rpx;
	text-align: center;
	color: #747474;
	font-size: 29rpx;
	height: 68rpx;
	line-height:68rpx;
	border-radius: 10rpx;
    border: 2rpx dashed #FF507D;
    background: white;
}
.wodd_ {
	width: 710rpx;
	height: 220rpx;
	padding: 0 20rpx;
	margin-top: 20rpx;
	background: white;
	.title {
		width: 710rpx;
		height: 70rpx;
		line-height: 70rpx;
		margin: 0 auto;
		border-bottom: 1rpx solid rgb(219, 219, 219);
		display: flex;
		view {
			flex: 1;
			color: #202020;
			font-size: 28rpx;
		}
		img {
			width: 24rpx;
			height: 24rpx;
			margin-top: 23rpx;
		}
	}
	.m_box {
		width: 100%;
		height: 159rpx;
		display: flex;
		.box {
			position: relative;
			flex: 1;
			img {
				position: absolute;
				width: 45rpx;
				height: 45rpx;
				top: 25rpx;
				left: 50%;
				margin-left: -22.5rpx;
			}
			view {
				position: absolute;
				font-size: 26rpx;
				color: #202020;
				bottom: 40rpx;
				width: 100%;
				text-align: center;
			}
			.yqx_ico {
				position: absolute;
				width: 60rpx;
				height: 60rpx;
				top: 14rpx;
				left: 50%;
				margin-left: -24.5rpx;
			}
		}
	}
}
</style>