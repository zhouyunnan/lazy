<template>
  <view>
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
    <view class="xiadan">
      <text>立即下单</text>
    </view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      school_id: "",
      school_data:""
    };
  },
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
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xrunman/find_byid",
        data: {
          school_id:this.school_id
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
         let re = res.data;
         if(re.result){
            this.school_data = re.content;
         }else{
            this.linkschool_();
         }
        }
      });
    }
  },
  methods: {
    linkschool_() {
      uni.navigateTo({
        url: "/pages/school/xuanzheschool"
      });
    },
    call() {
      uni.makePhoneCall({
        phoneNumber: this.school_data.phone
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