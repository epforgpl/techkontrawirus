<!-- Credit: based on https://github.com/tushargugnani/vue-simple-form-wizard -->

<template>
    <div v-show="isActive"><slot></slot></div>
</template>

<script>
    export default{
        name: 'tab',
        props: {
            name:{required: true},
            info:{},
            selected: { default: false}
        },
        data(){
            return{
                isActive: false,
            }
        },
        created(){
            this.isActive = this.selected
        },
    }
</script>

<style>
</style>
