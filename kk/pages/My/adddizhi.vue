<template>
  <view>
    <view class="dz_">
      <view class="inp">
        <view>收货人</view>
        <input value placeholder="请输入收货人姓名" placeholder-class="place" />
      </view>
      <view class="inp">
        <view>联系电话</view>
        <input value placeholder="请输入收货人联系电话" placeholder-class="place" />
      </view>
      <view class="tea">
        <view>详细地址</view>
        <textarea placeholder="小区、宿舍楼，若需送上楼请填写门牌号" placeholder-class="place"></textarea>
      </view>
    </view>
    <view class="public_btn">保存地址</view>
  </view>
</template>
<style lang="scss" scoped>
.dz_ {
  width: 100vw;
  min-height: 400rpx;
  background: white;
}
.place {
  font-size: 32rpx;
}
.inp {
  width: 710rpx;
  margin: 0 auto;
  line-height: 80rpx;
  height: 80rpx;
  padding: 10rpx 0;
  display: flex;
  border-bottom: 1px solid #f0f0f0;
  view {
    width: 150rpx;
    margin-right: 12rpx;
    font-size: 32rpx;
    color: #696868;
  }
  input {
    flex: 1;
    height: 80rpx;
    line-height: 80rpx;
    font-size: 32rpx;
    color: #474747;
  }
}
.tea {
  width: 710rpx;
  margin: 0 auto;
  line-height: 1;
  height: 200rpx;
  padding: 10rpx 0;
  display: flex;
  border-bottom: 1px solid #f0f0f0;
  padding-bottom: 50rpx;
  margin-top: 24rpx;
  view {
    width: 150rpx;
    margin-right: 6rpx;
    font-size: 32rpx;
    color: #696868;
    line-height: 1;
  }
  textarea {
    flex: 1;
    font-size: 32rpx;
    color: #474747;
    height: 150rpx;
    line-height: 1;
    margin-top: -20rpx;
  }
}
.public_btn {
  margin: 40rpx auto;
  bottom: 80rpx;
  left: 99rpx;
  width: 552rpx;
  text-align: center;
  color: #ffffff;
  font-size: 29rpx;
  height: 68rpx;
  line-height: 68rpx;
  border-radius: 10rpx;
  background: #ff507d;
}
</style>