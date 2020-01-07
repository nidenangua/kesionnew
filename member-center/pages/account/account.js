return {
    data: function() {
        return {
            state: store.state,

            /**用户信息 */
            userInfo: {},
        }
    },
    methods: {

        openView: function(url) {
            this.$router.push(url)
        }

    },
    mounted: function() {
        var that = this
        that.$store.ready(function(state) {
            that.userInfo = state.userInfo
            that.state = state

        })

    }
}