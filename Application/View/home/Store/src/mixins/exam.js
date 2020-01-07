const examMixins = {
    data() {
        var letterArr = [];
        for (var i = 65; i < 91; i++) {
            letterArr.push(String.fromCharCode(i));
        }
        return {
            letters: letterArr,
            tkTypes: [{
                    id: '1',
                    name: '简答题'
                },
                {
                    id: '2',
                    name: '单选题'
                },
                {
                    id: '3',
                    name: '多选题'
                },
                {
                    id: '4',
                    name: '判断题'
                },
                {
                    id: '5',
                    name: '填空题'
                },
                {
                    id: '6',
                    name: '组合题'
                }
            ]
        }
    },
    filters: {
        /**
         * 处理答案显示
         * @param {String} ans 
         * @param {Number} tktype 
         */
        filterAnswer(ans, tktype) {
            if (tktype == 3) {
                return ans.join()
            } else if (tktype == 4) {
                return (`${ans}` === '0' && '错误') || (`${ans}` === '1' && '正确') || '暂无答案'
            } else if (tktype == 5) {
                let ansStr = '';
                ans.map((an, i) => {
                    if (i > 0) {
                        ansStr += ` 、 (${an.join(' || ')})`
                    } else {
                        ansStr += `(${an.join(' || ')})`
                    }
                })
                return ansStr
            } else {
                return ans ? ans : '暂无答案'
            }
        },
        /**
         * 过滤html标签
         * @param {String} html 
         */
        filterHtml(html) {
            return html.replace(/\<[^>]+>/gi, '')
        }
    },
    methods: {
        /**
         * 根据题目类型id返回题目类型名称
         * @param {String,Number}  
         */
        getTkTypeName(typeId) {
            if (!typeId) {
                return
            }
            typeId = parseInt(typeId)
            let typeName;
            this.tkTypes.map(item => {
                if (item.id == typeId) {
                    typeName = item.name
                }
            })
            return typeName
        }
    }
}
export default examMixins