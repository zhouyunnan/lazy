<template>
	<view v-if="dddata" style="margin-bottom:150rpx">
		<view class="top" v-if="dddata.quhuohao != undefined">
			<view class="text_box">
				<view class="qhh">{{ dddata.quhuohao }}</view>
			</view>
		</view>
		<view class="top">
			<view class="text_box">
				<view class="tit">订单编号</view>
				<view class="msg">{{ dddata.out_trade_no }}</view>
			</view>
			<view class="text_box">
				<view class="tit">收货人</view>
				<view class="msg">
					{{ dddata.shouhuoren }}
					<text>{{ dddata.lianxidianhua }}</text>
				</view>
			</view>
			<view class="text_box">
				<view class="tit">收件地址</view>
				<view class="msg">{{ dddata.shouhuodizhi }}</view>
			</view>
		</view>
		<view class="content">
			<view class="inp" v-for="(dd, key) in ndata" :key="key">
				<view class="tit">{{ dd.name }}</view>
				<view class="msg">{{ dd.val }}</view>
			</view>
		</view>
		<view class="qrbtn"  v-if="dddata.tz != 'quxiao'">
			<view class="xx">
				<view><text @click="fh()">返回上一页</text></view>
			</view>
			<view v-if="dddata.paisongtime == '0'">
				<view class="btn" v-if="array.length > 1"><picker @change="bindPickerChange" :value="index" :range="array">已取件</picker></view>
				<view class="btn" @click="qujiandd()" v-else>已取件</view>
			</view>
			<view v-if="dddata.paisongtime != '0' &&  dddata.wanchengtime == '0'">
				<view class="btn" v-if="array.length > 1"><picker @change="bindPickerChange2" :value="index" :range="array">已配送</picker></view>
				<view class="btn" @click="wancle()" v-else>已配送</view>
			</view>
			<view v-if="dddata.wanchengtime != '0'"><view class="btn2">已结束</view></view>
		</view>
	</view>
</template>
<script>
export default {
	data() {
		return {
			ddid: '',
			dddata: '',
			ndata: '',
			array: [],
			index: 0,
			use:""
		};
	},
	onLoad: function(option) {
		this.ddid = option.id;
		if (this.myconfig.isnull(this.ddid)) {
			// uni.switchTab({
			// 	url: '/pages/index/index'
			// });
			uni.showToast({
				title: '未找到订单id',
				icon: 'none',
				duration: 1400
			});
			return;
		} else {
			this.getdd();
		}
	},
	methods: {
		bindPickerChange: function(e) {
			let i = e.target.value;
			this.use = this.array[i]
			this.qujiandd();
		},

		bindPickerChange2: function(e) {
			let i = e.target.value;
			this.use = this.array[i];
			this.wancle();
		},
		fh() {
			uni.switchTab({
				url: '/pages/index/index'
			});
		},
		//取件
		qujiandd() {
			let use = this.use;
			uni.request({
				method: 'POST',
				url: this.myconfig.url + 'index.php/home/mb/qujianle',
				data: {
					id: this.dddata['id'],
					use,
				},
				header: {
					'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
				},
				success: res => {
					let re = res.data;

					if (re.result) {
						uni.showToast({
							title: re.msg,
							duration: 1500
						});
							uni.navigateBack();
					} else {
						uni.showToast({
							title: re.msg,
							duration: 1500
						});
					}
				},
				fail() {
					uni.showToast({
						title: '网络错误',
						icon: 'none',
						duration: 1400
					});
				}
			});
		},
		//完成
		wancle() {
			let use = this.use;
			uni.request({
				method: 'POST',
				url: this.myconfig.url + 'index.php/home/mb/wancl',
				data: {
					id: this.dddata['id'],
					use,
				},
				header: {
					'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
				},
				success: res => {
					let re = res.data;

					if (re.result) {
						uni.showToast({
							title: re.msg,
							duration: 1500
						});
						uni.navigateBack();
					} else {
						uni.showToast({
							title: re.msg,
							duration: 1500
						});
					}
				},
				fail() {
					uni.showToast({
						title: '网络错误',
						icon: 'none',
						duration: 1400
					});
				}
			});
		},
		getdd() {
			uni.request({
				method: 'POST',
				url: this.myconfig.url + 'index.php/home/mb/getdd',
				data: {
					id: this.ddid,
				},
				header: {
					'content-type': 'application/x-www-form-urlencoded;charset=utf-8'
				},
				success: res => {
					let re = res.data;
					if (re.result) {
						if (re.psys) {
							this.psys = re.psys;
							let psy = this.psys;
							for (var i = 0; i < psy.length; i++) {
								this.array.push(psy[i]['name']);
							}
						}
						let content = re.content;
						let arr = [];
						let obj = Object.create({});
						for (let c in content) {
							if (!this.myconfig.isnull(content[c])) {
								if (
									c == 'createtime' ||
									c == 'paisongtime' ||
									c == 'wanchengtime' ||
									c == 'lianxidianhua' ||
									c == 'tz' ||
									c == 'quhuohao' ||
									c == 'id' ||
									c == 'shouhuodizhi' ||
									c == 'shouhuoren' ||
									c == 'out_trade_no'
								) {
									obj[c] = content[c];
								} else {
									// "id",
									//   "shouhuoren",
									//   "shouhuodizhi",
									//   "lianxidianhua",
									//   "quhuohao",
									//   "kuaidigongsi",
									//   "shangloufuwu",
									//   "kuaididaxiao",
									//   "tebiebeizhu",
									//   "quhuodidian",
									//   "huowumingcheng",
									//   "qujianshijian",
									//   "songdashijian",
									//   "out_trade_no";
									let name = '';
									switch (c) {
										case 'kuaidigongsi':
											name = '快递公司';
											break;
										case 'shangloufuwu':
											name = '上楼服务';
											break;
										case 'kuaididaxiao':
											name = '快递大小';
											break;
										case 'tebiebeizhu':
											name = '特别备注';
											break;
										case 'quhuodidian':
											name = '取货地点';
											break;
										case 'huowumingcheng':
											name = '货物名称';
											break;
										case 'qujianshijian':
											name = '取件时间';
											break;
										case 'songdashijian':
											name = '期望送达时间';
											break;
										default:
											name = '其他';
									}
									arr.push({
										name,
										val: content[c]
									});
								}
							}
						}
						this.dddata = obj;
						this.ndata = arr;
					} else {
						uni.showToast({
							title: re.msg,
							icon: 'none',
							duration: 1400
						});
					}
				},
				fail() {
					uni.showToast({
						title: '网络错误',
						icon: 'none',
						duration: 1400
					});
				}
			});
		}
	}
};
</script>
<style lang="scss" scoped>
.top {
	width: 100vw;
	background: white;
	padding-top: 10rpx;
	padding-bottom: 30rpx;
	margin-bottom: 20rpx;
	line-height: 1.5;
	font-size: 32rpx;

	.text_box {
		width: 100vw;
		display: flex;
		margin-top: 10rpx;

		.tit {
			width: 160rpx;
			margin-left: 20rpx;
			color: #696868;
			text-align: justify;
		}
		.qhh {
			flex: 1;
			margin: 0rpx 20rpx;
			color: #474747;
		}
		.msg {
			flex: 1;
			margin-right: 20rpx;
			color: #474747;
		}
	}
}

.content {
	width: 100vw;
	margin: 20rpx 0rpx;
	background: white;
	margin-bottom: 150rpx;

	.inp {
		width: 100vw;
		height: 100rpx;
		background: white;
		border-bottom: 1rpx solid #f0f0f0;
		display: flex;
		line-height: 100rpx;
		font-size: 32rpx;

		.tit {
			margin-left: 20rpx;
			color: #696868;
			margin-right: 20rpx;
		}

		.msg {
			flex: 1;
			text-align: right;
			margin-right: 20rpx;
			height: 100rpx;
			line-height: 100rpx;
			color: #474747;
		}
	}
}

.qrbtn {
	width: 100vw;
	position: fixed;
	bottom: 0rpx;
	height: 90rpx;
	left: 0;
	z-index: 9;
	background: white;
	display: flex;

	.xx {
		flex: 1;

		view {
			padding: 30rpx;
			font-size: 30rpx;
			line-height: 1;
			color: #696868;
			float: left;
			margin-right: 20rpx;

			text {
				text-decoration: underline;
			}
		}
	}

	.btn {
		width: 250rpx;
		color: white;
		font-size: 35rpx;
		background: #ff4800;
		line-height: 90rpx;
		text-align: center;
	}
	.btn2 {
		width: 250rpx;
		color: white;
		font-size: 35rpx;
		background: #2c2c2c;
		line-height: 90rpx;
		text-align: center;
	}
}
</style>
