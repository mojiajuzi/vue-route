<template>
  <div class="users">
      <div class="loading" v-if="loading">
          Loading.....
      </div>
      <div v-if="error" class="error">
         <p> {{ error }}</p>
         <p>
             <button @click.prevent="fetchData">Try Again</button>
         </p>
      </div>
        <div v-if="users">
            <el-table
                :data="users"
                style="width: 100%">
                <el-table-column
                    prop="name"
                    label="姓名"
                    width="180">
                </el-table-column>
                <el-table-column
                    prop="email"
                    label="邮箱">
                </el-table-column>
                </el-table>
        </div>
  </div>
</template>
<script>
import axios from 'axios';

export default {
    data() {
        return {
            loading: false,
            users: null,
            error: null,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            this.error = this.users = null;
            this.loading = true;
            axios
                .get("/api/users")
                .then(response => {
                    this.loading =false;
                    this.users = response.data;                
                 }).catch(error => {
                     this.loading = false;
                     this.error = error.response.data.message || error.message;
                 })
        }
    }
}
</script>

