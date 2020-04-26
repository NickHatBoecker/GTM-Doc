import axios from "axios";
import store from "../store/index";

axios.defaults.headers.post['Content-Type'] = 'application/json';

axios.interceptors.request.use(
    function (config) {
        if (store.getters.isAuthenticated) {
            config.headers.Authorization = `Bearer ${store.getters.accessToken}`
        }

        store.commit('isLoading', true)

        return config
    },
    function (error) {
        store.commit('isLoading', false)

        // Do something with request error
        return Promise.reject(error)
    },
)

// Add a response interceptor
axios.interceptors.response.use(
    function (response) {
        store.commit('isLoading', false)

        // Do something with response data
        return response
    },
    function (error) {
        store.commit('isLoading', false)

        if (error.message === 'Network Error') {
            store.dispatch('revokeAccessToken')

            return
        }

        if (typeof error.response !== 'undefined' && [401, 403].includes(error.response.status)) {
            // Session expired
            store.dispatch('revokeAccessToken')
            store.commit('setError', '<strong>Warning:</strong> You are not authorized. Maybe your session expired. If so, please <a class="alert-link text-decoration-underline" href="#start">authenticate again</a>.')

            return
        }

        return Promise.reject(error)
    },
)

export default axios
