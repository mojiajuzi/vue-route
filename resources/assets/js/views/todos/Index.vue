<template>
    <div class="todos">
      <div class="loading" v-if="loading">
          Loading.....
      </div>
      <div v-if="error" class="error">
         <p> {{ error }}</p>
         <p>
             <button @click.prevent="fetchData">Try Again</button>
         </p>
      </div>
        <el-row :gutter="4"  v-if="todos">
            <el-col :span="6" v-for="(todo, k) in todos" :key="k"  >
                <el-card class="box-card">
                    <div class="grid-content bg-purple">
                    <div v-if="todo.is_completed">
                        <el-progress :percentage="100"></el-progress>
                    </div>
                    <div v-else>
                        <el-progress  :percentage="0" ></el-progress>
                    </div>
                    <div class="text item">
                        {{ todo.title  }}
                    </div>
                    <p>{{todo.plan_start}}</p>
                    <p>{{todo.plan_end}}</p>
                    </div>
                </el-card>
                </el-col>
        </el-row>
        <el-row :gutter="4"  v-if="todos">
            <el-col  :span="12" :offset="8">
                <div class="block">
                    <el-pagination
                        layout="prev, pager, next"
                        :total=total
                        @current-change="paginateChange"
                        >
                    </el-pagination>
                </div>
            </el-col>
    </el-row>
  </div>
</template>
<script>
import axios from 'axios';
export default {
    data() {
        return {
            loading: false,
            todos: null,
            error: null,
            total: 0,
            path: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.todos = null;
            this.loading = true;
            axios
                .get("/api/todos")
                .then(response => {
                    this.loading =false;
                    this.todos = response.data.data;
                    this.total = response.data.total;
                    this.path = response.data.path;
                 }).catch(error => {
                     this.loading = false;
                     this.error = error.response.data.message || error.message;
                 })
        },
        paginateChange(val) {
            console.log(val);
            
        }
    }
}
</script>
