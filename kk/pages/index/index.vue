<template>
  <view>
    <view class="top_">
      <view class="school" @click="linkschool_()">海南热带海洋学院</view>
    </view>
    <view class="gg_">
      <view>公告</view>
      <text>abbar 的默认高度，在不同平台不一样。App端的默认高度在HBuilderX 2.3.4起从56px调整为50px，与H5端统一。开发者也可以自行设定高度，调回56px</text>
    </view>
    <view class="xiadan">
      <text>立即下单</text>
    </view>
  </view>
</template>
<script>
export default {
  methods: {
    linkschool_() {
      uni.navigateTo({
        url: "/pages/school/xuanzheschool"
      });
    }
  }
};
</script>

<style lang="scss" scoped>
.top_ {
  width: 750rpx;
  background: white;
  padding: 20rpx 0;
  .school {
    position: relative;
    margin-left: 20rpx;
    background: url("../../static/images/address.png") no-repeat;
    background-size: 32rpx 32rpx;
    font-size: 32rpx;
    color: #5c5c5c;
    text-indent: 40rpx;
    line-height: 32rpx;
    height: 32rpx;
    &::after {
      position: absolute;
      content: "";
      background: url("../../static/images/r.png") no-repeat;
      background-size: 30rpx 30rpx;
      width: 30rpx;
      height: 30rpx;
      top: 50%;
      margin-top: -15rpx;
      margin-left: 5rpx;
      opacity: 0.7;
    }
  }
}
.gg_{
    width: 710rpx;
    margin: 20rpx auto;
    min-height: 200rpx;
    background: white;
    border-radius: 10rpx;
    font-size: 32rpx;
    color: #474747;
    view{
      width: calc(100% - 20rpx);
      margin: 20rpx auto;
      float: left;
      text-align: center
    }
    text{
      width: calc(100% - 20rpx);
      margin: 0 auto;
    }
}
.xiadan {
  width: 200rpx;
  height: 200rpx;
  border-radius: 50%;
  text-align: center;
  line-height: 200rpx;
  color: white;
  font-size: 34rpx;
  background: #ff507d;
  margin: 0 auto;
  margin-top: 40rpx;
}
</style>