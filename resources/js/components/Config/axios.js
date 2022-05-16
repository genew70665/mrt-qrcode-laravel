import axios from "axios";

var token = localStorage.getItem('user-info')
    ? JSON.parse(localStorage.getItem('user-info')).access_token
    : "";

const instance = axios.create({
    baseURL: "https://dev.mrtlabs.ithands.net/api/",
});

instance.defaults.headers.common["Authorization"] = `Bearer ${token}`;

instance.interceptors.response.use(response => response, error => {
    if (error.response.status === 401) {
        if (error.response.data.code === 2) {
            return Promise.reject(error);
        } if (error.response.data.code === 1) {
            return Promise.reject(error);
        } if (error.response.data.code === 3) {
            return Promise.reject(error);
        } else {
            localStorage.clear();
            window.location = '/';
        }
    }

});

export default instance;
