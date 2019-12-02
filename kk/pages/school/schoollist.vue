<template>
  <view>
    <view class="school_" v-for="(sc,key) in scs" :key="key" @click="qrschool(sc.id)">
      <view class="w">
        <view class="box_">
          <view>{{sc.schoolname}}</view>
          <view></view>
        </view>
      </view>
    </view>
    <view class="msg_">
      <text>所在学校没开通 ?</text>
      <text @click="linkpn()">加入联盟</text>
    </view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      scs: ""
    };
  },
  onLoad() {
    this.getscs();
  },
  methods: {
    getscs() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xlogin/getschool_s",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          let re = res.data;
          this.scs = re.lists;
        }
      });
    },
    linkpn() {
      uni.navigateTo({
        url:
          "/pages/Web/Web?url=" +
          encodeURIComponent(
            "https://mp.weixin.qq.com/s?__biz=MzI4MTYwNjE0Nw==&mid=100000342&idx=1&sn=0bfe2515f38847d001a4749e895b0a3e&scene=19#wechat_redirect"
          )
      });
    },
    qrschool(val) {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xlogin/save_school",
        data: {
          school_id: val
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.setStorageSync("school_id", val);
          uni.switchTab({
            url: "/pages/index/index"
          });
        }
      });
    }
  }
};
</script>

<style scoped lang="scss">
@mixin w_ {
  width: 750rpx;
  display: flex;

  .w {
    flex: 1;
  }

  font-size: 32rpx !important;
  color: #474747;
}
.school_ {
  @include w_;

  .w {
    height: 100rpx;
    background: white;

    .box_ {
      width: calc(100% - 30rpx);
      height: calc(100% - 1rpx);
      margin: 0 auto;
      border-bottom: 1rpx solid #e4e7ed;
      display: flex;
      line-height: 100rpx;

      view:first-child {
        flex: 1;
      }

      view:last-child {
        width: 50rpx;
        height: 50rpx;
        background: url(../../static/images/more.png);
        background-size: 100%;
        margin-top: 25rpx;
      }
    }
  }
}
.msg_ {
  font-size: 30rpx;
  color: #808080;
  width: 100%;
  text-align: center;
  padding: 50rpx 0rpx;

  text:last-child {
    color: rgb(25, 88, 156);
    margin-left: 10rpx;
  }
}
</style>
