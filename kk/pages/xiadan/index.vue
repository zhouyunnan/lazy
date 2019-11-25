<template>
  <view class="xd_">
    <view class="qujianhao" v-if="quhuohao.dis">
      <textarea placeholder="请填取货码，可直接将取件短信粘贴此处" @blur="bindTextAreaBlur" />
    </view>
    <view class="xzq">
      <view class="name">收货地址</view>
      <!-- <view class="ico"></view> -->
      <view class="msg">周云男17600664495</view>
    </view>

    <view v-for="(fr,key) in from" :key="key">
      <view v-if="fr.type == 'inp'">
        <view class="inp">
          <view>{{fr.name}}</view>
          <input v-model="fr['value']" :placeholder="fr.val == 'tebiebeizhu'?'选填':'必填哦'" />
        </view>
      </view>
      <view v-if="fr.type == 'sele_'">
        <view class="xzq">
          <view class="name">{{fr.name}}</view>
          <view v-if="fr.val == 'shangloufuwu'">
            <picker :value="shangloufuwu" @change="bindTimeChange3" :range="fr.data">
              <view class="ico" v-if="!shangloufuwu"></view>
              <view class="msg" v-else>{{shangloufuwu}}</view>
            </picker>
          </view>
          <view v-if="fr.val == 'kuaididaxiao'">
            <picker :value="kuaididaxiao" @change="bindTimeChange4" :range="fr.data">
              <view class="ico" v-if="!kuaididaxiao"></view>
              <view class="msg" v-else>{{kuaididaxiao}}</view>
            </picker>
          </view>
        </view>
      </view>
      <view v-if="fr.val == 'songdashijian'">
        <view class="xzq">
          <view class="name">{{fr.name}}</view>
          <picker
            mode="time"
            :value="songdashijian"
            :start="nowtime"
            end="23:59"
            @change="bindTimeChange"
          >
            <view class="ico" v-if="!songdashijian"></view>
            <view class="msg" v-else>{{songdashijian}}</view>
          </picker>
        </view>
      </view>
      <view v-if="fr.val == 'qujianshijian'">
        <view class="xzq">
          <view class="name">{{fr.name}}</view>
          <picker
            mode="time"
            :value="qujianshijian"
            :start="nowtime"
            end="23:59"
            @change="bindTimeChange2"
          >
            <view class="ico" v-if="!qujianshijian"></view>
            <view class="msg" v-else>{{qujianshijian}}</view>
          </picker>
        </view>
      </view>
    </view>
    <view class="xiadan">提交订单</view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      school_id: "",
      dis: true,
      bds: "",
      inp: "",
      time: "",
      nowtime: "",
      quhuohao: {
        dis: false,
        val: ""
      },
      songdashijian: "",
      qujianshijian: "",
      shangloufuwu: "",
      kuaididaxiao: "",
      from: [],
      sldata: [
        "需要送上楼",
        "不需要送上楼",
        "到楼下了联系我",
        "放楼下宿管处",
        "其他"
      ],
      dxdata: ["1kg以下", "1kg - 5kg", "5kg - 10kg", "10ky以上"]
    };
  },
  onLoad() {
    var now = new Date();
    var hour = now.getHours();
    var minu = now.getMinutes();
    this.nowtime = hour + ":" + minu;
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
        url: this.myconfig.url + "index.php/home/Xxiadan/getfrom",
        data: {
          id: this.school_id
        },
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          let re = res.data;
          if (re.result) {
            this.bds = re.lists;
          } else {
            uni.showToast({
              title: re.msg,
              icon: "none",
              duration: 1400,
              position: "top"
            });
          }
        },
        fail() {}
      });
    },

    bds() {
      let thiz = this;
      let bds = this.bds;
      let moduleContent = this.bds;
      let index = moduleContent.findIndex(function(val) {
        if (val.val == "quhuohao") {
          thiz.quhuohao = {
            dis: true,
            val: ""
          };
          return;
        }
      });
      for (let i = 0; i < bds.length; i++) {
        let tab = bds[i];
        if (
          tab.val == "kuaidigongsi" ||
          tab.val == "tebiebeizhu" ||
          tab.val == "quhuodidian" ||
          tab.val == "huowumingcheng"
        ) {
          this.from.push({
            name: tab.name,
            val: tab.val,
            value: "",
            type: "inp"
          });
        }
        if (tab.val == "shangloufuwu") {
          this.from.push({
            name: tab.name,
            val: tab.val,
            value: "",
            type: "sele_",
            data: this.sldata
          });
        }
        if (tab.val == "kuaididaxiao") {
          this.from.push({
            name: tab.name,
            val: tab.val,
            value: "",
            type: "sele_",
            data: this.dxdata
          });
        }
        if (tab.val == "songdashijian" || tab.val == "qujianshijian") {
          this.from.push({
            name: tab.name,
            val: tab.val,
            value: "",
            type: "time"
          });
        }
      }
    }
  },
  methods: {
    bindTextAreaBlur(e) {
      this.quhuohao.val = e.detail.value;
    },
    linkschool_() {
      uni.redirectTo({
        url: "/pages/school/xuanzheschool"
      });
    },
    bindTimeChange: function(e) {
      this.songdashijian = e.target.value;
    },
    bindTimeChange2: function(e) {
      this.qujianshijian = e.target.value;
    },
    bindTimeChange3: function(e) {
      this.shangloufuwu = this.sldata[e.target.value];
    },
    bindTimeChange4: function(e) {
      this.kuaididaxiao = this.dxdata[e.target.value];
    }
  }
};
</script>
<style lang="scss" scoped>
.xd_ {
  padding-bottom: 200rpx;
}
.qujianhao {
  width: 100vw;
  height: 250rpx;
  background: white;
  margin-bottom: 10rpx;
  textarea {
    width: calc(100% - 40rpx);
    height: calc(100% - 40rpx);
    margin: 0 auto;
    padding: 20rpx;
    font-size: 32rpx;
    line-height: 1.5rpx;
    color: #474747;
  }
}
.inp {
  width: 100vw;
  height: 100rpx;
  background: white;
  border-bottom: 1rpx solid #f0f0f0;
  display: flex;
  line-height: 100rpx;
  font-size: 32rpx;
  view {
    margin-left: 20rpx;
    color: #2c2c2c;
    margin-right: 20rpx;
  }
  input {
    flex: 1;
    text-align: right;
    margin-right: 20rpx;
    height: 100rpx;
    line-height: 100rpx;
    color: #474747;
  }
}
.xzq {
  width: 100vw;
  height: 100rpx;
  background: white;
  border-bottom: 1rpx solid #f0f0f0;
  display: flex;
  line-height: 100rpx;
  font-size: 32rpx;
  .name {
    flex: 1;
    margin-left: 20rpx;
    color: #2c2c2c;
    margin-right: 30rpx;
  }
  .ico {
    margin-right: 20rpx;
    width: 50rpx;
    height: 50rpx;
    background: url(../../static/images/more.png) no-repeat;
    background-size: 50rpx 50rpx;
    margin-top: 25rpx;
    border-left: 100rpx solid white;
  }
  .msg {
    text-align: right;
    margin-right: 20rpx;
    height: 100rpx;
    line-height: 100rpx;
    color: #474747;
    overflow: hidden;
  }
}
.xiadan {
  position: fixed;
  width: 100vw;
  height: 90rpx;
  text-align: center;
  line-height: 90rpx;
  font-size: 34rpx;
  bottom: 0rpx;
  background:white;
	color: #FF507D;
  border-top: 2rpx dashed #FF507D;
}
</style>