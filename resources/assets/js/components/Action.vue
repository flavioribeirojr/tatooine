<template>
  <a 
    v-if="showAction"
    :href="action"
    :class="aclass"
  >
    <i v-if="icon" :class="icon"></i>
    {{message}}
  </a>
</template>

<script>
import axios from 'axios';

export default {
  props: ['action', 'aclass', 'icon', 'message'],
  data () {
    return {
      showAction: false
    }
  },
  methods: {
    hasPermission () {
      axios.get(this.$baseUrl + '/permissions/checkpermission', {
        params: {
          action: this.action
        }
      })
      .then( (response) => this.showAction = response.data.allow )
    }
  },
  mounted () {
    console.log(this)
    this.hasPermission()
  }
}
</script>

