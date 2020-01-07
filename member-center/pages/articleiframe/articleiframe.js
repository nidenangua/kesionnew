return {
    data: function () {
        return {
            iframeUrl: "/plus/content/postinfo.aspx?classId=0&InfoID=0",
        }
    },
    methods: {
        /**自适应iframe的高度 */
        changeFrameHeight: function () {
            this.timer = setInterval(function () {
                var ifm = document.getElementById("iframe");
              
                var subWeb = document.frames
                    ? document.frames["iframe"].document
                    : ifm.contentDocument;
                if (ifm != null && subWeb != null) {
                    ifm.height = "auto"; //取消掉之前iframe设置的高度
                    ifm.height = (subWeb.body.scrollHeight+10) + "px";
                }
            }, 500)
        },
    },
    activated:function(){
            this.iframeUrl = '/plus/content/postinfo.aspx?classId='+this.$route.query.classId+'&InfoID='+this.$route.query.InfoID
 
    }
}