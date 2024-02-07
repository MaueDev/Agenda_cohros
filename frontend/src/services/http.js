import axios from "axios";

const axiosInstance = axios.create({
    baseURL: 'http://localhost:37000/',
    Headers: {
        'Content-type' : 'application/json'
    }
}
);

export default axiosInstance;