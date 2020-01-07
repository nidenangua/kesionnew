const examMixins = {
    data() {
        let letterArr = [];
        for (var i = 65; i < 91; i++) {
            letterArr.push(String.fromCharCode(i));
        }
        return {
            letters: letterArr
        }
    },
    methods: {
        /**
         * 根据index返回字母
         * @param {Number}
         */
        getLetter(i) {
            return this.letters[i]
        }
    }
}
export default examMixins