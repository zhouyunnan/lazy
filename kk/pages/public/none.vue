<template>
  <view>
    <view class="img"></view>
    <view class="msg">啥也没有</view>
  </view>
</template>
<script>
export default {};
</script>


<style lang="scss" scoped>
    .img{
      background: url('../../static/images/none.png');
      width: 120rpx;
      height: 120rpx;
      background-size: 100% 100%;
      margin: 0 auto;
      margin-top: 240rpx;
    }
    .msg{
        width: 100vw;
        height: 30rpx;
        font-size: 30rpx;
        color: #6d6d6d;
        text-align: center;
        margin-top: 20rpx;
        
    }
</style>