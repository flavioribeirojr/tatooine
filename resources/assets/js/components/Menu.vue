<template>
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU</li>

        <li v-for="(resources, category) in userMenu" :key="category" class="treeview">
          <a href="#"><i class="fa fa-link"></i><span>{{category}}</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li v-for="(resource, index) in resources" :key="index">
              <a :href="getHref(resource)">{{Object.values(resource)[0]}}</a>
            </li>
          </ul>
        </li>
    </ul>
</template>

<script>
export default {
  data () {
    return {
      userMenu: {},
      routerActive: ''
    }
  },

  methods: {
    getHref (resource) {
      return '/' + this.$baseUrl + '/' + Object.keys(resource)[0]
    }
  },

  created () {
    this.userMenu = JSON.parse(localStorage.menu)
  }
}
</script>

