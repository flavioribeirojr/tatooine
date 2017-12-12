<style>
  .btn-grid {
    display: inline-block;
    margin-right: 7px;
  }
</style>


<template>
  <div>
    <action 
      v-for="(action, index) in actions"
      class="btn-grid"
      :key="index"
      :action="action.url + '/' + primaryKey"
      :aclass="getClass(action)"
      :icon="getIcon(action)"
      :type="getType(action)"
      @btn-clicked="doDelete(action.url, action.method)"
    >
    </action>
  </div>
</template>


<script>
import Http from '../axios'
import Action from './Action'

export default {
  components: {
    action: Action
  },

  props: ['actions', 'primaryKey'],

  methods: {
    getClass (action) {
      switch (action.method) {
        case 'edit':
          return 'btn btn-warning btn-sm'
        case 'delete':
          return 'btn btn-danger btn-sm'
        case 'details':
          return 'btn btn-info btn-sm'
      }
    },

    getIcon (action) {
      switch (action.method) {
        case 'edit':
          return 'fa fa-pencil'
        case 'delete':
          return 'fa fa-trash'
        case 'details':
          return 'fa fa-cogs'
      }
    },

    getType (action) {
      switch (action.method) {
        case 'edit':
          return 'anchor'
        case 'delete':
          return 'button'
        case 'details':
          return 'anchor'
      }
    },

    doDelete (url, method) {
      if (method == 'delete') {
        swal({
          title: 'Do you confirm?',
          text: 'After that you will not be able to recover the register',
          type: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        })
        .then( (result) => {
          if (!result.value) return

          Http.post(`/${url}/${this.primaryKey}`)
            .then( () => this.$emit('delete') )

        })
      }
    }
  }
}
</script>
