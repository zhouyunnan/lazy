<template>
  <view>
    <view class="dingwei_">
      <view class="w">
        <view class="dw_fle">
          <view>当前定位:</view>
          <view>{{city}} · {{district}}</view>
          <view @click="getaddress()">[重新获取]</view>
        </view>
      </view>
    </view>
    <view class="school_" v-for="(school,key) in schools" :key="key" @click="qrschool(school.id)">
      <view class="w">
        <view class="box_" :class="{disborder:key == schools.length-1}">
          <view>{{school.schoolname}}</view>
          <view></view>
        </view>
      </view>
    </view>
    <view class="msg_">
      <text>没有找到你的学校 ?</text>
      <text @click="linkschool_()">查看全部</text>
    </view>
  </view>
</template>

<script>
export default {
  data() {
    return {
      city: "遵义市",
      district: "播州区",
      schools: ""
    };
  },
  onLoad() {
    let city = uni.getStorageSync("city");
    let district = uni.getStorageSync("district");
    if (!this.myconfig.isnull(city)) {
      this.city = city;
    }
    if (!this.myconfig.isnull(district)) {
      this.district = district;
    }
  },
  watch: {
    city() {
      this.getschool_msl();
    }
  },
  methods: {
    //选定学校
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
    },
    linkschool_() {
      uni.navigateTo({
        url: "/pages/school/schoollist"
      });
    },
    //根据地理位置查询开通的学校
    getschool_msl() {
      let { city, district } = this;
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xlogin/save_wz",
        data: {
          city,
          district
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          this.schools = res.data.lists;
        }
      });
    },
    //获取地理位置授权
    opauthoriz() {
      let thiz = this;
      uni.authorize({
        scope: "scope.userLocation",
        success() {
          thiz.getwz();
        },
        fail() {
          console.log("拒绝授权");
        }
      });
    },
    //获取地理位置
    getwz() {
      let thiz = this;
      uni.getLocation({
        type: "gcj02",
        success: function(res) {
          uni.showLoading({
            title: "获取中",
            mask: true
          });
          uni.request({
            method: "GET",
            url:
              "https://apis.map.qq.com/ws/geocoder/v1/?location=" +
              res.latitude +
              "," +
              res.longitude +
              "&get_poi=1&key=OHCBZ-ME3EK-QZTJA-AI2GJ-SXE3J-SSBIG",
            data: {},
            header: {
              "content-type": "application/x-www-form-urlencoded;charset=utf-8"
            },
            success: res => {
              uni.hideLoading();
              let re = res.data;
              if (re.status == 0) {
                let dizhi_re = re.result;
                let address_component = dizhi_re["address_component"];
                let district = address_component["district"];
                let city = address_component["city"];
                thiz.district = district;
                thiz.city = city;
              } else {
                uni.showToast({
                  title: "位置查询失败，请手动查找",
                  icon: "none",
                  duration: 2000
                });
              }
            }
          });
        },
        fail() {
          uni.hideLoading();
          uni.showToast({
            title: "位置调用失败，请手动查找",
            icon: "none",
            duration: 2000
          });
        }
      });
    },
    getaddress() {
      let thiz = this;
      uni.getSetting({
        success(res) {
          let re = res.authSetting;
          if (re["scope.userLocation"]) {
            thiz.getwz();
          } else if (re["scope.userLocation"] == undefined) {
            thiz.opauthoriz();
          } else {
            uni.showModal({
              title: "提示",
              content: "检测到未开启位置权限，去开启？",
              success: function(res) {
                if (res.confirm) {
                  uni.openSetting({
                    success(setopi) {
                      let opi = setopi.authSetting;
                      if (opi["scope.userLocation"]) {
                        //位置权限获取成功
                        thiz.getwz();
                      } else {
                        //还是未授权
                        uni.showToast({
                          title: "未授权",
                          icon: "none",
                          duration: 2000
                        });
                      }
                    }
                  });
                }
              },
              fail() {}
            });
          }
        },
        fail() {
          console.log("查询授权失败");
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
    margin: 0rpx 20rpx;
  }

  font-size: 32rpx !important;
  color: #474747;
}

.dingwei_ {
  @include w_;

  .dw_fle {
    width: 100%;
    line-height: 60rpx;
    margin: 35rpx auto;
    display: flex;

    view:nth-child(2) {
      min-width: 100rpx;
      padding: 0rpx 20rpx;
      border-radius: 10rpx;
      background: white;
      margin: 0rpx 20rpx;
    }

    view:nth-child(3) {
      flex: 1;
      text-align: left;
    }
  }
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
.disborder {
  border-bottom: none !important;
}
</style>
