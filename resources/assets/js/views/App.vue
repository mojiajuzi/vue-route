<template>
<el-container>
  <el-header>Vue Router Demo App</el-header>
  <el-container>
    <el-aside width="200px">
    <el-menu>
          <el-menu-item index="1-3"><router-link :to="{name: 'users.index'}">Users</router-link></el-menu-item>
          <el-menu-item index="1-4"><router-link :to="{name: 'todos.index'}">TodoIndex</router-link></el-menu-item>
          <el-menu-item index="1-5"><router-link :to="{name: 'todos.create'}">TodoCreate</router-link></el-menu-item>
          <el-menu-item index="1-6"><router-link :to="{name: 'chat'}">ChatRoom</router-link></el-menu-item>
          <el-menu-item index="1-7"><router-link :to="{name: 'cost.create'}">CostCategory</router-link></el-menu-item>
    </el-menu>
    </el-aside>
    <el-main>
        <div class="container">
            <router-view></router-view>
        </div>
    </el-main>
  </el-container>
</el-container>
</template>
<script>
export default {
  
}
</script>

