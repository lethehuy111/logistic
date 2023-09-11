<template>
  <div class="vh-100 d-flex justify-content-center align-items-center">
    <div class="col-md-4 p-5 shadow-sm border rounded-3">
      <h2 class="text-center mb-4 text-primary">Login Form </h2>
      <form @submit.prevent="login">
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Username : </label>
          <input type="email" class="form-control border border-primary" v-model="userForm.email" aria-describedby="emailHelp"
                 required>
          <span class="invalid-feedback" role="alert">
            <strong></strong>
          </span>
        </div>
        <div class="mb-3">
          <label for="exampleInputPassword1" class="form-label">Password : </label>
          <input type="password" v-model="userForm.password" class="form-control border border-primary" required>
          <span class="invalid-feedback" role="alert">
            <strong></strong>
          </span>
        </div>
        <!--        <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p>-->
        <div class="d-grid">
          <button class="btn btn-primary" type="submit">Login</button>
        </div>
      </form>
      <div class="mt-3">
        <!--        <p class="mb-0  text-center">Don't have an account? <a href="signup.html" class="text-primary fw-bold">Sign-->
        <!--          Up</a></p>-->
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'LoginPage',
  layout: 'none',
  middleware: ['guest'],
  data() {
    return {
      userForm: {
        email: '',
        password: ''
      }
    }
  },
  methods: {
     async login() {
       let result = await this.$auth.login({
         data: this.userForm
       }).then(response => {
         // Handle response
         this.$router.push('/');
       })
         .catch(err => {
           this.$swal({
             icon: 'error',
             text: 'Email or password is wrong!'
           })
         });
     }
  }
}
</script>
