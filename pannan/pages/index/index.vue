<template>
  <view>
    <view class="type_">
      <view class="box" @click="changedis(0)">
        <view class="msg" :class="{boddr:nodis == 0}">待取件</view>
      </view>
      <view class="box" @click="changedis(1)">
        <view class="msg" :class="{boddr:nodis == 1}">待配送</view>
      </view>
      <view class="box" @click="changedis(2)">
        <view class="msg" :class="{boddr:nodis == 2}">已完成</view>
      </view>
    </view>
    <view class="dd_">
      <view v-show="nodis == 0">
        <view class="box_" v-for="(dq,key) in dqj"  @click="linkxq(dq.id)" :key="key">
          <view class="main_">
            <view class="t_" v-if="dq.tz == 'quxiao'">
              <view class="time"  style="color:red;">订单已取消</view>
            </view>
            <view class="t_">
              <view class="num">{{dq.num}}</view>
              <view class="time">{{time(dq.createtime)}}</view>
            </view>

            <view class="xq_">
              <view class="name">收件人</view>
              <view class="msg">{{dq.shouhuoren}}</view>
            </view>
            <view class="xq_">
              <view class="name">联系电话</view>
              <view class="msg phone">
                <text @click.stop="boda(dq.lianxidianhua)">{{dq.lianxidianhua}}</text>
              </view>
            </view>
            <view class="addres">{{dq.shouhuodizhi}}</view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 1">
        <view class="box_" v-for="(dp,key) in dps" @click="linkxq(dp.id)" :key="key">
          <view class="main_">
            <view class="t_">
              <view class="num">{{dp.num}}</view>
              <view class="time">{{time(dp.createtime)}}</view>
            </view>

            <view class="xq_">
              <view class="name">收件人</view>
              <view class="msg">{{dp.shouhuoren}}</view>
            </view>
            <view class="xq_">
              <view class="name">联系电话</view>
              <view class="msg phone">
                <text @click.stop="boda(dp.lianxidianhua)">{{dp.lianxidianhua}}</text>
              </view>
            </view>
            <view class="addres">{{dp.shouhuodizhi}}</view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 2">
        <view class="box_" v-for="(yw,key) in ywc"  @click="linkxq(yw.id)" :key="key">
          <view class="main_">
            <view class="t_">
              <view class="num">{{yw.num}}</view>
              <view class="time">{{time(yw.createtime)}}</view>
            </view>

            <view class="xq_">
              <view class="name">收件人</view>
              <view class="msg">{{yw.shouhuoren}}</view>
            </view>
            <view class="xq_">
              <view class="name">联系电话</view>
              <view class="msg phone">
                <text @click.stop="boda(yw.lianxidianhua)">{{yw.lianxidianhua}}</text>
              </view>
            </view>
            <view class="addres">{{yw.shouhuodizhi}}</view>
          </view>
        </view>
      </view>
    </view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      nodis: 0,
      dqj: "",
      dps: "",
      ywc: "",
      user: "",
      pas: ""
    };
  },
  onLoad(op) {
    this.user = op.u;
    this.pas = op.p;
    this.getdqj();
  },
  watch: {
    nodis() {
      uni.pageScrollTo({
        scrollTop: 0,
        duration: 300
      });
      let n = this.nodis;
      if (n == "0") {
        this.getdqj();
      }

      if (n == "1") {
        this.getdps();
      }

      if (n == "2") {
        this.getywc();
      }
    }
  },
  methods: {
    getdqj() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/jrdqj",
        data: {
          user: this.user,
          pas: this.pas,
          type: "dqj"
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          uni.stopPullDownRefresh();
          if (!res.data.result) {
            uni.showToast({
              title: res.data.msg,
              duration: 2000,
              icon: "none"
            });
          } else {
            this.dqj = res.data.lists;
          }
        }
      });
    },
    getdps() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/jrdqj",
        data: {
          user: this.user,
          pas: this.pas,
          type: "dps"
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          uni.stopPullDownRefresh();
          if (!res.data.result) {
            uni.showToast({
              title: res.data.msg,
              duration: 2000,
              icon: "none"
            });
          } else {
            this.dps = res.data.lists;
          }
        }
      });
    },
    getywc() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/mb/jrdqj",
        data: {
          user: this.user,
          pas: this.pas,
          type: "ywc"
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8"
        },
        success: res => {
          uni.stopPullDownRefresh();
          if (!res.data.result) {
            uni.showToast({
              title: res.data.msg,
              duration: 2000,
              icon: "none"
            });
          } else {
            this.ywc = res.data.lists;
          }
        }
      });
    },
    boda(val) {
      uni.makePhoneCall({
        phoneNumber: val //仅为示例
      });
      return;
    },
    linkxq(id) {
      uni.navigateTo({
        url: "/pages/index/xq?id=" + id
      });
    },
    time(val, n) {
      var time = new Date(parseInt(val) * 1000);
      var y = time.getFullYear(); //getFullYear方法以四位数字返回年份
      var M = time.getMonth() + 1; // getMonth方法从 Date 对象返回月份 (0 ~ 11)，返回结果需要手动加一
      var d = time.getDate(); // getDate方法从 Date 对象返回一个月中的某一天 (1 ~ 31)
      var h = time.getHours(); // getHours方法返回 Date 对象的小时 (0 ~ 23)
      var m = time.getMinutes(); // getMinutes方法返回 Date 对象的分钟 (0 ~ 59)
      var s = time.getSeconds(); // getSeconds方法返回 Date 对象的秒数 (0 ~ 59)
      if (n == "1") {
        return y + "-" + M + "-" + d + " " + h + ":" + m;
      } else {
        return M + "-" + d + " " + h + ":" + m;
      }
    },
    changedis(val) {
      this.nodis = val;
    }
  },
  onPullDownRefresh() {
    if (this.nodis == "0") {
    }
    if (this.nodis == "1") {
    }
    if (this.nodis == "2") {
    }
  }
};
</script>
<style lang="scss" scoped>
.phone {
  color: rgb(39, 39, 248);
  font-weight: bold;
}
.box_ {
  width: 100vw;
  background: white;
  .main_ {
    position: relative;
    width: 710rpx;
    padding: 20rpx;
    font-size: 30rpx;
    color: #474747;
    margin-bottom: 20rpx;
    .t_ {
      display: flex;
      margin-bottom: 30rpx;
      line-height: 50rpx;
      .num {
        font-size: 32rpx;
        color: #202020;
        border: 1rpx solid #757575;
        height: 50rpx;
        padding: 0 10rpx;
        border-radius: 10rpx;
      }
      .time {
        flex: 1;
        text-align: right;
        color: #757575;
      }
    }
    .xq_ {
      margin-bottom: 15rpx;
      display: flex;
      .name {
      }
      .msg {
        flex: 1;
        text-align: right;
      }
    }
    .addres {
      border-top: 1rpx solid #c4c4c4;
      line-height: 2;
    }
  }
}

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
.type_ {
  position: fixed;
  top: 0px;
  left: 0px;
  z-index: 9;
  width: 100vw;
  height: 90rpx;
  background: white;
  display: flex;
  .box {
    flex: 1;
    position: relative;
    .msg {
      position: absolute;
      bottom: 0rpx;
      left: 50%;
      height: 70rpx;
      line-height: 70rpx;
      font-size: 32rpx;
      transform: translateX(-50%);
      color: #696868;
    }
    .boddr {
      border-bottom: 4rpx solid #474747;
      color: #474747;
    }
  }
}
.dd_ {
  margin-top: 110rpx;
  margin-bottom: 200rpx;
}
.loading {
  font-size: 28rpx;
  color: #818181;
  text-align: center;
  width: 100vw;
  line-height: 60rpx;
  padding: 60rpx 0rpx;
}
</style>