<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"urlAdd"}' class="btn btn-primary">Create</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>URL's Cadastradas</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Link</th>
                                    <th>Status</th>
                                    <th>Descrição</th>
                                    <th>Reponse</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody v-if="urls.length > 0">
                                <tr v-for="(url,key) in urls" :key="key">
                                    <td>{{ url.link }}</td>
                                    <td>{{ url.status_code }}</td>
                                    <td>{{ url.description }}</td>
                                    <td>{{ url.response_http }}</td>
                                    <td>
                                        <router-link :to='{name:"urlEdit",params:{id:url.id}}' class="btn btn-success">Edit</router-link>
                                        <button type="button" @click="deleteUrl(url.id)" class="btn btn-danger">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">Nenhuma url cadastrada para esse usuário !</td>
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
            urls:[]
        }
    },
    mounted(){
        this.getUrls()
    },
    methods:{
        async getUrls(){
            await this.axios.get('/api/url').then(response=>{
                this.urls = response.data
            }).catch(error=>{
                console.log(error)
                this.urls = []
            })
        },
        deleteUrl(id){
            if(confirm("Tem certeza que deseja excluir essa URL ?")){
                this.axios.delete(`/api/url/${id}`).then(response=>{
                    this.getUrls()
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>
