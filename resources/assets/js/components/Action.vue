<template>
  <a 
    v-if="showAction"
    :href="getUrl()"
    :class="aclass"
  >
    <i v-if="icon" :class="icon"></i>
    {{message}}
  </a>
</template>

<script>

export default {
  props: ['action', 'aclass', 'icon', 'message'],
  data () {
    return {
      showAction: false
    }
  },
  methods: {
    getUrl () {
      return `${this.$baseUrl}/${this.action}`
    },

    hasPermission () {
      
      if (! ('permissions' in localStorage) ) return false

      const userPermissions = JSON.parse(localStorage.permissions)
      const urlArray = this.action.split('/')
      
      const resource = this.getResourceFromUrl(urlArray)
      const permission = this.getPermissionFromUrl(urlArray)
      
      if ( !(resource in userPermissions) ) return false

      const userResource = userPermissions[resource]
      
      if (userResource.indexOf(permission) != -1) {
        this.showAction = true
      }
    },

    isArray (subject) {
      return typeof subject == 'object' && subject.length != undefined;
    },

    getResourceFromUrl (urlArray) {
      
      if (!this.isArray(urlArray)) return false

      return urlArray[0]
    },
    
    getPermissionFromUrl (urlArray) {
      if (!this.isArray(urlArray)) return false

      return urlArray[1]
    }
  },
  mounted () {
    this.hasPermission()
  }
}
</script>

