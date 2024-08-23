<template>
    <div>
        
        <div class="form-group has-feedback">
            <label for="search" class="sr-only">Search</label>
            <input type="text" class="text-center form-control" name="title" id="" placeholder="Kata Kunci | Nama Pekerjaan | Posisi" v-model="keyword">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
        </div>
        
        <!-- <input type="text" name="title" class="form-control text-center" placeholder="Apa yang ingin Anda cari?" v-model="keyword"> -->

        <div class="form-group has-feedback" v-if="results.length > 0">
            <ul class="list-group">
                <li class="list-group-item " style="color:black" v-for="result in results" :key="result.title" v-link="result.position"> 
                    <a style="color:black" :href=" '/jobs/'+result.id+'/'+result.slug+'/' ">
                        {{result.title}}
                        <div class="py-1"></div>
                        <small class="badge badge-success text-break">
                            {{result.position}}
                        </small>
                    </a>
                </li>
            </ul>
        </div>

    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        data(){
            return{
                keyword:null,
                results: []
            }
        },
        watch:{
            keyword(after, before){
                this.searchJob();
            }
        },
        methods:{
            searchJob(){
                
                if(this.keyword.length > 1){
                    axios.get('/jobs/search', { params: { keyword: this.keyword} } ) 
                        .then(response=>this.results=response.data)
                        .catch(error=>{});
                }
            }
        },
    }
</script>
