<template>
    <div>
        <Spinner v-if="authUserLoading" />
        <div class="user-box text-center" v-else>
            <img
                :src="authUser.data.attributes.avatar"
                alt="user-img"
                class="rounded-circle img-thumbnail avatar-lg"
            >
            <div class="">
                <a
                    href="#"
                    class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                >{{ authUser.data.attributes.full_name }}</a>
            </div>
            <p class="text-muted">{{ authUser.data.attributes.roles[0] }}</p>
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a
                        href="#"
                        class="text-muted"
                    >
                        <i class="mdi mdi-cog"></i>
                    </a>
                </li>

                <li class="list-inline-item">
                    <a
                        href="#"
                        class="text-custom"
                    >
                        <i class="mdi mdi-power"></i>
                    </a>
                </li>
            </ul>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <ul
                id="side-menu"
                class="metismenu"
            >
                <li class="menu-title">Navigation</li>

                <li class="active">
                    <router-link
                        tag="a"
                        to="/admin"
                        :class="$route.name === 'dashboard' ? 'active' : ''"
                    >
                        <i class="mdi mdi-view-dashboard"></i>
                        <span> Dashboard </span>
                    </router-link>
                </li>

                <li>
                    <a
                        href="javascript: void(0);"
                        class="waves-effect"
                        :class="$route.name === 'users' ? 'active' : ''"
                    >
                        <i class="mdi mdi-account-multiple-outline"></i>
                        <span> Пользователи </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul
                        class="nav-second-level nav"
                        aria-expanded="false"
                    >
                        <li>
                            <router-link :to="{name: 'users'}">Управление</router-link>
                        </li>
                        <li>
                            <router-link :to="{name: 'users'}">Роли</router-link>
                        </li>
                    </ul>
                </li>
                <li>
                    <a
                        href="javascript: void(0);"
                        class="waves-effect"
                    >
                        <i class="mdi mdi-share-variant"></i>
                        <span> Multi Level </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <ul
                        class="nav-second-level nav"
                        aria-expanded="false"
                    >
                        <li>
                            <a href="javascript: void(0);">Level 1.1</a>
                        </li>
                        <li>
                            <a
                                href="javascript: void(0);"
                                aria-expanded="false"
                            >Level 1.2
                                <span class="menu-arrow"></span>
                            </a>
                            <ul
                                class="nav-third-level nav"
                                aria-expanded="false"
                            >
                                <li>
                                    <a href="javascript: void(0);">Level 2.1</a>
                                </li>
                                <li>
                                    <a href="javascript: void(0);">Level 2.2</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>

            </ul>
            <div class="clearfix"></div>
        </div>
        <!-- End Sidebar -->
    </div>
</template>

<script>
import MetisMenu from 'metismenujs/dist/metismenujs'
import Spinner from "./Spinner";
export default {
    name: "SideNav",
    components: {Spinner},
    props: {
        authUser: {
            type: Object,
            required: false,
            default: () => ({}),
        },
        authUserLoading: {
            type: Boolean,
            required: false,
            default: () => false,
        },
    },
    mounted: function() {
        // eslint-disable-next-line no-unused-vars
        var menuRef = new MetisMenu('#side-menu');
    },
    methods: {},
}
</script>

