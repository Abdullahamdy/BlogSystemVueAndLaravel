<template>
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="login-form">
          <form action="/examples/actions/confirmation.php" method="post" nonvalidate>
              <h2 class="text-center">Log in</h2>
              <div class="form-group">
                  <input type="text" class="form-control" v-model="email" placeholder="email">
                  <div class="text-danger" v-show="emailError">
                    the email  is not valid
                </div>
                </div>
              <div class="form-group">
                  <input type="password" v-model="password" class="form-control" placeholder="Password">
                  <div class="text-danger" v-show="passwordError">
                    the password  is to short
                </div>
                </div>
              <div class="form-group">
                  <button :disabled="!isValidForm" @click.prevent="loginForm" type="submit" class="btn btn-primary btn-block">Log in</button>
              </div>
              <div class="clearfix">
                  <a href="#" class="pull-right">Forgot Password?</a>
              </div>
          </form>
          <p class="text-center"><a class="switch-toregister-modal" href="#">Create an Account</a></p>
        </div>
      </div>
    </div>
  </div>
 </div>
  </template>
  <script>
  export default {
    data(){
        return {
            password:'',
            email:'',
        }
    },
    computed:{

        emailError(){
            return !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email)) && this.email.length > 0;
        },
        passwordError(){
            return this.password.length > 0 && this.password.length < 7;
        },
        isValidForm(){
            return this.password.length > 7 && (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(this.email))

        }


    },
    methods:{
        loginForm(){
            let {email,password} = this;
            this.$store.dispatch('LoginUser',{email,password})
        }
    }
}
  </script>
