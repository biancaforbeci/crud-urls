<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Editar URL</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Link</label>
                                    <input type="text" class="form-control" v-model="url.link">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Descrição</label>
                                    <input type="text" class="form-control" v-model="url.description">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"update-url",
    data(){
        return {
            url:{
                link:"",
                description:"",
                _method:"patch",
            }
        }
    },
    mounted(){
        this.showUrl()
    },
    methods:{
        async showUrl(){
            let token = localStorage.getItem('user-token');
            await this.axios.get(`/api/url/${this.$route.params.id}`, { headers: {"Authorization" : `Bearer ${token}`} })
            .then(response=>{
                const { link, description } = response.data
                this.url.link = link
                this.url.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            let token = localStorage.getItem('user-token');
            await this.axios.post(`/api/url/${this.$route.params.id}`,this.url, { headers: {"Authorization" : `Bearer ${token}`} })
            .then(response=>{
                this.$router.push({name:"urlList"})
            }).catch(error=>{
                console.log(error)
            })
        },
    }
}
</script>
