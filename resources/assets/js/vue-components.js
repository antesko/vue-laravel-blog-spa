Vue.component('loader',
    require('./components/helpers/Loader.vue')
);

Vue.component(
    'header-navbar',
    require('./components/navigation/Navbar.vue')
);

Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue')
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue')
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue')
);