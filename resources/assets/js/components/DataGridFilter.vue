<template>
  <div>
    <div v-for="(filter, index) in filters" :key="index" class="col-md-3">
      <input v-if="isInput(filter.type)" type="text" :name="index" class="form-control" @keyup="emitFilterValue" :placeholder="filter.title">

      <select :name="index" v-if="filter.type=='select'" class="form-control" @change="emitFilterValue">
        <option selected hidden disabled>{{filter.title}}</option>
        <option v-for="(option, index) in filter.options" :key="index" :value="index">{{option}}</option>
      </select>
    </div>
  </div>
</template>

<script>
export default {
  props: ['filters'],  

  methods: {
    isInput (type) {
      return ['text', 'number'].indexOf(type) != -1
    },

    emitFilterValue (e) {
      console.log({name: e.target.name, value: e.target.value})
      this.$emit('filter', {name: e.target.name, value: e.target.value})
    }
  }
}
</script>
