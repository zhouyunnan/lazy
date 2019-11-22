<template>
  <div>
    <div class="page_name">表单设置</div>
    <div class="page_msg">自定义小程序用户下单页面,可拖拽排序,</div>
    <el-table row-key="id" :data="moduleContent" style="width: 100%" size="medium">
      <el-table-column type="index" width="50"></el-table-column>
      <el-table-column prop="name" label="表单名称" width="180"></el-table-column>
      <el-table-column header-align="right" align="right">
        <template slot="header" slot-scope="scope">
          <el-select v-model="sele" placeholder="选择字段" size="small" value-key="id">
            <el-option
              v-for="item in options"
              :key="item.id"
              :label="item.label"
              :value="item.value"
            ></el-option>
          </el-select>
        </template>
        <template slot-scope="scope">
          <el-button
            type="text"
            class="qudiao"
            icon="el-icon-delete"
            size="small"
            @click="dele(scope.row)"
          >去掉</el-button>
        </template>
      </el-table-column>
    </el-table>

    <div class="timebtn">
      <el-button type="primary" @click="add()">保存设置</el-button>
      <el-button type="primary" @click="changebtn()">显示预览</el-button>
    </div>
  </div>
</template>
<script>
import Sortable from "sortablejs";
export default {
  created() {
    this.find();
  },
  data() {
    return {
      moduleContent: [],
      options: [
        {
          value: {
            val: "shouhuoren",
            name: "收货人",
            id: 1
          },
          label: "收货人"
        },
        {
          value: {
            val: "shouhuodizhi",
            name: "收货地址",
            id: 2
          },
          label: "收货地址"
        },
        {
          value: {
            val: "lianxidianhua",
            name: "联系电话",
            id: 3
          },
          label: "联系电话"
        },
        {
          value: {
            val: "quhuohao",
            name: "取货号",
            id: 4
          },
          label: "取货号"
        },
        {
          value: {
            val: "kuaidigongsi",
            name: "快递公司",
            id: 5
          },
          label: "快递公司"
        },
        {
          value: {
            val: "shangloufuwu",
            name: "上楼服务",
            id: 6
          },
          label: "上楼服务"
        },
        {
          value: {
            val: "kuaididaxiao",
            name: "快递大小",
            id: 7
          },
          label: "快递大小"
        },
        {
          value: {
            val: "tebiebeizhu",
            name: "特别备注",
            id: 8
          },
          label: "特别备注"
        },
        {
          value: {
            val: "quhuodidian",
            name: "取货地点",
            id: 9
          },
          label: "取货地点"
        },
        {
          value: {
            val: "huowumingcheng",
            name: "货物名称",
            id: 10
          },
          label: "货物名称"
        },
        {
          value: {
            val: "qujianshijian",
            name: "取货时间",
            id: 11
          },
          label: "取货时间"
        },
        {
          value: {
            val: "songdashijian",
            name: "期望送达时间",
            id: 12
          },
          label: "期望送达时间"
        }
      ],
      sele: ""
    };
  },
  components: {
    Sortable
  },
  mounted() {
    // 表格拖拽事件的添加
    const el = document.querySelectorAll(
      ".el-table__body-wrapper > table > tbody"
    )[0];
    let self = this;
    Sortable.create(el, {
      // 拖拽结束后的操作
      onEnd({ newIndex, oldIndex }) {
        // 修改data中的数组，
        const targetRow = self.moduleContent.splice(oldIndex, 1)[0];
        self.moduleContent.splice(newIndex, 0, targetRow);
      }
    });
  },
  watch: {
    moduleContent() {},
    sele() {
      let n = this.sele;
      let moduleContent = this.moduleContent;
      let index = moduleContent.findIndex(function(val) {
        if (val.val == n.val) {
          return true;
        }
      });
      if (index != -1) {
        return;
      } else {
        this.moduleContent.push(n);
      }
    }
  },
  methods: {
    find() {
      this.$http
        .post(
          "/index.php/home/Biaodan/find",
          this.$qs.stringify({
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.moduleContent = res.lists
          }
        })
        .catch(() => {
        
        });
    },
    dele(op) {
      let moduleContent = this.moduleContent;
      let index = moduleContent.findIndex(function(val) {
        if (val.val == op.val) {
          return true;
        }
      });
      this.moduleContent.splice(index, 1);
    },
    add() {
      if (this.moduleContent.length < 1) {
        return;
      }
      this.$http
        .post(
          "/index.php/home/Biaodan/addbd",
          this.$qs.stringify({
            data: JSON.stringify(this.moduleContent)
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: "保存成功",
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
          this.$notify.error({
            title: "警告",
            message: "网络错误"
          });
        });
    }
  }
};
</script>
<style lang="scss" scoped>
.qudiao {
  margin-right: 15px;
}
.timebtn {
  padding: 20px 0px 40px 20px;
  height: 30px;
  button {
    float: right;
    margin-left: 20px;
  }
}
</style>