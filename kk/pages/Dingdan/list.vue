<template>
  <view>
    <view class="type_">
      <view class="box" @click="changedis(0)">
        <view class="msg" :class="{boddr:nodis == 0}">待配送</view>
      </view>
      <view class="box" @click="changedis(1)">
        <view class="msg" :class="{boddr:nodis == 1}">派送中</view>
      </view>
      <view class="box" @click="changedis(2)">
        <view class="msg" :class="{boddr:nodis == 2}">已完成</view>
      </view>
    </view>
    <view class="dd_">
      <view v-show="nodis == 0">
        <view v-if="wps == undefined">
          <None></None>
        </view>
        <view>
          <view class="box_" v-for="(wp,key) in wps" :key="key">
            <view class="w" @click="linkxq(wp.id)">
              <view class="tt">
                <view class="fle" style="opacity:1">
                  <view class="time">{{time(wp.createtime,1)}}</view>
                  <view class="zt1">已接单</view>
                </view>
              </view>
              <view class="dizhi">{{wp.shouhuodizhi}}</view>
              <view class="content" v-if="wp.quhuohao">{{wp.quhuohao}}</view>
            </view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 1">
        <view v-if="psz == undefined">
          <None></None>
        </view>
        <view>
          <view class="box_" v-for="(ps,key) in psz" :key="key">
            <view class="w"  @click="linkxq(ps.id)">
              <view class="tt">
                <view class="fle" style="opacity:0.5">
                  <view class="time">{{time(ps.createtime,1)}}</view>
                  <view class="zt1">已接单</view>
                </view>
                <view class="fle" style="opacity:1">
                  <view class="time">{{time(ps.paisongtime,2)}}</view>
                  <view class="zt2">派送中</view>
                </view>
              </view>
              <view class="dizhi">{{ps.shouhuodizhi}}</view>
              <view class="content" v-if="ps.quhuohao">{{ps.quhuohao}}</view>
            </view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 2">
        <view v-if="wcdds == undefined">
          <None></None>
        </view>
        <view v-else>
          <view class="box_" v-for="(ddwz,key) in wcdds" :key="key">
            <view class="w"  @click="linkxq(ddwz.id)">
              <view class="tt">
                <view class="fle" style="opacity:0.3">
                  <view class="time">{{time(ddwz.createtime,1)}}</view>
                  <view class="zt1">已接单</view>
                </view>
                <view class="fle" style="opacity:0.5">
                  <view class="time">{{time(ddwz.paisongtime,2)}}</view>
                  <view class="zt2">派送中</view>
                </view>
                <view class="fle" style="opacity:1">
                  <view class="time">{{time(ddwz.wanchengtime,2)}}</view>
                  <view class="zt3">已完成</view>
                </view>
              </view>
              <view class="dizhi">{{ddwz.shouhuodizhi}}</view>
              <view class="content" v-if="ddwz.quhuohao">{{ddwz.quhuohao}}</view>
            </view>
          </view>
        </view>
        <view class="loading" v-if="wcdds.length>pagesize">{{loading}}</view>
      </view>
    </view>
  </view>
</template>
<script>
import None from "../public/none.vue";

export default {
  components: {
    None
  },
  data() {
    return {
      nodis: 0,
      loading: "上拉加载更多...",
      p: 1,
      wcdds: "",
      wps: "",
      pagesize: 10,
      haiyouma: true,
      psz: ""
    };
  },
  onLoad() {
    this.getwps();
  },
  watch: {
    nodis() {
      uni.pageScrollTo({
        scrollTop: 0,
        duration: 300
      });
      let n = this.nodis;

      if (n == "0" && this.wps == "") {
        this.getwps();
      }

      if (n == "1" && this.psz == "") {
        this.getpsz();
      }

      if (n == "2" && this.p == 1) {
        this.getwc();
      }
    }
  },
  methods: {
    linkxq(id) {
      uni.navigateTo({
        url: "/pages/Dingdan/content?id=" + id
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
    },
    getwc() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdingdan/wancdd",
        data: {
          p: this.p,
          pagesize: this.pagesize
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          let re = res.data;
          uni.stopPullDownRefresh();
          if (re.result) {
            this.p++;
            if (this.wcdds == "") {
              this.wcdds = re.lists;
            } else {
              let narr = this.wcdds;
              this.wcdds = narr.concat(re.lists);
            }
          } else {
            this.loading = "没有了";
            this.haiyouma = false;
          }
          if (this.wcdds == "") {
            this.wcdds = null;
          }
        }
      });
    },
    getwps() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdingdan/getdd",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.stopPullDownRefresh();
          this.wps = res.data.lists;
        }
      });
    },
    getpsz() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdingdan/peisongz",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.stopPullDownRefresh();
          this.psz = res.data.lists;
        }
      });
    }
  },
  onPullDownRefresh() {
    if (this.nodis == "0") {
      this.wps = "";
      this.getwps();
    }
    if (this.nodis == "1") {
      this.psz = "";
      this.getpsz();
    }
    if (this.nodis == "2") {
      this.p = 1;
      this.wcdds = "";
      this.haiyouma = true;
      this.getwc();
    }
  },
  onReachBottom() {
    if (this.haiyouma && this.nodis == "2") {
      this.loading = "加载中...";
      this.getwc();
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
  .box_ {
    @include w_;
    margin-top: 20rpx;
    .w {
      background: white;
      border-radius: 10rpx;
      .tt {
        width: calc(100% - 20rpx);
        padding: 20rpx 0rpx;
        margin: 0 auto;
        border-bottom: 1px solid #f0f0f0;
        font-size: 28rpx;
        .fle {
          display: flex;
          padding: 5rpx;
          .time {
            flex: 1;
            color: #818181;
          }

          .zt1 {
            color: #474747;
            position: relative;
            margin-right: 35rpx;
            font-size: 28rpx;
            &::after {
              position: absolute;
              content: "";
              background: url("../../static/images/jiedan.png") no-repeat;
              width: 30rpx;
              height: 30rpx;
              background-size: 100% 100%;
              top: 50%;
              margin-top: -15rpx;
              left: 100%;
              margin-left: 5rpx;
            }
          }
          .zt2 {
            @extend .zt1;
            &::after {
              position: absolute;
              content: "";
              background: url("../../static/images/diandongche.png") no-repeat;
              width: 28rpx;
              height: 28rpx;
              background-size: 100% 100%;
              top: 50%;
              margin-top: -14rpx;
              left: 100%;
              margin-left: 5rpx;
              opacity: 0.8;
            }
          }
          .zt3 {
            @extend .zt1;
            &::after {
              position: absolute;
              content: "";
              background: url("../../static/images/woshou.png") no-repeat;
              width: 30rpx;
              height: 30rpx;
              background-size: 100% 100%;
              top: 50%;
              margin-top: -15rpx;
              left: 100%;
              margin-left: 5rpx;
            }
          }
        }
      }
      .dizhi {
        width: calc(100% - 20rpx);
        margin: 15rpx auto;
        font-size: 32rpx;
        color: #474747;
      }
      .content {
        width: calc(100% - 20rpx);
        margin: 15rpx auto;
        font-size: 28rpx;
        padding-bottom: 10rpx;
        color: #818181;
        line-height: 1.2;
        text-align: justify;
      }
    }
  }
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