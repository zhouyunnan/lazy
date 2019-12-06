<template>
  <view>
    <view class="main_">
      <view class="name">{{school}}</view>
      <textarea placeholder="请输入店铺公告" :value="gonggao" @blur="bindTextAreaBlur" />
      <view class="btn" @click="genggaigg()">更改</view>
    </view>
    <view>
      <view class="xiadan" v-if="yingyezt=='true'" @click="xieye()">营业中</view>
      <view class="xiadan2" v-if="yingyezt=='false'" @click="kaiyeme()">歇业中</view>
    </view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      gonggao: "",
      yingyezt: "true",
      //   user: "admin",
      //   pas: "e10adc3949ba59abbe56e057f20f883e",
      school: "",
      ggval: ""
    };
  },
  onLoad() {
    this.getschool();
  },
  methods: {
    xieye() {
      let thiz = this;
      uni.showModal({
        title: "",
        content: "切换为停止接单？",
        success: function(res) {
          if (res.confirm) {
            thiz.guanmen();
          } else if (res.cancel) {
            return;
          }
        }
      });
    },
    kaiyeme() {
      let thiz = this;
      uni.showModal({
        title: "",
        content: "需要开始接单吗？",
        success: function(res) {
          if (res.confirm) {
            thiz.kaiye();
          } else if (res.cancel) {
            return;
          }
        }
      });
    },
    bindTextAreaBlur: function(e) {
      this.ggval = e.detail.value;
    },
    getschool() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/getpaonan",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          let re = res.data;
          if (!re.result) {
            uni.showToast({
              title: re.msg,
              icon: "none",
              duration: 1400
            });
          } else {
            let cc = re.content;
            this.yingyezt = cc.yingyezt;
            this.gonggao = cc.gonggao;
            this.school = cc.schoolname;
          }
        },
        fail() {
          uni.showToast({
            title: "网络错误",
            icon: "none",
            duration: 1400
          });
        }
      });
    },
    genggaigg() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/changegg",
        data: {
          gonggao: this.ggval
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          if (res.data.result) {
            uni.showToast({
              title: "更改成功",
              icon: "none",
              duration: 1400
            });
          } else {
            uni.showToast({
              title: "更改失败",
              icon: "none",
              duration: 1400
            });
          }
          this.getschool();
        },
        fail() {
          uni.showToast({
            title: "网络错误",
            icon: "none",
            duration: 1400
          });
        }
      });
    },

    kaiye() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/kaiye",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          if (res.data.result) {
            uni.showToast({
              title: "更改成功",
              icon: "none",
              duration: 1400
            });
          } else {
            uni.showToast({
              title: "更改失败",
              icon: "none",
              duration: 1400
            });
          }
          this.getschool();
        },
        fail() {
          uni.showToast({
            title: "网络错误",
            icon: "none",
            duration: 1400
          });
        }
      });
    },
    guanmen() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/guanmen",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          if (res.data.result) {
            uni.showToast({
              title: "更改成功",
              icon: "none",
              duration: 1400
            });
          } else {
            uni.showToast({
              title: "更改失败",
              icon: "none",
              duration: 1400
            });
          }
          this.getschool();
        },
        fail() {
          uni.showToast({
            title: "网络错误",
            icon: "none",
            duration: 1400
          });
        }
      });
    }
  }
};
</script>    

<style lang="scss" scoped>
.main_ {
  padding-top: 10rpx;
  .name {
    padding: 20rpx;
    font-size: 30rpx;
    color: #474747;
  }
}
textarea {
  width: 552rpx;
  border: 1rpx solid #ff507d;
  margin: 0 auto;
  margin-top: 40rpx;
  font-size: 30rpx;
  color: #474747;
  padding: 10rpx;
}
.btn {
  margin: 40rpx auto !important;
  width: 552rpx;
  text-align: center;
  color: white;
  font-size: 29rpx;
  height: 68rpx;
  line-height: 68rpx;
  border-radius: 10rpx;
  background: #ff507d;
}
.main_ {
  width: 100vw;
  padding-bottom: 40rpx;
  background: white;
}
.xiadan {
  width: 200rpx;
  height: 200rpx;
  border-radius: 50%;
  text-align: center;
  line-height: 200rpx;
  color: white;
  font-size: 34rpx;
  background: radial-gradient(circle at top, #ff507d, #ff81a0, #e90941);
  margin: 0 auto;
  margin-top: 40rpx;
}
.xiadan2 {
  width: 200rpx;
  height: 200rpx;
  border-radius: 50%;
  text-align: center;
  line-height: 200rpx;
  color: white;
  font-size: 34rpx;
  margin: 0 auto;
  background: radial-gradient(circle at top, #929292, #a0a0a0, #9c9c9c);
  margin-top: 40rpx;
}
</style>