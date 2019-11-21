<template>
  <view>
    <view class="top_">
      <view class="school" @click="linkschool_()">海南热带海洋学院</view>
    </view>
    <view class="yysj">
      <view class="w">接单时间：08.00 - 12.30</view>
    </view>
    <view class="lxdh">
      <view class="w">
        联系电话：
        <text @click="call()">17600664494</text>
      </view>
    </view>
    <view class="gg_">
      <view class="tit">联盟公示</view>
      <view class="msg">
        abbar 的默认高度，在不同平台不一样。App端的默view
        认高度在HBuilderX 2.3.4起从56px调整为50px，与H5端统
        一。开发者也可以自行设定高度，调回56px
      </view>
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
    },
    call() {
      uni.makePhoneCall({
        phoneNumber: "17600664494" //仅为示例
      });
    }
  }
};
</script>

<style lang="scss" scoped>
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
.yysj,
.lxdh {
  @include w_;
  .w {
    background: white;
    line-height: 60rpx;
    font-size: 32rpx;
    border-radius: 10rpx;
    margin-top: 20rpx;
    text-indent: 10rpx;
  }
  text {
    color: rgb(2, 91, 163);
  }
}

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
.gg_ {
  width: 710rpx;
  margin: 20rpx auto;
  min-height: 200rpx;
  background: white;
  border-radius: 10rpx;
  font-size: 32rpx;
  color: #474747;
  .tit {
    width: calc(100% - 20rpx);
    margin: 20rpx auto;
    float: left;
    text-align: center;
  }
  .msg {
    width: calc(100% - 20rpx);
    margin: 0 auto;
    padding-bottom: 30rpx;
    line-height: 1.5;
    text-align: justify;
    color: #696868;
  }
}
.xiadan {
  position: fixed;
  width: 200rpx;
  height: 200rpx;
  border-radius: 50%;
  text-align: center;
  line-height: 200rpx;
  color: white;
  font-size: 34rpx;
  background: radial-gradient(circle at center, #ff507d, #ffffff);
  background: radial-gradient(circle at top, #ff507d, #ff81a0, #e90941);
  bottom: 150rpx;
  left: 275rpx;
}
</style>