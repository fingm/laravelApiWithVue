<template>
    <div>
        <h1>Post List</h1>
    </div>
    <o-table :data="posts">
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
    </o-table>
</template>

<script>
export default{
    data(){
        return{
            posts:[],
            isLoading: true
        }
    },

    mounted(){
        this.$axios.get('/api/post').then((res)=>{
           this.posts =  res.data.data,
           this.isLoading = false
        })
    },

    methods:{
        clickMe(){
            alert('Oruga');
        }
    }
}
</script>