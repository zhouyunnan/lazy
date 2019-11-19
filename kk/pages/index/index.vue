<template>
	<view class="content">
		<image class="logo" src="/static/logo.png"></image>
		<view class="text-area">
			<text class="title">{{title}}</text>
		</view>
	</view>
</template>

<script>
	export default {
		data() {
			return {
				title: 'Hello'
			}
		},
		onLoad() {
			uni.authorize({
			    scope: 'scope.userLocation',
			    success() {
			        uni.getLocation({
						 type: 'gcj02',
						    success: function (res) {
								uni.request({ //30.65618,104.08329
									method: 'GET', //30.65618,104.08329 
									url: 'https://apis.map.qq.com/ws/geocoder/v1/?location='+res.latitude+','+res.longitude+'&get_poi=1&key=OHCBZ-ME3EK-QZTJA-AI2GJ-SXE3J-SSBIG',
									data: {},
									header: {
										'content-type': 'application/x-www-form-urlencoded;charset=utf-8',
									},
									success: res => {
										console.log(res.data);
									}
								});
						    }
					})
			    }
			})
		},
		methods: {

		}
	}
</script>

<style>
	.content {
		display: flex;
		flex-direction: column;
		align-items: center;
		justify-content: center;
	}

	.logo {
		height: 200rpx;
		width: 200rpx;
		margin-top: 200rpx;
		margin-left: auto;
		margin-right: auto;
		margin-bottom: 50rpx;
	}

	.text-area {
		display: flex;
		justify-content: center;
	}

	.title {
		font-size: 36rpx;
		color: #8f8f94;
	}
</style>
