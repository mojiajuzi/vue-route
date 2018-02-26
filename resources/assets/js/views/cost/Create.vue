<template>
  <el-col :span="8" :offset="6">
    <el-card class="box-card">
<el-form ref="form" :model="form" :rules="rules" label-width="80px">
  <el-form-item label="类型名称"  prop="title">
    <el-input v-model="form.title"></el-input>
  </el-form-item>
  <el-form-item>
    <el-button type="primary" @click="onSubmit('form')">立即创建</el-button>
    <el-button>取消</el-button>
  </el-form-item>
</el-form>
    </el-card>
  </el-col>
</template>
<script>
export default {
    data() {
        return {
            form: {
                name: null,
            }
        }
    },
    methods: {
      onSubmit(form){
        axios.post("/api/cost/category", this.form)
          .then(response =>{
            this.$message(response.data.msg)
          }).catch(error => (
            this.$message(error.data)
          ))
      }
    }
}
</script>

