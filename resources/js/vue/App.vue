<template>
    <div>
        <h1>Principal</h1>
        <router-view></router-view>
    </div>
</template>
<script>
    import List from './components/ListComponent.vue';

    export default{
        components: {
            List
        }
    }
</script>
