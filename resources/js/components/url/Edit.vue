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
                                    <label>Title</label>
                                    <input type="text" class="form-control" v-model="url.link">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Description</label>
                                    <input type="text" class="form-control" v-model="url.description">
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Update</button>
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
                _method:"patch"
            }
        }
    },
    mounted(){
        this.showUrl()
    },
    methods:{
        async showUrl(){
            await this.axios.get(`/api/url/${this.$route.params.id}`).then(response=>{
                const { link, description } = response.data
                this.url.link = link
                this.url.description = description
            }).catch(error=>{
                console.log(error)
            })
        },
        async update(){
            await this.axios.post(`/api/url/${this.$route.params.id}`,this.url).then(response=>{
                this.$router.push({name:"urlList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>
