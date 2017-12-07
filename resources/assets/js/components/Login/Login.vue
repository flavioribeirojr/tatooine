<template>
    <form @submit.prevent="loginUser">
        <div class="form-group has-feedback" :class="{'has-error': errors.has('email')}">
            <input 
                type="email" 
                name="email" 
                class="form-control" 
                placeholder="Email" 
                v-model="email"
                v-validate="'required|email'"
            />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span v-if="errors.has('email')" class="help-block">{{ errors.first('email') }}</span>
        </div>
        <div class="form-group has-feedback" :class="{'has-error': errors.has('password')}">
            <input 
                type="password" 
                name="password" 
                class="form-control" 
                placeholder="Senha" 
                v-model="password"
                v-validate="'required'"
            />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span v-if="errors.has('password')" class="help-block">{{ errors.first('password') }}</span>
        </div>
        <div class="row">
            <div class="col-xs-offset-8 col-xs-4">
                <button type="submit" class="btn btn-primary btn-block btn-flat">Login</button>
            </div>
        </div>
    </form> 
</template>

<script>
import axios from 'axios';

export default {
  data () {
      return {
        email: '',
        password: ''
      }
  },
  methods: {
      loginUser () {
        this.$validator.validateAll().then( pass => {
          if (!pass) return;


        })
      }
  },

  mounted () {
    this.$validator.updateDictionary({
      br: {
        messages: {
          required: () => 'Campo obrigatório',
          email: () => 'E-mail inválido'
        }
      }
    })
  }
}
</script>

