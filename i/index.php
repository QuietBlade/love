<?php
    require 'db.php';
    if(empty($_GET)){  //初始化GET 通过ID查找文章
        header("Location:index.php?id=0");
    }

	$db = new dbsql;
    $id = $db->sql_replace($_GET['id']); //过滤为纯数字
    $now = $db->read($id);
    $text = json_decode($now['love_text'], true);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<!-- saved from url=(0027)http://itzoo.info/love.html -->
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title> Apple </title>
        <link rel="icon" href="/apple.ico" type="image/x-icon" />
        <link type="text/css" rel="stylesheet" href="./Love_files/default.css">
        <script type="text/javascript" src="./Love_files/jquery.min.js"></script>
        <script type="text/javascript" src="./Love_files/jscex.min.js"></script>
        <script type="text/javascript" src="./Love_files/jscex-parser.js"></script>
        <script type="text/javascript" src="./Love_files/jscex-jit.js"></script>
        <script type="text/javascript" src="./Love_files/jscex-builderbase.min.js"></script>
        <script type="text/javascript" src="./Love_files/jscex-async.min.js"></script>
        <script type="text/javascript" src="./Love_files/jscex-async-powerpack.min.js"></script>
        <script type="text/javascript" src="./Love_files/functions.js" charset="utf-8"></script>
        <script type="text/javascript" src="./Love_files/love.js" charset="utf-8"></script>

    </head>
    <body>
        <div id="main">
            <div id="error">亲，您使用的浏览器无法支持即将显示的内容，请换成chrome内核浏览<a href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html?hl=zh-CN&brand=CHMI">Chrome</a>)或者使用<a href="http://firefox.com.cn/download/">Firefox</a>)浏览器哟~</div>
            <div id="wrap">
               <div id="text">
                    <div id="code">                 
                        <?php
                            foreach($text as $value)
                                echo "<span class=\"say\">{$value}</span><br />";
                        ?>
                        <br>
                        <br>
                        <span class="say">愿你能被世界温柔相待</span>
                        <br />
                        <br />
                        <span class="say">&emsp;<?php echo $now['love_date']; //日期 ?> </span>
                    </div> 
                </div>

                <!--
                <div id="clock-box">
                    <a href="" target="_blank">B</a> �?<a href="" target="_blank">B</a> 在一起的
                        <div id="clock"></div>
                </div>             
                <!--这是注释的是 A Or B 在一 起的 Date(时间),注释之后只有文字-->
                <canvas id="canvas" width="1100" height="680"></canvas>
            </div>
            <audio src="love.mp3" autoplay="autoplay" loop="loop"></audio> <!--这里是背景音乐的位置-->
        </div>
    
    <script>
    </script>

    <script>
    (function(){
        var canvas = $('#canvas');

        if (!canvas[0].getContext) {
            $("#error").show();
            return false;
        }

        var width = canvas.width();
        var height = canvas.height();
        
        canvas.attr("width", width);
        canvas.attr("height", height);

        var opts = {
            seed: {
                x: width / 2 - 20,
                color: "rgb(190, 26, 37)",
                scale: 2
            },
            branch: [
                [535, 680, 570, 250, 500, 200, 30, 100, [
                    [540, 500, 455, 417, 340, 400, 13, 100, [
                        [450, 435, 434, 430, 394, 395, 2, 40]
                    ]],
                    [550, 445, 600, 356, 680, 345, 12, 100, [
                        [578, 400, 648, 409, 661, 426, 3, 80]
                    ]],
                    [539, 281, 537, 248, 534, 217, 3, 40],
                    [546, 397, 413, 247, 328, 244, 9, 80, [
                        [427, 286, 383, 253, 371, 205, 2, 40],
                        [498, 345, 435, 315, 395, 330, 4, 60]
                    ]],
                    [546, 357, 608, 252, 678, 221, 6, 100, [
                        [590, 293, 646, 277, 648, 271, 2, 80]
                    ]]
                ]] 
            ],
            bloom: {
                num: 700,
                width: 1080,
                height: 650,
            },
            footer: {
                width: 1200,
                height: 5,
                speed: 10,
            }
        }

        var tree = new Tree(canvas[0], width, height, opts);
        var seed = tree.seed;
        var foot = tree.footer;
        var hold = 1;

        canvas.click(function(e) {
            var offset = canvas.offset(), x, y;
            x = e.pageX - offset.left;
            y = e.pageY - offset.top;
            if (seed.hover(x, y)) {
                hold = 0; 
                canvas.unbind("click");
                canvas.unbind("mousemove");
                canvas.removeClass('hand');
            }
        }).mousemove(function(e){
            var offset = canvas.offset(), x, y;
            x = e.pageX - offset.left;
            y = e.pageY - offset.top;
            canvas.toggleClass('hand', seed.hover(x, y));
        });

        var seedAnimate = eval(Jscex.compile("async", function () {
            seed.draw();
            while (hold) {
                $await(Jscex.Async.sleep(10));
            }
            while (seed.canScale()) {
                seed.scale(0.95);
                $await(Jscex.Async.sleep(10));
            }
            while (seed.canMove()) {
                seed.move(0, 2);
                foot.draw();
                $await(Jscex.Async.sleep(10));
            }
        }));

        var growAnimate = eval(Jscex.compile("async", function () {
            do {
                tree.grow();
                $await(Jscex.Async.sleep(10));
            } while (tree.canGrow());
        }));

        var flowAnimate = eval(Jscex.compile("async", function () {
            do {
                tree.flower(2);
                $await(Jscex.Async.sleep(10));
            } while (tree.canFlower());
        }));

        var moveAnimate = eval(Jscex.compile("async", function () {
            tree.snapshot("p1", 240, 0, 610, 680);
            while (tree.move("p1", 500, 0)) {
                foot.draw();
                $await(Jscex.Async.sleep(10));
            }
            foot.draw();
            tree.snapshot("p2", 500, 0, 610, 680);

            // 会有闪烁不得意这样做, (＞﹏�?
            canvas.parent().css("background", "url(" + tree.toDataURL('image/png') + ")");
            canvas.css("background", "#ffe");
            $await(Jscex.Async.sleep(300));
            canvas.css("background", "none");
        }));

        var jumpAnimate = eval(Jscex.compile("async", function () {
            var ctx = tree.ctx;
            while (true) {
                tree.ctx.clearRect(0, 0, width, height);
                tree.jump();
                foot.draw();
                $await(Jscex.Async.sleep(25));
            }
        }));

       var textAnimate = eval(Jscex.compile("async", function () {
/*            var together = new Date();
            together.setFullYear(2017, 7, 11);
            together.setHours(11);
            together.setMinutes(11);
            together.setSeconds(0);
            together.setMilliseconds(0);
			//这里注释的是显示时间,可以自定�?
*/
            $("#code").show().typewriter();
            $("#clock-box").fadeIn(500);
            while (true) {
                timeElapse(together);
                $await(Jscex.Async.sleep(1000));
            }
        }));
		

        var runAsync = eval(Jscex.compile("async", function () {
            $await(seedAnimate());
            $await(growAnimate());
            $await(flowAnimate());
            $await(moveAnimate());

            textAnimate().start();

            $await(jumpAnimate());
        }));

        runAsync().start();
    })();
    </script>
</body>
</html>