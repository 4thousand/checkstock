<template>
  
  <span v-hotkey="keymap" v-show="show"> {{ data }}  Press `ctrl + esc` to toggle me! Hold `enter` to hide me! </span>
</template>

<script>
export default {
  data () {
    return {
      show: true,
      data:''
    }
  },
  methods: {
    toggle () {
      this.show = !this.show
      this.data = 'loop'
    },
    show () {
      this.show = true
    },
    hide () {
      this.show = false
    }
  },
  computed: {
    keymap () {
      return {
        'ctrl+shift+1': this.toggle,
      }
    }
  }
}
</script>