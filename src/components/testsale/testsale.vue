<template>
  <div ref="testDiv" class="testsale">
      <input type="text" name="username" id="username" v-model="username" />
      <input type="password" name="password" id="password" v-model="password" />
    <button type="button" @click="login">ทำการเข้าสู่ระบบ</button>
  </div>
</template>
<script src="../../js/testsale.js"></script>
