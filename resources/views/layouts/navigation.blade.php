<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">SimpleBlog</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse pull-right">

            <ul class="nav navbar-nav">
                <router-link :to="{ name: 'login' }" tag="li">
                    <a>Login</a>
                </router-link>

                <router-link :to="{ name: 'register' }" tag="li">
                    <a>Register</a>
                </router-link>

                <router-link :to="{ name: 'postsList' }" tag="li">
                    <a>Posts</a>
                </router-link>

                <router-link :to="{ name: 'profile' }" tag="li">
                    <a>Profile</a>
                </router-link>

                <router-link :to="{ name: 'createPost' }" tag="button" class="btn btn-primary">
                    Create
                </router-link>
            </ul>

        </div>
    </div>
</nav>