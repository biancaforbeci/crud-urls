<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"urlAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Responses Cadastradas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Status</th>
                                    <th>Response</th>
                                    <th>Visualização</th>
                                </tr>
                            </thead>
                            <tbody v-if="responses.length > 0">
                                <tr v-for="(response,key) in responses" :key="key">
                                    <td>{{ response.status_code }}</td>
                                    <td>{{ response.response_http }}</td>
                                    <td>{{ response.html }}</td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">Nenhum response cadastrado para esse usuário !</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"urls",
    data(){
        return {
            responses:[],
            timer: '',
            token: localStorage.getItem('user-token') || ''
        }
    },
    created () {
      this.getResponse()
      this.timer = setInterval(this.getUrls, 3000);
    },
    methods:{
        async getResponse(){
            let token = localStorage.getItem('user-token');
            await this.axios.get(`/api/response/${this.$route.params.id}`, { headers: {"Authorization" : `Bearer ${token}`} })
            .then(response=>{
                this.responses = response.data;
            }).catch(error=>{
                console.log(error)
                this.urls = []
            })
        },
        cancelReload () {
            clearInterval(this.timer);
        }
    },
    beforeDestroy () {
      this.cancelReload();
    }
}
</script>
