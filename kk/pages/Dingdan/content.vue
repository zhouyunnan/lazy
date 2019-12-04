<template>
  <view v-if="dddata" style="margin-bottom:150rpx">
    <view class="top" v-if="dddata.quhuohao != undefined">
      <view class="text_box">
        <view class="qhh">{{dddata.quhuohao}}</view>
      </view>
    </view>
    <view class="top">
      <view class="text_box">
        <view class="tit">订单编号</view>
        <view class="msg">{{dddata.out_trade_no}}</view>
      </view>
      <view class="text_box">
        <view class="tit">收货人</view>
        <view class="msg">
          {{dddata.shouhuoren}}
          <text>{{dddata.lianxidianhua}}</text>
        </view>
      </view>
      <view class="text_box">
        <view class="tit">收件地址</view>
        <view class="msg">{{dddata.shouhuodizhi}}</view>
      </view>
    </view>
    <view class="content">
      <view class="inp" v-for="(dd,key) in ndata" :key="key">
        <view class="tit">{{dd.name}}</view>
        <view class="msg">{{dd.val}}</view>
      </view>
    </view>
    <view class="qrbtn" v-if="dddata.wanchengtime == '0' || dddata.wanchengtime == undefined">
      <view class="xx">
        <view @click="quxiao()" v-if="dddata.tz == 'true'">
          <text>取消订单</text>
        </view>
        <view v-if="dddata.tz == 'quxiao'">
          <text>已取消</text>
        </view>
      </view>
    </view>
    <message ref="Message"></message>
  </view>
</template>
<script>
import boboMessage from "@/components/bobo-message/bobo-message.vue";
export default {
  data() {
    return {
      ddid: "",
      dddata: "",
      ndata: ""
    };
  },
  components: {
    message: boboMessage
  },
  onLoad: function(option) {
    this.ddid = option.id;
    if (this.myconfig.isnull(this.ddid)) {
      uni.switchTab({
        url: "/pages/index/index"
      });
    } else {
      this.getdd();
    }
  },
  methods: {
    getdd() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/Xxiadan/getdd",
        data: {
          id: this.ddid
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          let re = res.data;
          if (re.result) {
            let content = re.content;
            let arr = [];
            let obj = Object.create({});
            for (let c in content) {
              if (!this.myconfig.isnull(content[c])) {
                if (
                  c == "createtime" ||
                  c == "paisongtime" ||
                  c == "wanchengtime" ||
                  c == "lianxidianhua" ||
                  c == "tz" ||
                  c == "quhuohao" ||
                  c == "id" ||
                  c == "shouhuodizhi" ||
                  c == "shouhuoren" ||
                  c == "out_trade_no"
                ) {
                  obj[c] = content[c];
                } else {
                  // "id",
                  //   "shouhuoren",
                  //   "shouhuodizhi",
                  //   "lianxidianhua",
                  //   "quhuohao",
                  //   "kuaidigongsi",
                  //   "shangloufuwu",
                  //   "kuaididaxiao",
                  //   "tebiebeizhu",
                  //   "quhuodidian",
                  //   "huowumingcheng",
                  //   "qujianshijian",
                  //   "songdashijian",
                  //   "out_trade_no";
                  let name = "";
                  switch (c) {
                    case "kuaidigongsi":
                      name = "快递公司";
                      break;
                    case "shangloufuwu":
                      name = "上楼服务";
                      break;
                    case "kuaididaxiao":
                      name = "快递大小";
                      break;
                    case "tebiebeizhu":
                      name = "特别备注";
                      break;
                    case "quhuodidian":
                      name = "取货地点";
                      break;
                    case "huowumingcheng":
                      name = "货物名称";
                      break;
                    case "qujianshijian":
                      name = "取件时间";
                      break;
                    case "songdashijian":
                      name = "期望送达时间";
                      break;
                    default:
                      name = "其他";
                  }
                  arr.push({
                    name,
                    val: content[c]
                  });
                }
              }
            }
            this.dddata = obj;
            this.ndata = arr;
          } else {
            uni.showToast({
              title: re.msg,
              icon: "none",
              duration: 1400
            });
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
    quxiao() {
      let dd = this.dddata;
      if (dd.paisongtime !== "0") {
        this.$refs["Message"].warn("在派送中的订单不能取消");
      } else {
        let thiz = this;
        uni.showModal({
          title: "提示",
          content: "确认取消订单?",
          success: function(res) {
            if (res.confirm) {
              uni.request({
                method: "POST",
                url: thiz.myconfig.url + "index.php/home/Xxiadan/quxiaodd",
                data: {
                  id: thiz.ddid
                },
                header: {
                  "content-type":
                    "application/x-www-form-urlencoded;charset=utf-8",
                  Cookie: uni.getStorageSync("sessionid")
                },
                success: res => {
                  let re = res.data;
                  if (re.result) {
                    thiz.$refs["Message"].warn("取消成功！");
                    thiz.getdd();
                  } else {
                    thiz.$refs["Message"].warn("取消失败");
                  }
                },
                fail() {}
              });
            } else if (res.cancel) {
              return;
            }
          }
        });
      }
    }
  }
};
</script>
<style lang="scss" scoped>
.top {
  width: 100vw;
  background: white;
  padding-top: 10rpx;
  padding-bottom: 30rpx;
  margin-bottom: 20rpx;
  line-height: 1.5;
  font-size: 32rpx;

  .text_box {
    width: 100vw;
    display: flex;
    margin-top: 10rpx;

    .tit {
      width: 160rpx;
      margin-left: 20rpx;
      color: #696868;
      text-align: justify;
    }
    .qhh {
      flex: 1;
      margin: 0rpx 20rpx;
      color: #474747;
    }
    .msg {
      flex: 1;
      margin-right: 20rpx;
      color: #474747;
    }
  }
}

.content {
  width: 100vw;
  margin: 20rpx 0rpx;
  background: white;
  margin-bottom: 150rpx;

  .inp {
    width: 100vw;
    height: 100rpx;
    background: white;
    border-bottom: 1rpx solid #f0f0f0;
    display: flex;
    line-height: 100rpx;
    font-size: 32rpx;

    .tit {
      margin-left: 20rpx;
      color: #696868;
      margin-right: 20rpx;
    }

    .msg {
      flex: 1;
      text-align: right;
      margin-right: 20rpx;
      height: 100rpx;
      line-height: 100rpx;
      color: #474747;
    }
  }
}

.qrbtn {
  width: 100vw;
  position: fixed;
  bottom: 0rpx;
  height: 90rpx;
  left: 0;
  z-index: 9;
  background: white;
  display: flex;

  .xx {
    flex: 1;

    view {
      padding: 30rpx;
      font-size: 30rpx;
      line-height: 1;
      color: #696868;
      float: right;
      margin-right: 20rpx;

      text {
        text-decoration: underline;
      }
    }
  }

  .btn {
    width: 200rpx;
    color: white;
    font-size: 35rpx;
    background: #ff507d;
    line-height: 90rpx;
    text-align: center;
  }
}
</style>
