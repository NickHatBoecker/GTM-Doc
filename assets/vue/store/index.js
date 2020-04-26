import Vue from "vue";
import Vuex from "vuex";
import router from '../router/index';
import http from '../util/http';

Vue.use(Vuex);

const ACCESS_TOKEN_ID = 'accessToken'

export default new Vuex.Store({
    state: {
        isLoading: false,
        error: null,
        accessToken: '',
        accounts: [],
        tags: [],
        currentContainer: null,
    },

    // store.commit
    mutations: {
        isLoading (state, isLoading) { state.isLoading = isLoading },

        setAccessToken (state, accessToken) {
            state.accessToken = accessToken
        },

        setAccounts (state, accounts) {
            Vue.set(state, 'accounts', accounts)
        },

        setTags (state, tags) {
            Vue.set(state, 'tags', tags)
        },

        setError (state, message) {
            state.error = message
        },

        setCurrentContainer (state, container) {
            state.currentContainer = container
        },
    },

    // store.dispatch
    actions: {
        async initialiseStore ({ dispatch }) {
            // see index.js in root
            dispatch('loadAccessToken')
            await dispatch('loadAccounts')
        },

        saveAccessToken ({ commit }, accessToken) {
            localStorage.setItem(ACCESS_TOKEN_ID, accessToken)
            commit('setAccessToken', accessToken)
        },

        revokeAccessToken ({ commit }) {
            localStorage.removeItem(ACCESS_TOKEN_ID)
            commit('setAccessToken', '')

            if (router.currentRoute.name !== 'home') {
                // Redirect to home
                router.push({ name: 'home' }).catch(err => {})
            }
        },

        loadAccessToken ({ commit }) {
            const accessToken = localStorage.getItem(ACCESS_TOKEN_ID) || null
            commit('setAccessToken', accessToken)
        },

        async loadAccounts (state) {
            if (!state.getters.isAuthenticated) {
                return
            }

            try {
                const response = await http.get('/api/ajax/get-accounts/')
                state.commit('setAccounts', response.data)
            } catch (e) {
                // Do nothing
            }
        },

        async loadTags (state, payload) {
            if (!state.getters.isAuthenticated) {
                return
            }

            try {
                const response = await http.get('/api/ajax/get-tags/', {
                    params: {
                        accountId: payload.accountId,
                        containerId: payload.containerId,
                    },
                })

                state.commit('setTags', response.data)
            } catch (e) {
                // Do nothing
            }
        },
    },

    getters: {
        isLoading: (state) => state.isLoading,
        error: (state) => state.error,
        accessToken: (state) => state.accessToken,
        isAuthenticated: (state) => state.accessToken && state.accessToken.length,
        accounts: (state) => state.accounts,
        tags: (state) => state.tags,
        currentContainer: (state) => state.currentContainer,
    },
})
