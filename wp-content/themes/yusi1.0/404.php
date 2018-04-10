<?php get_header(); ?>
<div class="content-wrap">
	<?php
    for ($t=0;$t<360;$t++) {
        $y=2*cos($t)-cos(2*$t);
        $x=2*sin($t)-sin(2*$t);
        $x+=3;
        $y+=3;
        $x*=70;
        $y*=70;
        $x=round($x);
        $y=round($y);
        $str[]=$x;
        $y=$y+2*(180-$y);
        $x=$y;
        $str[]=$x;
    }
     $im=imagecreate(400, 400);//创建画布400*400
     $black=imagecolorallocate($im, 255, 255, 255);
     $red=imagecolorallocate($im, 255, 0, 0);//设置颜色
     imagepolygon($im, $str, 360, $red);
     imagestring($im, 5, 130, 160, date("Y-m-d h:i:s"), $red);
     imagestring($im, 5, 130, 190, "Content is missing ", $red);
     imagestring($im, 5, 195, 220, "But ", $red);
     imagestring($im, 5, 165, 250, "i love you ", $red);
     $resultNamePath = dirname(dirname(dirname(dirname(__FILE__)))).DIRECTORY_SEPARATOR.'love.jpg';
     imagegif($im, $resultNamePath);//输出图片
    ?>
</div>
<div style="text-align: center;">
	<img src="/love.jpg"/>
</div>
<?php get_footer(); ?>
