<?php
set_time_limit(0);
/**
 * [$xm 传来的数据]
 * @var [type]
 */
$xm=$_GET['xm'];
$xm = mb_convert_encoding($xm, 'html-entities', 'utf-8');
$cs=explode("-", $_GET['cs']);
$cs=$cs[0].'       '.$cs[1].'      '.$cs[2];
$cs = mb_convert_encoding($cs, 'html-entities', 'utf-8');
$mz=$_GET['mz'];
$mz = mb_convert_encoding($mz, 'html-entities', 'utf-8');
$xba=$_GET['xba'];
$xba = mb_convert_encoding($xba, 'html-entities', 'utf-8');
$zhuzhi=$_GET['zhuzhi'];
$zhuzhi = mb_convert_encoding($zhuzhi, 'html-entities', 'utf-8');
$len = strlen($zhuzhi);
//处理住址
$zhuzhi1 = mb_substr($zhuzhi, 0, 88, 'utf-8');
$zhuzhi = str_replace($zhuzhi1, '', $zhuzhi);
$zhuzhi2 = mb_substr($zhuzhi, 0, 80, 'utf-8');
$zhuzhi = str_replace($zhuzhi2, '', $zhuzhi);
$zhuzhi3 = mb_substr($zhuzhi, 0, 88, 'utf-8');
$hm=$_GET['hm'];
$tx=$_GET['tx'];
$yz=$_GET['yz'];

//处理身份证号码间隙
function imagettftextSp($image, $size, $angle, $x, $y, $color, $font, $text, $spacing = 0)
{
    if ($spacing == 0) {
        imagettftext($image, $size, $angle, $x, $y, $color, $font, $text);
    } else {
        $temp_x = $x;
        for ($i = 0; $i < strlen($text); $i++) {
            $bbox = imagettftext($image, $size, $angle, $temp_x, $y, $color, $font, $text[$i]);
            $temp_x += $spacing + ($bbox[2] - $bbox[0]);
        }
    }
}
//裁剪图片
function cutImage($image, $hm)
{
    $imgstream = file_get_contents($image);
    $im = imagecreatefromstring($imgstream);
    $x = imagesx($im);//获取图片的宽
    $y = imagesy($im);//获取图片的高
    // 缩略后的大小
    $xx = 145;
    $yy = 128;
    //图片宽大于高
    if ($x>$y) {
        $sx = abs(($y-$x)/2);
        $sy = 0;
        $thumbw = $y;
        $thumbh = $y;
    } else {
        //图片高大于等于宽
        $sy = abs(($x-$y)/2.5);
        $sx = 0;
        $thumbw = $x;
        $thumbh = $x;
    }
    if (function_exists("imagecreatetruecolor")) {
        $dim = imagecreatetruecolor($yy, $xx); // 创建目标图gd2
        $color=imagecolorallocate($dim, 255, 255, 255);
        imagecolortransparent($dim, $color);
        imagefill($dim, 0, 0, $color);
    } else {
        $dim = imagecreate($yy, $xx); // 创建目标图gd1
    }
    imageCopyreSampled($dim, $im, 0, 0, $sx, $sy, $yy, $xx, $thumbw, $thumbh);
    $resultNamePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'cutUserImages'.DIRECTORY_SEPARATOR.$hm.'.jpg';
    header("Content-type: image/png");
    imagepng($dim, $resultNamePath);

    return $resultNamePath;
}

//如果是正面
if ($yz=='zm') {
    $dst_path = dirname(__FILE__).DIRECTORY_SEPARATOR.'plateImage'.DIRECTORY_SEPARATOR.'idcard.jpg';//背景图片
    //裁剪图片
    $tx = cutImage($tx, $hm);
    //头像
    $tximg = imagecreatefrompng($tx);
    //创建图片的实例
    $dst = imagecreatefromstring(file_get_contents($dst_path));
    //打上文字
    $font = dirname(__FILE__).DIRECTORY_SEPARATOR.'font'.DIRECTORY_SEPARATOR.'xh.ttf';
    $font1= dirname(__FILE__).DIRECTORY_SEPARATOR.'font'.DIRECTORY_SEPARATOR.'2.ttf';
    $black = imagecolorallocate($dst, 50, 50, 50);//字体颜色

    imagefttext($dst, 12, 0, 160, 98, $black, $font, $xm);
    // imagefttext($dst, 12, 0, 161, 98, $black, $font, $xm);
    imagefttext($dst, 11.5, 0, 160, 128, $black, $font, $xba);
    // imagefttext($dst, 11.5, 0, 161, 128, $black, $font, $xba);
    imagefttext($dst, 11.5, 0, 241, 128, $black, $font, $mz);
    // imagefttext($dst, 11.5, 0, 242, 128, $black, $font, $mz);
    imagefttext($dst, 11.5, 0, 158, 160, $black, $font, $cs);
    // imagefttext($dst, 11.5, 0, 159, 160, $black, $font, $cs);
    imagefttext($dst, 10.8, 0, 158, 194, $black, $font, $zhuzhi1);
    // imagefttext($dst, 10.8, 0, 159, 194, $black, $font, $zhuzhi1);

    imagefttext($dst, 10.8, 0, 158, 215, $black, $font, $zhuzhi2);
    // imagefttext($dst, 10.8, 0, 159, 215, $black, $font, $zhuzhi2);
    if ($zhuzhi3) {
        imagefttext($dst, 10.8, 0, 158, 236, $black, $font, $zhuzhi3);
    }
    //格式
    imagettftextSp($dst, 14, 0, 220, 276.4, $black, $font1, $hm, 4);
    // imagettftextSp($dst, 14, 0, 221, 276.4, $black, $font1, $hm, 4);
    //输出图片
    imagecopymerge($dst, $tximg, 333, 87, 0, 0, 128, 145, 100);
    //输出图片
    list($dst_w, $dst_h, $dst_type) = getimagesize($dst_path);
    //构造下载文件
    $xm = mb_convert_encoding($xm, 'utf-8', 'html-entities');
    //生成彩色保存地址
    $resultNamePath = dirname(__FILE__).DIRECTORY_SEPARATOR.'produceImages'.DIRECTORY_SEPARATOR.$xm.'_'.$hm.'.jpg';
    //生成灰色保存地址
    $resultNameGreyPath = dirname(__FILE__).DIRECTORY_SEPARATOR.'produceGreyImages'.DIRECTORY_SEPARATOR.$xm.'_'.$hm.'.jpg';
    //保存图片到本地
    switch ($dst_type) {
        case 1://GIF
            header('Content-Type: image/gif');
            //生成彩色
            imagegif($dst, $resultNamePath);
            //生成灰色
            $im = imagecreatefromgif($resultNamePath);
            imagefilter($im, IMG_FILTER_GRAYSCALE);
            imagegif($im, $resultNameGreyPath);
            break;
        case 2://JPG
            header('Content-Type: image/jpeg');
            //生成彩色
            imagejpeg($dst, $resultNamePath);
            //生成灰色
            $im = imagecreatefromjpeg($resultNamePath);
            imagefilter($im, IMG_FILTER_GRAYSCALE);
            imagejpeg($im, $resultNameGreyPath);
            break;
        case 3://PNG
            header('Content-Type: image/png');
            //生成彩色
            imagepng($dst, $resultNamePath);
            //生成灰色
            $im = imagecreatefrompng($resultNamePath);
            imagefilter($im, IMG_FILTER_GRAYSCALE);
            imagepng($im, $resultNameGreyPath);
            break;
        default:
            break;
    }
    //销毁图片
    imagedestroy($dst);
}

//反面暂不做
