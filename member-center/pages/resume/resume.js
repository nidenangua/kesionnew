return {
    data: function() {
        return {
            state: store.state,
            /**用户信息 */
            userInfo: {},

            /*当前标签页 */
            activeName: 'first',

        }
    },
    watch: {
        '$route.name': function(name) {
            if (name == 'ResumePersonal') {
                this.activeName = 'first'
            } else if (name == 'ResumeIntention') {
                this.activeName = 'second'
            } else if (name == 'ResumeExperience') {
                this.activeName = 'third'
            } else if (name == 'ResumeEducation') {
                this.activeName = 'four'
            } else if (name == 'ResumeTrain') {
                this.activeName = 'five'
            } else if (name == 'ResumeRecord') {
                this.activeName = 'six'
            } else if (name == 'ResumeStatus') {
                this.activeName = 'seven'
            } else if (name == 'ResumeRecommend') {
                this.activeName = 'eight'
            }
        }
    },
    methods: {
        /**标签页回调
         */
        handleClick: function(tab) {
            if (tab.index == 0) {
                this.$router.push({
                    name: 'ResumePersonal'
                })
            } else if (tab.index == 1) {
                this.$router.push({
                    name: 'ResumeIntention'
                })
            } else if (tab.index == 2) {
                this.$router.push({
                    name: 'ResumeExperience'
                })
            } else if (tab.index == 3) {
                this.$router.push({
                    name: 'ResumeEducation'
                })
            } else if (tab.index == 4) {
                this.$router.push({
                    name: 'ResumeTrain'
                })
            } else if (tab.index == 5) {
                this.$router.push({
                    name: 'ResumeRecord'
                })
            } else if (tab.index == 6) {
                this.$router.push({
                    name: 'ResumeStatus'
                })
            } else if (tab.index == 7) {
                this.$router.push({
                    name: 'ResumeRecommend'
                })
            }
        },


    },
    mounted: function() {
        var that = this

    },
    activated: function() {

        if (this.$route.name == 'ResumePersonal') {
            this.activeName = 'first'
        } else if (this.$route.name == 'ResumeIntention') {
            this.activeName = 'second'
        } else if (this.$route.name == 'ResumeExperience') {
            this.activeName = 'third'
        } else if (this.$route.name == 'ResumeEducation') {
            this.activeName = 'four'
        } else if (this.$route.name == 'ResumeTrain') {
            this.activeName = 'five'
        } else if (this.$route.name == 'ResumeRecord') {
            this.activeName = 'six'
        } else if (this.$route.name == 'ResumeStatus') {
            this.activeName = 'seven'
        } else if (this.$route.name == 'ResumeRecommend') {
            this.activeName = 'eight'
        }

    }
}