import Vue from "vue";
import VueRouter from "vue-router";

import store from '../store/index';

import Auth from "../views/Auth";
import DataPrivacy from "../views/DataPrivacy";
import Home from "../views/Home";
import NoteSectionExplanation from "../views/NoteSectionExplanation";
import TagsOverview from "../views/TagsOverview";

Vue.use(VueRouter);

const router = new VueRouter({
    mode: "history",
    routes: [
        { path: "/", component: Home, name: 'home' },
        {
            path: "/account/:accountId/container/:containerId",
            component: TagsOverview,
            name: "tags",
            props: true,
            meta: {
                secured: true,
            },
        },
        { path: "/authorize/:accessToken", component: Auth, name: "authorize", props: true },
        { path: "/data-privacy", component: DataPrivacy },
        { path: "/note-section-explanation", component: NoteSectionExplanation },
        { path: "*", redirect: "/" },
    ],
});

router.beforeEach((to, from, next) => {
    if (typeof to.meta.secured === 'undefined' || !to.meta.secured) {
        next()
        return
    }

    if (store.getters.isAuthenticated) {
        next()
        return
    }

    // Redirect to home cause user is not logged in
    router.push({ name: 'home' })

    next()
})

export default router
