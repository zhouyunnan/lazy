<template>
  <view v-if="school_data">
    <view class="top_">
      <view class="school" @click="linkschool_()">{{school_data.schoolname}}</view>
    </view>
    <view class="yysj" v-if="school_data.yingyezt == 'true'">
      <view class="w">接单时间：{{school_data.jiedanshijian}} - {{school_data.guandianshijian}}</view>
    </view>
    <view class="lxdh">
      <view class="w">
        联系电话：
        <text @click="call()">{{school_data.phone}}</text>
      </view>
    </view>
    <view class="gg_">
      <view class="tit">联盟公告</view>
      <view class="msg">{{school_data.gonggao}}</view>
    </view>
    <view v-if="dis" @click="linkxd()">
      <view :class="school_data.yingyezt == 'true'?'xiadan':'xiadan2'">
        <text v-if="school_data.yingyezt == 'true'">立即下单</text>
        <text v-if="school_data.yingyezt == 'false'">休息中</text>
      </view>
    </view>
    <view v-else class="xiadan2">
      <text>休息中</text>
    </view>
  </view>
</template> 
<script>
export default {
  data() {
    return {
      school_id: "",
      school_data: "",
      dis: true,
    };
  },
  onLoad() {},
  onShow() {
    let school_id = uni.getStorageSync("school_id");
    if (this.myconfig.isnull(school_id)) {
      this.linkschool_();
    } else {
      this.school_id = school_id;
    }
  },
  watch: {
    school_id() {
      this.getpaonan();
    },
    school_data() {
      var date = new Date();
      var year = date.getFullYear();
      var month = date.getMonth();
      var day = date.getDate();

      var timestamp3 = Date.parse(new Date());

      if (this.school_data.jiedanshijian != 'undefined') {
        let bengin = this.school_data.jiedanshijian;
        var t = "2017-12-08 20:05:00";
        t = t.replace("2017-12-08", year + "-" + (month + 1) + "-" + day);
        t = t.replace("20:05", bengin);
        var T = new Date(t.replace(/-/g,"/"));

        let end = this.school_data.guandianshijian;
        var tt = "2017-12-08 20:05:00";
        tt = tt.replace("2017-12-08", year + "-" + (month + 1) + "-" + day);
        tt = tt.replace("20:05", end);
        var E = new Date(tt.replace(/-/g,"/"));

        if ((T.getTime() < timestamp3) && (timestamp3 < E.getTime())) {
          this.dis = true;
        } else {
          this.dis = false;
        }
      }
    }
  },
  methods: {
    linkschool_() {
      uni.redirectTo({
        url: "/pages/school/xuanzheschool"
      });
    },
    linkxd() {
      if(this.school_data.yingyezt == 'true'){
         uni.navigateTo({
        url: "/pages/xiadan/index"
      });
      }
    },
    getpaonan() {
      uni.showLoading({
        title: "加载中"
      });
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xrunman/find_byid",
        data: {
          school_id: this.school_id
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.stopPullDownRefresh();
          uni.hideLoading();
          let re = res.data;
          if (re.result) {
            this.school_data = re.content;
          } else {
            this.linkschool_();
          }
        },
        fail() {
          uni.stopPullDownRefresh();
          uni.hideLoading();
        }
      });
    },
    call() {
      uni.makePhoneCall({
        phoneNumber: this.school_data.phone
      });
    }
  },
  onPullDownRefresh() {
    this.getpaonan();
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
  background: radial-gradient(circle at top, #ff507d, #ff81a0, #e90941);
  bottom: 110rpx;
  left: 275rpx;
}
.xiadan2 {
  position: fixed;
  width: 200rpx;
  height: 200rpx;
  border-radius: 50%;
  text-align: center;
  line-height: 200rpx;
  color: white;
  font-size: 34rpx;
  background: radial-gradient(circle at top, #dfdfdf, #a0a0a0, #9c9c9c);
  bottom: 110rpx;
  left: 275rpx;
}
</style>