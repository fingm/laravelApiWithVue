<template>
    <!--<router-link :to="{ name:'save' }">Create</router-link>-->
   
    <div>

        
        <o-modal v-model:active="confirmDeleteAction">
            <div class="p-4">
                <p>Seguro que quieres eliminar el registro?</p>
                <div class="flex flex-row-reverse gap-21 bg-gray-100 p-3">
                    <o-button variant="danger" @click="deletePost">Delete</o-button>
                    <o-button  @click="confirmDeleteAction=false">Cancel</o-button>
                </div>
            </div>
        </o-modal>

        <h1 class="text-4xl mb-3">Post List</h1>
        
        <o-button iconLeft="plus" variant="primary" @click="$router.push({ name:'save' })">Create</o-button>

        <div class="mt-5"></div>
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
            <router-link class="mr-3" :to="{ name:'save',params:{ 'slug': p.row.slug }}">edit </router-link>
            <o-button iconLeft="delete" size="small" rounded variant="danger" @click="deletePostRow = p; confirmDeleteAction=true">Delete</o-button>
        </o-table-column>
        </o-table>
        <div class="mb-4"></div>
    </div>

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
            currentPage:1,
            confirmDeleteAction:false,
            deletePostRow: ''
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
            this.confirmDeleteAction = false;
            this.isLoading = true
            this.$axios.get('/api/post?page='+this.currentPage).then((res)=>{
                this.posts =  res.data,
                this.isLoading = false
            })
        },
        deletePost(){
            this.confirmDeleteAction = false;
            //Pops ups cuando eliminamos un elemento
            this.$oruga.notification.open({
                message: 'Delete success',
                position: 'bottom-right',
                variant: 'danger',
                closable:true,
            })

            this.$axios.delete('/api/post/'+this.deletePostRow.row.id)
            this.posts.data.splice(this.deletePostRow.indexOf,1)
        }
    }
}
</script>