<template>
  <view>
    <view class="tit_">
      <view>暂不支持在线支付，请将费用支付给送货员，开始派送前可随时取消订单!</view>
    </view>
    <view class="ok_">
      <view class="ico"></view>
      <view class="msg">下单成功！</view>
    </view>
    <view class="btn_box">
      <view @click="linkonce()">再来一单</view>
      <view @click="linkhome()">返回首页</view>
    </view>
  </view>
</template>

<script>
export default {
  methods: {
    linkonce() {
      uni.reLaunch({
        url: "/pages/xiadan/index"
      });
    },
    linkhome() {
      uni.switchTab({
        url: "/pages/index/index"
      });
    }
  }
};
</script>

<style scoped lang="scss">
.tit_ {
  width: 100vw;
  background: #ffeca188;
  view {
    font-size: 28rpx;
    padding: 20rpx;
    color: #555555;
  }
}
.ok_ {
  width: 300rpx;
  margin: 0 auto;
  margin-top: 80rpx;
  display: flex;
  .ico {
    width: 100rpx;
    height: 100rpx;
    background: url(../../static/images/xiadanok.png);
    background-size: 100% 100%;
  }
  .msg {
    flex: 1;
    font-size: 36rpx;
    color: #474747;
    line-height: 100rpx;
    margin-left: 20rpx;
  }
}
.btn_box {
  width: 600rpx;
  margin: 0 auto;
  margin-top: 140rpx;
  display: flex;
  view {
    flex: 1;
    margin: 0 20rpx;
    text-align: center;
    color: #747474;
    font-size: 29rpx;
    height: 68rpx;
    line-height: 68rpx;
    border-radius: 10rpx;
    border: 2rpx dashed #ff507d;
    background: white;
  }
}
</style>
