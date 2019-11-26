<template>
  <view>
    <view class="dizhi_" v-for="(dz,key) in dizhis" :key="key">
      <view class="content">
        <view class="top">
          <text>{{dz.name}}</text>
          <text>{{dz.phone}}</text>
        </view>
        <view class="dizhi">{{dz.dizhi}}</view>
        <view class="diset">
          <view :class="dz.moren == 'true'?'active':'moren'" @click="morensz(dz.id)"></view>
          <view class="swmr" @click="morensz(dz.id)">设为默认</view>
          <!-- <view class="bjico"></view> -->
          <!-- <view class="bj">编辑</view> -->
          <view class="scico"></view>
          <view class="sc" @click="dele(dz.id)">删除</view>
        </view>
      </view>
      <view class="ico" v-if="dis" @click="xd(dz)">
        <view>选定</view>
      </view>
    </view>
    <view class="public_btn" @click="adddizhi()">添加新地址</view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      dizhis: "",
      dis: false
    };
  },
  onLoad() {
    var pages = getCurrentPages();
    var page = pages[pages.length - 2];
    if (page.route == "pages/xiadan/index") {
      this.dis = true;
    }
  },
  onShow() {
    this.select();
  },
  methods: {
    adddizhi() {
      uni.navigateTo({
        url: "/pages/My/adddizhi"
      });
    },
    select() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdizhi/getall",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          this.dizhis = res.data.lists;
        },
        fail() {}
      });
    },
    dele(id) {
      uni.showModal({
        title: "提示",
        content: "确认删除吗？",
        success: res => {
          if (res.confirm) {
            uni.request({
              method: "POST",
              url: this.myconfig.url + "index.php/home/xdizhi/dele",
              data: { id },
              header: {
                "content-type":
                  "application/x-www-form-urlencoded;charset=utf-8",
                Cookie: uni.getStorageSync("sessionid")
              },
              success: res => {
                if (!res.data.result) {
                  uni.showToast({
                    title: res.data.msg,
                    duration: 1500,
                    icon: "none"
                  });
                } else {
                  this.select();
                }
              },
              fail() {}
            });
          } else if (res.cancel) {
            return;
          }
        }
      });
    },
    morensz(id) {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdizhi/moren",
        data: { id },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          if (!res.data.result) {
            uni.showToast({
              title: res.data.msg,
              duration: 1500,
              icon: "none"
            });
          } else {
            uni.showToast({
              title: res.data.msg,
              duration: 1500,
              icon: "none"
            });
            this.select();
          }
        },
        fail() {}
      });
    },
    xd(val) {
      uni.setStorageSync("dizhi", val);
      uni.navigateBack();
    }
  }
};
</script>

<style lang="scss" scoped>
.dizhi_ {
  width: 750rpx;
  background: white;
  margin-top: 10rpx;
  display: flex;
  .content {
    flex: 1;
    margin: 0 10rpx 0 20rpx;
  }
  .ico {
    margin: 0 20rpx 0 10rpx;
    color: #ff507d;
    position: relative;
    width: 80rpx;
    font-size: 28rpx;
    view {
      width: 80rpx;
      text-align: center;
      position: absolute;
      top: 50%;
      transform: translateY(-50%); 
      border-left: 1px solid #ff507d;
    }
  }
  .top {
    width: 100%;
    line-height: 70rpx;
    margin: 0 auto;
    font-size: 32rpx;
    color: #474747;
    text {
      padding-right: 20rpx;
    }
  }
  .dizhi {
    width: 100%;
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
    height: 28rpx;
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