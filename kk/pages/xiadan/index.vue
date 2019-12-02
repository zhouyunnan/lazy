<template>
  <view class="xd_" v-if="page_dis">
    <view class="qujianhao" v-if="quhuohao.dis">
      <textarea placeholder="请填取货码，可直接将取件短信粘贴此处" @blur="bindTextAreaBlur" />
    </view>
    <view class="xzq" @click="xzdz()">
      <view class="name">送达地址</view>
      <view class="ico" v-if="dizhi==''"></view>
      <view class="msg" v-else>{{dizhi.name}} - {{dizhi.phone}}</view>
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
              <view class="ico" v-if="!fr.value"></view>
              <view class="msg" v-else>{{fr.value}}</view>
            </picker>
          </view>
          
          <view v-if="fr.val == 'kuaidigongsi'">
            <picker :value="kuaidigongsi" @change="bindTimeChange5" :range="fr.data">
              <view class="ico" v-if="!fr.value"></view>
              <view class="msg" v-else>{{fr.value}}</view>
            </picker>
          </view>
          <view v-if="fr.val == 'kuaididaxiao'">
            <picker :value="kuaididaxiao" @change="bindTimeChange4" :range="fr.data">
              <view class="ico" v-if="!fr.value"></view>
              <view class="msg" v-else>{{fr.value}}</view>
            </picker>
          </view>
        </view>
      </view>
      <view v-if="fr.val == 'songdashijian'">
        <view class="xzq">
          <view class="name">{{fr.name}}</view>
          <picker
            mode="time"
            :value="fr.value"
            :start="nowtime"
            end="23:59"
            @change="bindTimeChange"
          >
            <view class="ico" v-if="!fr.value"></view>
            <view class="msg" v-else>{{fr.value}}</view>
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
            <view class="ico" v-if="!fr.value"></view>
            <view class="msg" v-else>{{fr.value}}</view>
          </picker>
        </view>
      </view>
    </view>
    <view class="xiadan" @click="xiadnbtn()">提交订单</view>
  </view>
</template>
<script>
export default {
  data() {
    return {
      dizhi: "",
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
      from: [],
      sldata: [
        "需要送上楼",
        "不需要送上楼",
        "到楼下了联系我",
        "放楼下宿管处",
        "其他"
      ],
      dxdata: ["1kg以下", "1kg - 5kg", "5kg - 10kg", "10ky以上"],
      page_dis: false,
      kdgs:[
        "京东快递",
        "顺丰快递",
        "圆通快递",
        "中通快递",
        "申通快递",
        "韵达快递",
        "百世快递",
        "天天快递",
        "德邦快递",
        "邮政EMS",
        "唯品会",
        "其他请备注",
      ]
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

    let dizhi = uni.getStorageSync("dizhi");
    if (this.myconfig.isnull(dizhi)) {
      this.mrdz();
    } else {
      this.dizhi = dizhi;
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
            this.page_dis = true;
          } else {
            uni.showToast({
              title: re.msg,
              icon: "none",
              duration: 1400,
              position: "top"
            });
            this.page_dis = false;
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
        if (tab.val == "kuaidigongsi") {
          this.from.push({
            name: tab.name,
            val: tab.val,
            value: "",
            type: "sele_",
            data: this.kdgs
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
    xiadnbtn() {
      let from_dd = Object.create({});
      let quhuohao = this.quhuohao.val;
      if (this.quhuohao.dis) {
        if (this.myconfig.isnull(quhuohao)) {
          uni.showToast({
            title: "请输入取货号",
            duration: 1000,
            icon: "none"
          });
          return;
        }
        from_dd["quhuohao"] = quhuohao;
      }
      if (this.myconfig.isnull(this.dizhi)) {
        uni.showToast({
          title: "请选择收件地址",
          duration: 1000,
          icon: "none"
        });
        return;
      }

      from_dd["shouhuoren"] = this.dizhi.name;
      from_dd["shouhuodizhi"] = this.dizhi.dizhi;
      from_dd["lianxidianhua"] = this.dizhi.phone;

      let data = this.from;
      for (let i = 0; i < data.length; i++) {
        if (this.myconfig.isnull(data[i]["value"])) {
          if (data[i]["val"] != "tebiebeizhu") {
            uni.showToast({
              title: data[i].name + "不能为空",
              duration: 1000,
              icon: "none"
            });
            return;
          }
        }
        from_dd[data[i]["val"]] = data[i]["value"];
      }
      from_dd["schoolid"] = this.school_id;

      uni.showLoading({
        title: "请稍后",
        mask: true
      });

      let thiz = this;
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xxiadan/yuxiadan",
        data: from_dd,
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          uni.hideLoading();
          let re = res.data;
          if (re.result) {
            uni.redirectTo({
              url: "/pages/xiadan/ddhd?id=" + re.id
            });
          } else {
            uni.showToast({
              title: "失败",
              duration: 1500,
              icon: "none"
            });
          }
        },
        fail() {
          uni.hideLoading();
          uni.showToast({
            title: "失败",
            duration: 1500,
            icon: "none"
          });
        }
      });
    },

    xzdz() {
      uni.navigateTo({
        url: "/pages/My/dizhi"
      });
    },
    mrdz() {
      uni.request({
        method: "POST",
        url: this.myconfig.url + "index.php/home/xdizhi/dizhimr",
        data: {},
        header: {
          "content-type": "application/x-www-form-urlencoded;charset=utf-8",
          Cookie: uni.getStorageSync("sessionid")
        },
        success: res => {
          if (res.data.result) {
            this.dizhi = res.data.content;
          }
        },
        fail() {}
      });
    },
    bindTextAreaBlur(e) {
      this.quhuohao.val = e.detail.value;
    },
    linkschool_() {
      uni.redirectTo({
        url: "/pages/school/xuanzheschool"
      });
    },
    bindTimeChange: function(e) {
      let index = this.from.findIndex(function(tab) {
        if (tab.val == "songdashijian") {
          return true;
        }
      });
      this.from[index].value = e.target.value;
    },
    bindTimeChange2: function(e) {
      let index = this.from.findIndex(function(tab) {
        if (tab.val == "qujianshijian") {
          return true;
        }
      });
      this.from[index].value = e.target.value;
    },
    bindTimeChange3: function(e) {
      let index = this.from.findIndex(function(tab) {
        if (tab.val == "shangloufuwu") {
          return true;
        }
      });
      this.from[index].value = this.sldata[e.target.value];
    },
    bindTimeChange4: function(e) {
      let index = this.from.findIndex(function(tab) {
        if (tab.val == "kuaididaxiao") {
          return true;
        }
      });
      this.from[index].value = this.dxdata[e.target.value];
    },
    
    bindTimeChange5: function(e) {
      let index = this.from.findIndex(function(tab) {
        if (tab.val == "kuaidigongsi") {
          return true;
        }
      });
      this.from[index].value = this.kdgs[e.target.value];
    },
    linkdizhi() {
      uni.redirectTo({
        url: "/pages/school/xuanzheschool"
      });
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
    color: #696868;
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
    color: #696868;
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
  background: white;
  color: #ff507d;
  border-top: 2rpx dashed #ff507d;
}
</style>