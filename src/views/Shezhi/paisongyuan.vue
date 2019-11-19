<template>
  <div>
    <div class="page_name">派送员设置</div>
    <div class="page_msg">订单多人配送，用于跟踪订单派送人</div>
    <div class="addbtn">
      <el-button type="primary" icon="el-icon-search" size="small" @click="add()">新增</el-button>
    </div>
    <el-table :data="tableData" style="width: 100%" :show-header="false">
      <el-table-column label="姓名">
        <template slot-scope="scope">{{ scope.row.name }}</template>
      </el-table-column>
      <el-table-column label="电话">
        <template slot-scope="scope">{{ scope.row.phone }}</template>
      </el-table-column>
      <el-table-column label="操作" align="right">
        <template slot-scope="scope">
          <el-button
            type="text"
            class="qudiao"
            icon="el-icon-delete"
            @click="deletea(scope.row.id)"
            size="small"
          >删除</el-button>
        </template>
      </el-table-column>
    </el-table>

    <el-dialog title="添加派送人员" :visible.sync="dialogFormVisible" width="50%">
      <div class="timefrom">
        <el-input v-model="name" placeholder="姓名"></el-input>
        <el-input v-model="phone" placeholder="手机号"></el-input>
      </div>
      <div class="timebtn">
        <el-button type="primary" @click="addbtn()">保存</el-button>
      </div>
    </el-dialog>
  </div>
</template>
<script>
export default {
  data() {
    return {
      tableData: [],
      dialogFormVisible: false,
      name: "",
      phone: ""
    };
  },
  created() {
    this.find();
  },
  methods: {
    add() {
      this.dialogFormVisible = true;
    },
    addbtn() {
      if (!/\S/.test(this.name)) {
        this.$message({
          message: "姓名不能为空",
          type: "warning"
        });
        return;
      }
      if (!/^1[3456789]\d{9}$/.test(this.phone)) {
        this.$message({
          message: "手机号不符合规则",
          type: "warning"
        });
        return;
      }
      let { name, phone } = this._data;
      this.$http
        .post(
          "/index.php/home/Run/addpaisyuan",
          this.$qs.stringify({
            name,
            phone
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: "添加成功",
              type: "success"
            });
            this.name = "";
            this.phone = "";
            this.dialogFormVisible = false;
            this.find();
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {});
    },
    find() {
      this.$http
        .post("/index.php/home/Run/finpaisyuan", this.$qs.stringify({}))
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.tableData = res.lists;
          } else {
            this.tableData = [];
          }
        })
        .catch(() => {});
    },
    deletea(id) {
      this.$http
        .post(
          "/index.php/home/Run/delectpsy",
          this.$qs.stringify({
            id
          })
        )
        .then(response => {
          let res = response.data;
          if (res.result) {
            this.$notify({
              title: "成功",
              message: res.msg,
              type: "success"
            });
            this.find();
          } else {
            this.$notify.error({
              title: "警告",
              message: res.msg
            });
          }
        })
        .catch(() => {});
    }
  }
};
</script>
<style lang="scss" scoped>
.el-icon-delete,
.el-icon-edit {
  float: right;
  font-size: 20px;
  margin-right: 20px;
  cursor: pointer;
  color: #6d6f74;
}
.addbtn {
  padding: 10px 0px;
  button {
  }
}
.qudiao {
  margin-right: 10px;
}
</style>