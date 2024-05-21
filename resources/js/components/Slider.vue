<template>
 <div id = "app">
        <button class="btn btn-primary" v-on:click="imgVisibility = false">&lt;</button>
        <transition name="img">
            <p v-if="imgVisibility = !imgVisibility">
               123
            </p>
        </transition>
        <button type="button" class="btn btn-primary" aria-label="Left Align">&gt;</button>
    </div> 
</template>

<script>

</script>

<style scoped>

</style>
