<template>
	<view class="welcome_">
		<view class="wz"></view>
		<view class="wz2"></view>
		<view class="wz3"></view>
		<view class="paonan"></view>
	</view>
</template>

<script>
export default {
	data() {
		return {};
	},
	methods: {}
};
</script>

<style scoped lang="scss">
.posi_ {
	position: absolute;
	left: 50%;
	transform: translateX(-50%);
}
.welcome_ {
	position: relative;
	width: 100vw;
	height: 100vh;
	background: #4d9bea;
}
@mixin imgpos($w, $h, $url) {
	@extend .posi_;
	background: $url;
	background-size: 100% 100%;
	width: $w;
	height: $h;
}
.wz {
	@include imgpos(491rpx, 241rpx, url(../../static/images/gaoxiaosh.png));
}
.wz2 {
	@include imgpos(445rpx, 43rpx, url(../../static/images/sange_07.png));
	bottom: 230rpx;
}
.wz3 {
	@include imgpos(424rpx, 77rpx, url(../../static/images/lahz_11.png));
}
.paonan{
	@include imgpos(750rpx, 443rpx, url(../../static/images/runnan_14.png));
	bottom: 0px;
}
</style>
