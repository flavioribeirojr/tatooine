<template>
  <div>
    <vuetable
      ref="vuetable"
      class="table-bordered table-striped"
      :css="css"
      :api-url="url"
      :fields="fields"
      :append-params="filters"
      pagination-path=""
      @vuetable:pagination-data="onPaginationData"
    >
    </vuetable>
    
    <pagination-info 
      ref="paginationInfo"
      :css="css.pagination"
      info-class="pull-left"
      info-template="Exibindo {from} até {to} de {total} itens"
    >
    </pagination-info>
    
    <pagination 
      ref="pagination" 
      @vuetable-pagination:change-page="onChangePage"
      :css="css.pagination"
    >
    </pagination>
  </div>
</template>


<script>
import axios from 'axios'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'

export default {
  components: {
    vuetable: Vuetable,
    pagination: VuetablePagination,
    paginationInfo: VuetablePaginationInfo
  },
  props: ['url', 'userFields', 'userFilters'],
  data () {
    return {
      fields: [],
      filters: {},
      css: {
        tableClass: 'table table-striped table-bordered',
        loadingClass: 'loading',
        ascendingIcon: 'glyphicon glyphicon-chevron-up',
        descendingIcon: 'glyphicon glyphicon-chevron-down',
        handleIcon: 'glyphicon glyphicon-menu-hamburger',
        pagination: {
          infoClass: 'pull-left',
          wrapperClass: 'vuetable-pagination pull-right',
          activeClass: 'btn-primary',
          disabledClass: 'disabled',
          pageClass: 'btn btn-border',
          linkClass: 'btn btn-border',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        }
      }
    }
  },
  methods: {
    assocUserFields () {
      const userFields = this.userFields

      for (let prop in userFields) {
        
        this.fields.push({
          name: prop,
          title: userFields[prop]
        })

      }
    },

    assocUserFilters () {
      Object.keys(this.userFilters).map(filter => this.$set(this.filters, filter, '') )
    },

    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },

    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    }
  },
  created () {
    this.assocUserFields()
    this.assocUserFilters()
  }
}
</script>
