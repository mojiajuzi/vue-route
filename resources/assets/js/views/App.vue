<template>
<el-container>
  <el-header>Vue Router Demo App</el-header>
  <el-container>
    <el-aside width="200px">
    <el-menu>
          <el-menu-item index="1-1"><router-link :to="{name: 'home'}">Home</router-link></el-menu-item>
          <el-menu-item index="1-2"><router-link :to="{name: 'hello'}">Hello World</router-link></el-menu-item>
          <el-menu-item index="1-3"><router-link :to="{name: 'users.index'}">Users</router-link></el-menu-item>
          <el-menu-item index="1-4"><router-link :to="{name: 'todos.create'}">TodoCreate</router-link></el-menu-item>
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

