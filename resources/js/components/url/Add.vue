<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Adicionar nova URL</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Endereço da URL</label>
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
                                <button type="submit" class="btn btn-primary">Save</button>
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
    name:"add-url",
    data(){
        return {
            url:{
                link:"",
                description:""
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/url',this.url).then(response=>{
                this.$router.push({name:"urlList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
