<template>
  <div>
    <div class="page_name">营业状态</div>
    <div class="fk_">
      <div class="box" :style="{background:color}" id="yyzt">
        <div class="msg">{{msg}}</div>
        <div class="switch">
          <el-switch v-model="zt" active-color="#DCDFE6" inactive-color="#DCDFE6"></el-switch>
        </div>
      </div>
      <div class="box">
        <div class="tit">接单时间</div>
        <div class="msg">{{startTime}} - {{endTime}}</div>
        <div class="btn" @click="changeTime()">
          <span class="iconfont icon-ai248"></span>
        </div>
      </div>
    </div>
    <div class="gonggao_">
      <div class="tit">店铺公告</div>
      <div class="msg">展示在店铺首页的公告，你可以用来设置展示收费标准</div>
      <div class="content">
        <el-input type="textarea" :rows="3" placeholder="请输入内容" v-model="gonggao"></el-input>
        <el-button type="primary" @click="gonggaobtn()">保存公告</el-button>
      </div>
    </div>

    <el-dialog title="设置接单时间" :visible.sync="dialogFormVisible" width="50%">
      <div class="timefrom">
        <el-time-select
          placeholder="开始时间"
          v-model="startTime"
          :picker-options="{
      start: '00:00',
      step: '00:15',
      end: '23:59'
    }"
        ></el-time-select>
        <el-time-select
          placeholder="结束时间"
          v-model="endTime"
          :picker-options="{
      start: '00:00',
      step: '00:15',
      end: '23:59',
      minTime: startTime
    }"
        ></el-time-select>
      </div>
      <div class="timebtn">
        <el-button type="primary" @click="changebtn()">保存</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
import { Loading } from "element-ui";
export default {
  data() {
    return {
      begin: false,
      startTime: "",
      endTime: "",
      zt: "",
      load: "",
      dialogFormVisible: false,
      gonggao: ""
    };
  },
  created() {
    this.find();
  },
  computed: {
    color() {
      if (this.zt) {
        return "#67C23A";
      } else {
        return "#F56C6C";
      }
    },
    msg() {
      if (this.zt) {
        return "营业中";
      } else {
        return "歇业了";
      }
    }
  },
  watch: {
    zt() {
      if (this.begin) {
        this.load = Loading.service({
          target: "#yyzt",
          background: "rgba(0, 0, 0, 0.6)",
          customClass: "a"
        });
        setTimeout(() => {
          this.updata_yyzt(this.zt);
        }, 400);
      }
    }
  },
  methods: {
    updata_yyzt(val) {
      this.$http
        .post(
          "/index.php/home/Run/set",
          this.$qs.stringify({
            yingyezt: val
          })
        )
        .then(response => {
          let res = response.data;
          if (!res.result) {
            this.$notify.error({
              title: "错误",
              message: res.msg
            });
            this.begin = false;
            this.find();
          }
          this.load.close();
        })
        .catch(() => {
          this.load.close();
          this.$confirm("网络错误!是否获取最新数据", "警告", {
            confirmButtonText: "获取",
            cancelButtonText: "取消",
            type: "warning"
          })
            .then(() => {
              this.begin = false;
              this.find();
            })
            .catch(() => {
              return;
            });
        });
    },
    find() {
      this.$http
        .post("/index.php/home/Run/fin", {})
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.startTime = res.content.jiedanshijian;
            this.endTime = res.content.guandianshijian;
            this.gonggao = res.content.gonggao;
            if (res.content.yingyezt == "true") {
              this.zt = true;
            } else {
              this.zt = false;
            }
            setTimeout(() => {
              this.begin = true;
            }, 0);
          } else {
            this.$notify.error({
              title: "警告",
              message: "数据获取失败"
            });
          }
        })
        .catch(() => {});
    },
    changeTime() {
      this.dialogFormVisible = true;
    },
    changebtn() {
      this.dialogFormVisible = false;
      this.$http
        .post(
          "/index.php/home/Run/set",
          this.$qs.stringify({
            jiedanshijian: this.startTime,
            guandianshijian: this.endTime
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.begin = false;
            this.find();
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {
          this.$confirm("网络错误!是否获取最新数据", "警告", {
            confirmButtonText: "获取",
            cancelButtonText: "取消",
            type: "warning"
          })
            .then(() => {
              this.begin = false;
              this.find();
            })
            .catch(() => {
              return;
            });
        });
    },
    gonggaobtn() {
      this.$http
        .post(
          "/index.php/home/Run/set",
          this.$qs.stringify({
            gonggao: this.gonggao
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.begin = false;
            this.find();
            this.$notify({
              title: "成功",
              message: "公告设置成功",
              type: "success"
            });
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {
          this.$confirm("网络错误!是否获取最新数据", "警告", {
            confirmButtonText: "获取",
            cancelButtonText: "取消",
            type: "warning"
          })
            .then(() => {
              this.begin = false;
              this.find();
            })
            .catch(() => {
              return;
            });
        });
    }
  }
};
</script>
<style lang="scss" scoped>
.fk_ {
  width: 100%;
  height: 200px;
  display: flex;
  .box {
    flex: 1;
    position: relative;
    margin: 10px;
    background: #409eff;
    border-radius: 6px;
    .btn {
      position: absolute;
      width: 24px;
      height: 24px;
      right: 5px;
      top: 5px;
      cursor: pointer;
      color: rgb(245, 245, 245);
      span {
        font-size: 30px;
      }
    }
    .switch {
      position: absolute;
      right: 5px;
      top: 5px;
    }
    .msg {
      position: absolute;
      color: white;
      font-size: 25px;
      text-align: center;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
    .tit {
      position: absolute;
      color: white;
      font-size: 16px;
      left: 10px;
      top: 10px;
    }
  }
  .box:first-child {
    margin-left: 0px;
  }
  .box:last-child {
    flex: 2;
    margin-right: 0px;
  }
}
.timefrom {
  padding: 20px;
  display: flex;
}
.timebtn {
  padding: 0px 20px 40px 20px;
  height: 30px;
  button {
    float: right;
  }
}
.gonggao_ {
  width: 100%;
  height: 200px;
  margin-top: 10px;
  .tit {
    font-size: 16px;
    line-height: 2;
  }
  .msg {
    font-size: 12px;
  }
  .content {
    margin-top: 10px;
    button {
      float: right;
      margin-top: 10px;
    }
  }
}
</style>