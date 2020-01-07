
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>音乐播放器</title>
    <script>
        var music = [
            "<?php echo Img($chapter['videoId']);?>",
            "Aoa - 猫步轻悄(Like A Cat).mp3",
            "Aoa - 短裙.mp3",
            "Bye Bye Sea - 星光瀑布.mp3",
            "EXO-K - MAMA - 2012Mnet M!CountDown现场.mp3"
        ];
 
        var index = 0;
        var playtype;
 
        window.onload = function (){
            var typesel = document.getElementById("typesel");
            typesel.onchange = function (){
                window.playtype = typesel.value;//获取下拉菜单的值
            }
            var player = document.getElementById("player");
            player.src = music[index];   //指定播放器播放哪个音乐
            player.onended = function ()  //当前音乐结束后执行
            {
                if (playtype == "random")
                {
                    index = Math.floor(Math.random() * music.length);
                    player.src = music[index];
                }
                else
                {
                    player.src = music[++index % music.length];
                }
                player.play();
            }
        }
    </script>
</head>
<body>
    <select id="typesel" style="display: none;">
        <option value="sequence">顺序播放</option>
        <option value="random">随机播放</option>
    </select>
    <audio id="player" style="width:500px" controls>不能播放</audio>
</body>
</html>