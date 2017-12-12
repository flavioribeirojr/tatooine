const axios = require('axios')

const Http = axios.create({
    baseURL: '/' + process.env.MIX_BASE_ROUTE
})

export default Http
