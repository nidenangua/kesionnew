import timg from '@/assets/dragpc/timg.jpg'
export default [{
        "name": "轮播图",
        "flag": false,
        "list": [{
            "type": "swiper",
            "height": "420px",
            "style": 1,
            "list": [{
                "img": "/Images/images/201806/5b189d39c63a7.png"
            }]
        }],
    },
    {
        "name": "知识模块",
        "flag": false,
        "list": [{
                "type": "course",
                "style": 2,
                "title": {
                    "name": "标题",
                    "more": []
                },
                "api": {
                    "act": "appCourse",
                    "maxperpage": 8
                }
            },

        ]
    },
    {
        "name": "直播模块",
        "flag": false,
        "list": [{
                "type": "course",
                "style": 1,
                "title": {
                    "name": "标题",
                    "more": []
                },

                "api": {
                    "act": "appCourse",
                    "maxperpage": 6
                }
            },

        ]
    },

    {
        "name": "产品分类",
        "flag": false,
        "list": [{
                "type": "course",
                "style": 5,
                "title": {
                    "name": "标题",
                    "more": []
                },
                "api": {
                    "act": "appCourse",
                    "maxperpage": 15
                },
                "other": {
                    "banner": {
                        "url": "",
                        "src": "/Public/common/images/pc/20195298721.jpg"
                    }
                }
            },
            {
                "type": "course",
                "style": 4,
                "title": {
                    "name": "标题",
                    "more": []
                },
                "api": {
                    "act": "appCourse",
                    "maxperpage": 10
                },
                "other": {
                    "banner": {
                        "url": "",
                        "src": "/Public/common/images/pc/20195298721.jpg"
                    }
                }
            },
            {
                "type": "course",
                "style": 3,
                "title": {
                    "name": "标题",
                    "more": []
                },
                "api": {
                    "act": "appCourse",
                    "maxperpage": 6
                },
                "other": {
                    "banner": {
                        "url": "",
                        "src": "/Public/common/images/pc/201707246090.jpg"
                    }
                }
            },

        ]
    },
    {
        "name": "老师模块",
        "flag": false,
        "list": [{
            "type": "teacher",
            "style": 1,
            "title": {
                "name": "名师大咖",
                "more": [{
                    "text": "查看全部",
                    "url": "#/teacher"
                }]
            },
            "api": {
                "act": "appTeacher",
                "maxperpage": 5
            }
        }]
    },
    {
        "name": "新闻模块",
        "flag": false,
        "list": [{
            "type": "news",
            "style": 1,
            "title": {
                "name": "热门头条",
                "more": [{
                    "text": "查看更多",
                    "url": "#/news"
                }]
            },
            "api": {
                "act": "appNews",
                "maxperpage": 7
            }
        }]
    },
    {
        "name": "富文本",
        "flag": false,
        "list": [{
            "type": "richtext",
            "code": `
					<div class="md-richtext-title">课堂街，让知识变得更有价值课堂街，让知识变得更有价值</div>
					<div class="md-richtext-cont">
						<p>自从我们进入信息时代，我们跟互联网的关系是越来越密不可分，实际它已经从根本上改变了我们的生活。教育是一个人一辈子最重要的一个工程，它伴随着我们的一生也影响这我们的一生，网络早已经成为我们生存和发展的交流工具；当他们两者结合势必会带来对社会新的冲击。所以越来越多的人投入了其中。</p>
						<p><img src="${timg}" /></p>
					</div>`
        }]
    }

]