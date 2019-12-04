<template>
  <view>
    <view class="dz_">
      <view class="inp">
        <view>收货人</view>
        <input value placeholder="请输入收货人姓名" v-model="from.name" placeholder-class="place" />
      </view>
      <view class="inp">
        <view>联系电话</view>
        <input value placeholder="请输入收货人联系电话" v-model="from.phone" placeholder-class="place" />
      </view>
      <view class="tea">
        <view>详细地址</view>
        <textarea placeholder="小区、宿舍楼，若需送上楼请填写门牌号" v-model="from.dizhi" placeholder-class="place"></textarea>
      </view>
    </view>
    <view class="public_btn" @click="add()">保存地址</view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      from: {
        name: "",
        phone: "",
        dizhi: ""
      }
    };
  },
  methods: {
    add() {
      for (let i in this.from) {
        let da = this.from[i];
        if (i == "phone") {
          if (!/^1[3456789]\d{9}$/.test(da)) {
            uni.showToast({
              title: "手机号不符合规则",
              duration: 1500,
              icon: "none",
              position: "top"
            });
            return;
          }
        }
        if (this.myconfig.isnull(da)) {
          uni.showToast({
            title: "都是必填哦",
            duration: 1500,
            icon: "none",
            position: "top"
          });
          return;
        }
      }

      uni.showLoading({
        title: "稍等",
        mask: true
      });
      let { name, phone, dizhi } = this.from;
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdizhi/adddizhi",
        data: {
          name,
          phone,
          dizhi
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.hideLoading();
          if (res.data.result) {
            uni.showToast({
              title: "添加成功",
              duration: 1500,
              icon: "none"
            });
            setTimeout(() => {
              uni.navigateBack();
            }, 1000);
          } else {
            uni.showToast({
              title: "失败",
              duration: 1500,
              icon: "none"
            });
          }
        },
        fail() {
          uni.hideLoading();
          uni.showToast({
            title: "失败",
            duration: 1500,
            icon: "none"
          });
        }
      });
    }
  }
};
</script>
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
  margin: 200rpx auto;
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