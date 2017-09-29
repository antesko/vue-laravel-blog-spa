<template>
    <ul class="nav navbar-nav">

        <router-link :to="{ name: 'login' }" tag="li" v-show="!isAuthenticated">
            <a>Login</a>
        </router-link>

        <router-link :to="{ name: 'register' }" tag="li" v-show="!isAuthenticated">
            <a>Register</a>
        </router-link>

        <router-link :to="{ name: 'postsList' }" tag="li" v-show="isAuthenticated">
            <a>Posts</a>
        </router-link>

        <router-link :to="{ name: 'profile' }" tag="li" v-show="isAuthenticated">
            <a>Profile</a>
        </router-link>

        <router-link :to="{ name: 'createPost' }" tag="button" class="btn btn-primary" v-show="isAuthenticated">
            Create
        </router-link>

        <li v-show="isAuthenticated">
            <a href="#" @click="logout">Logout</a>
        </li>
    </ul>
</template>

<script>
    export default {
        methods: {
            logout() {
                this.$auth.destroyToken()
                location.replace('/login')
                //this.$router.push("/login");
            }
        },

        computed: {
            isAuthenticated() {
                return this.$auth.isAuthenticated()
            }
        }
    }
</script>