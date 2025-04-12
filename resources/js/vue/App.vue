<template>
    <div class="container mx-auto" style="border:1px solid black;">
        <router-view></router-view>
    </div>
</template>

<!--Script para ruteo de los componentes-->
<script>
    export default{
        data(){
            return{
                urls:{
                    upload: '/api/post/upload/',
                    postPatch: '/api/post/', 
                    postPost: '/api/post/',
                    postDelete:'/api/post/',
                    postPaginate:'/api/post/',
                    getPostBySlug: '/api/post/slug/',
                    getCategoriesAll:'/api/category/all/',

                }
            }
        }
    }
</script>


<!--
<script>
    import List from './components/ListComponent.vue';

    export default{
        components: {
            List
        }
    }
</script>
--->