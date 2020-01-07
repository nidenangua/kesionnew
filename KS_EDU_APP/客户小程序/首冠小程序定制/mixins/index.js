var MIXINS = {
    exam:{
        data: function() {
          var letterArr = [];
      
          for (var i = 65; i < 91; i++) {
            letterArr.push(String.fromCharCode(i));
          }
      
          return {
            letters: letterArr
          };
        },
        methods: {
          /**
           * 根据下标返回字母
           * @param {Number}
           */
          getLetter: function(i) {
            return this.letters[i];
          },
      
          /**
           * 根据子母返回下标
           * @param {Number}
           */
          getLetterIndex: function (letter) {
            var index = 0;
            this.letters.map(function (ltr, i) {
              if (ltr == letter) {
                index = i;
              }
            });
            return index;
          }
        }
    }
}
export default MIXINS