<template>
    <router-link :to="{ name:'save' }">Create</router-link>
    <div>
        <h1>Post List</h1>
    </div>
    <o-table :data="posts.data" :loading="isLoading">
        <o-table-column field="id" label="ID" v-slot="p">
            {{ p.row.id }}
        </o-table-column>
        <o-table-column field="title" label="title" v-slot="p">
            {{ p.row.title }}
        </o-table-column>
        <o-table-column field="posted" label="posted" v-slot="p">
            {{ p.row.posted}}
        </o-table-column>
        <o-table-column field="category_id" label="category" v-slot="p">
            {{ p.row.category.title }}
        </o-table-column>
        <o-table-column field="category_id" label="Actions" v-slot="p">
            <router-link :to="{ name:'save',params:{ 'slug': p.row.slug }}">edit </router-link>
        </o-table-column>
    </o-table>
    <!---Consulta primero si existe data-->
    <o-pagination 
                  v-if="posts.data && posts.data.length > 0"
                  @change="updatePage"
                   :total="posts.total"
                   v-model:current="currentPage" 
                   :range-before="2"
                   :range-after="2"
                   size="small"
                   :simple="false"
                   :rounded="true"
                   :per-page="posts.per_page"
    />

</template>

<script>
export default{
    data(){
        return{
            posts:[],
            isLoading: true,
            currentPage:1
        }
    },

    mounted(){
        this.listPage()
    },

    methods:{
        updatePage(){
            console.log(this.currentPage);
            setTimeout(() => {
                this.listPage()
            },100);
        },
        listPage(){
            this.isLoading = true
            this.$axios.get('/api/post?page='+this.currentPage).then((res)=>{
                this.posts =  res.data,
                this.isLoading = false
            })
        }
    }
}
</script>