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
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:1">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view class="content">顺丰-20-30-10</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:1">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:1">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 1">
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.5">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.5">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.5">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.5">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
      </view>
      <view v-show="nodis == 2">
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.3">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:0.5">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">11:01</view>
                <view class="zt3">已完成</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.3">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:0.5">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">11:01</view>
                <view class="zt3">已完成</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.3">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:0.5">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">11:01</view>
                <view class="zt3">已完成</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.3">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:0.5">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">11:01</view>
                <view class="zt3">已完成</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="box_">
          <view class="w">
            <view class="tt">
              <view class="fle" style="opacity:0.3">
                <view class="time">10.01 - 10:01</view>
                <view class="zt1">已接单</view>
              </view>
              <view class="fle" style="opacity:0.5">
                <view class="time">10:31</view>
                <view class="zt2">派送中</view>
              </view>
              <view class="fle" style="opacity:1">
                <view class="time">11:01</view>
                <view class="zt3">已完成</view>
              </view>
            </view>
            <view class="dizhi">成都市武侯区武侯大道金楠国际2-3804</view>
            <view
              class="content"
            >中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！中国的多端开发时代演进，促使跨端开发领域必然产生新的平台巨头，加入DCloud，一起创造未来！</view>
          </view>
        </view>
        <view class="loading">{{loading}}</view>
      </view>
    </view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      nodis: 0,
      loading: "上拉加载更多..."
    };
  },
  methods: {
    changedis(val) {
      this.nodis = val;
    }
  },
  watch: {
    nodis() {}
  },
  onPullDownRefresh() {
    console.log("refresh");
    setTimeout(function() {
      uni.stopPullDownRefresh();
    }, 1000);
  },
  onReachBottom() {
    let thiz = this;
    thiz.loading = "加载中...";
    setTimeout(function() {
      thiz.loading = "没有了";
    }, 3000);
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
      color: #818181;
    }
    .boddr {
      border-bottom: 4rpx solid #474747;
      color: #474747;
    }
  }
}
.dd_ {
  margin-top: 110rpx;
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