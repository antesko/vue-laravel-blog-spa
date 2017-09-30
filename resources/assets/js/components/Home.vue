<template>
    <div class="col-md-8 col-md-offset-2 text-center">
        <h3>Welcome to SimpleBlog!</h3>

        <span>You can</span>

        <router-link :to="{ name: 'postsList' }" tag="a" class="home-link">
            <span>read blog posts</span>
        </router-link>,

        <router-link :to="{ name: 'createPost' }" tag="a" class="home-link">
            <span>create new post</span>
        </router-link>, or

        <router-link :to="{ name: 'profile' }" tag="a" class="home-link">
            <span>edit your profile</span>
        </router-link>

    </div>
</template>

<script>
    export default {}
</script>

<style scoped>

</style>