<template>
  <div id="app">
    <router-view></router-view>
  </div>
</template>
<script>
</script>
<style lang="scss" >
body,
ol,
ul,
h1,
h2,
h3,
h4,
h5,
h6,
p,
th,
td,
dl,
dd,
form,
fieldset,
legend,
input,
textarea,
select {
  margin: 0;
  padding: 0;
}
body {
  font-family: "Microsoft YaHei", "微软雅黑", "宋体", "Helvetica Neue",
    "Lucida Grande", "Verdana", "Helvetica", "Georgia", "Tahoma", "Arial";
}
a {
  color: #2d374b;
  text-decoration: none;
}
a:hover {
  text-decoration: none;
}
em {
  font-style: normal;
}
li {
  list-style: none;
}
img {
  border: 0;
  vertical-align: middle;
}
table {
  border-collapse: collapse;
  border-spacing: 0;
}
p {
  word-wrap: break-word;
}
.clearfix {
  clear: both;
}
input:focus {
  outline: none;
}
button:focus {
  outline: none;
}
html,
body {
  padding: 0px;
  margin: 0px;
  color: #474747;
}
.clear {
  clear: both;
}
html,
body {
  position: relative;
  width: 100%;
  height: 100%;
  min-width: 1366px;
  min-height: 700px;
  background-size: 100% 100%;
  background-repeat: no-repeat;
  background: #f1f1f1;
  font-size: 16px;
}
#app {
  width: 100%;
  height: 100%;
}
.page_name {
  width: 100%;
  color: #474747;
  font-size: 18px;
  line-height: 50px;
  border-bottom: 1px solid rgb(230, 230, 230);
}

.el-message-box {
  position: fixed;
  left: 50%;
  top: 50%;
  transform: translate(-50%, -200%);
}
.el-dialog__body {
  padding: 0px !important;
}
.el-date-editor.el-input,
.el-date-editor.el-input__inner {
  flex: 1;
  &:first-child {
    margin-right: 5px;
  }
  &:last-child {
    margin-left: 5px;
  }
}
.page_msg {
  font-size: 14px;
  line-height: 3;
  color: #909399;
}
.el-table .cell,
.el-table th div,
.el-table--border td:first-child .cell,
.el-table--border th:first-child .cell {
  padding-left: 0px !important;
  padding-right: 0px !important;
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
.el-input:first-child{
  margin-right: 5px;
}
.el-input:last-child{
  margin-left: 5px;
}
</style>
