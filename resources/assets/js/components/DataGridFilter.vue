<template>
  <div>
    <div v-for="(filter, index) in gridFilters" :key="index" :class="'form-group col-md-' + filter.size">
      <label :for="index" class="label-control">{{filter.title}}</label>
      
      <input v-if="isInput(filter.type)" type="text" :name="index" class="form-control" @keyup="emitFilterValue" :placeholder="filter.title">
      
      <select :name="index" v-if="filter.type=='select'" class="form-control" @change="emitFilterValue">
        <option value="">All</option>
        <option v-for="(option, index) in filter.options" :key="index" :value="index">{{option}}</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  props: ['filters'],

  data () {
    return {
      gridFilters: this.filters
    }
  },

  methods: {
    isInput (type) {
      return ['text', 'number'].indexOf(type) != -1
    },

    emitFilterValue (e) {
      this.$emit('filter', {name: e.target.name, value: e.target.value})
    }
  }
}
</script>
