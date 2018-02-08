<template>
  <el-col :span="8" :offset="6">
    <el-card class="box-card">
<el-form ref="form" :model="form" :rules="rules" label-width="80px">
  <el-form-item label="活动名称"  prop="title">
    <el-input v-model="form.title"></el-input>
  </el-form-item>
  <el-form-item label="开始时间" prop="plan_start">
    <el-col>
      <el-time-picker value-format="yyyy-MM-dd HH:mm:ss"  placeholder="开始时间" v-model="form.plan_start" style="width: 100%;"></el-time-picker>
    </el-col>
    </el-form-item>
    <el-form-item label="结束时间" prop="plan_end">
    <el-col>
      <el-time-picker value-format="yyyy-MM-dd HH:mm:ss"  placeholder="完成时间" v-model="form.plan_end" style="width: 100%;"></el-time-picker>
    </el-col>
  </el-form-item>
  <el-form-item label="是否完成" prop="is_completed">
    <el-switch v-model="form.is_completed"></el-switch>
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
          id: 0,
          title: '',
          plan_start: '',
          plan_end: '',
          is_completed: false,
        },
        rules: {
          title: [{required: true, message: '请输入标题', trigger: 'blur'}],
          plan_start: [{required: true, message: '请选择开始时间', trigger: 'blur'}],
          plan_end: [{required: true, message: '请选择结束时间', trigger: 'blur'}],
        }
      };
    },
    methods: {
      onSubmit(formName) {
        this.$refs[formName].validate((valid) => {
          if (valid) {
            //表单提交
            axios.post("/api/todos", this.form)
                .then(response => {
                    if(response.data.status){
                      //TODO
                    }
                    this.$message(response.data.msg)
                 }).catch(error => {
                   console.log(error.errors);
                 })
          }
        });
      }
    },
    watch: {
      ['form.plan_start']: function (val) {
        if (val > this.form.plan_end && this.form.plan_end){
           this.$message('结束时间不能小于开始时间');
        }
      },
      ['form.plan_end']: function (val) {
        if (val < this.form.plan_start && this.form.plan_start)
           this.$message("结束时间不能小于开始时间");
        }
      }
  }
</script>