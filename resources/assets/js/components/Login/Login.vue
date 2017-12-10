<template>
    <form @submit.prevent="loginUser">
        <div class="form-group has-feedback" :class="{'has-error': errors.has('usr_email')}">
            <input 
                type="email" 
                name="usr_email" 
                class="form-control" 
                placeholder="Email"
                v-model="usr_email"
                v-validate="'required|email'"
            />
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
            <span v-if="errors.has('usr_email')" class="help-block">{{ errors.first('usr_email') }}</span>
        </div>
        <div class="form-group has-feedback" :class="{'has-error': errors.has('usr_password')}">
            <input 
                type="password" 
                name="usr_password" 
                class="form-control" 
                placeholder="Senha" 
                v-model="usr_password"
                v-validate="'required'"
            />
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
            <span v-if="errors.has('usr_password')" class="help-block">{{ errors.first('usr_password') }}</span>
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
        usr_email: '',
        usr_password: '',
        loginError: false
      }
  },
  props: ['baseUrl', 'redirectUrl'],
  methods: {
      loginUser () {
        this.$validator.validateAll().then( pass => {
          if (!pass) return;

          axios.post(`${this.baseUrl}/login`, {
            usr_email: this.usr_email, 
            usr_password: this.usr_password
          })
          .then( () => {
            this.mountUserPermissions()
          })
          .catch( () => toastr.error('Credenciais incorretas', 'Erro!') )
        })
      },

      mountUserPermissions() {
        axios.get(`${this.baseUrl}/${this.$url}/users/permissions`)
          .then((serverResponse) => {
            this.saveUserPermissions(serverResponse.data.permissions)

            window.location.replace(this.redirectUrl)
          })
      },

      saveUserPermissions (permissions) {
        const userPermissions = JSON.stringify(permissions)

        Object.defineProperty(localStorage, 'permissions', {
          enumerable: false,
          configurable: false,
          writable: false,
          value: userPermissions
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

    this.$validator.setLocale('br')
  }
}
</script>

