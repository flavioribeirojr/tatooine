const url = {
    install (Vue, options) {
        Vue.$baseUrl = process.env.MIX_BASE_ROUTE
    }
}

export default url;