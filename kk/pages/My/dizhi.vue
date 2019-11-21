<template>
  <view>
    <view class="dizhi_">
      <view class="top">
        <text>周云男</text>
        <text>17600664494</text>
      </view>
      <view class="dizhi">你可以用它收集灵感,保存有用的素材,计划旅行,晒晒自己想要的东西</view>
      <view class="diset">
        <view class="moren"></view>
        <view class="swmr">设为默认</view>
        <view class="bjico"></view>
        <view class="bj">编辑</view>
        <view class="scico"></view>
        <view class="sc">删除</view>
      </view>
    </view>
    <view class="dizhi_">
      <view class="top">
        <text>周云男</text>
        <text>17600664494</text>
      </view>
      <view class="dizhi">你可以用它收集灵感,保存有用的素材,计划旅行,晒晒自己想要的东西</view>
      <view class="diset">
        <view class="active"></view>
        <view class="swmr">设为默认</view>
        <view class="bjico"></view>
        <view class="bj">编辑</view>
        <view class="scico"></view>
        <view class="sc">删除</view>
      </view>
    </view>
    <view class="public_btn" @click="adddizhi()">添加新地址</view>
  </view>
</template>

<script>
export default {
  methods:{
    adddizhi(){
			uni.navigateTo({
				url: '/pages/My/adddizhi'
			});
    }
  }
};
</script>

<style lang="scss" scoped>
.dizhi_ {
  width: 750rpx;
  background: white;
  margin-top: 10rpx;
  .top {
    width: 710rpx;
    line-height: 70rpx;
    margin: 0 auto;
    font-size: 32rpx;
    color: #474747;
    text {
      padding-right: 20rpx;
    }
  }
  .dizhi {
    width: 710rpx;
    line-height: 1.5;
    margin: 0 auto;
    font-size: 28rpx;
    color: #696868;
    border-bottom: 1px solid #f0f0f0;
    padding-bottom: 15rpx;
    text {
      padding-right: 20rpx;
    }
  }
}
.public_btn {
  position: fixed;
  z-index: 9;
  bottom: 80rpx;
  left: 99rpx;
  width: 552rpx;
  text-align: center;
  color: #747474;
  font-size: 29rpx;
  height: 68rpx;
  line-height: 68rpx;
  border-radius: 10rpx;
  border: 2rpx dashed #ff507d;
  background: white;
}
.diset {
  width: calc(100% - 40rpx);
  margin: 0 auto;
  line-height: 70rpx;
  display: flex;
  font-size: 28rpx;
  color: #696868;
  .moren {
    width: 28rpx;
    height:28rpx;
    border-radius: 50%;
    border: 2rpx solid #696868;
    margin-top: 19rpx;
    background-size: 100% 100%;
  }
  .active {
    width: 32rpx;
    height: 32rpx;
    border-radius: 50%;
    margin-top: 20rpx;
    background: url("../../static/images/moren.png");
    background-size: 100% 100%;
  }
  .swmr {
    flex: 1;
    margin-left: 10rpx;
  }
  .bjico {
    width: 30rpx;
    height: 30rpx;
    margin-top: 20rpx;
    background: url("../../static/images/bianji.png");
    background-size: 100% 100%;
  }
  .bj {
    margin-left: 10rpx;
    margin-right: 20rpx;
  }
  .scico {
    margin-right: 10rpx;
    width: 30rpx;
    height: 30rpx;
    margin-top: 20rpx;
    background: url("../../static/images/shanchu.png");
    background-size: 100% 100%;
  }
}
</style>