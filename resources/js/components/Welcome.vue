<template>
    <div class="container mt-5">
        <div class="col-12 text-center">

            <div class="container p-5">
                <h3 class="text-center mt-2 mb-5">CREDPAGO</h3>
              <div class="col-md-12">

          <form v-on:submit.prevent="login_user">

            <div class="mb-3">
              <label for="exampleFormControlInput2" class="form-label">Enter Email</label>
              <input type="text" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Email" v-model="form.email">
            </div>
            <div class="mb-3">
              <label for="exampleFormControlInput3" class="form-label">Enter Password</label>
              <input type="password" name="password" class="form-control" id="exampleInputPass1" aria-describedby="passHelp" placeholder="Enter Password" v-model="form.password">
            </div>


            <button type="submit" class="btn btn-primary mt-5">Submit</button>
          </form>
          </div>
          </div>


        </div>
    </div>
</template>

<script>
export default {

data(){
  return {

    form:{
      email: '',
      password: ''

    }
  }
},
  methods:{

     login_user(){

        axios.post('/api/login',this.form).then((resp) =>{

        if (resp.data.status == "error") {
          console.log("Acesso negado");
          return;
        }
         const token = resp.data.response.access_token;
         localStorage.setItem('user-token', token)
         this.$router.push({name:"urlList"})
      })
      .catch((e)=>{
          console.log(e);
      })
    }
  }

}
</script>
