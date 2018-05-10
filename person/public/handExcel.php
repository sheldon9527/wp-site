<?php
set_time_limit(0);

include_once __DIR__.DIRECTORY_SEPARATOR.'PHPExcel'.DIRECTORY_SEPARATOR.'PHPExcel.php';
include_once __DIR__.DIRECTORY_SEPARATOR.'PHPCURL'.DIRECTORY_SEPARATOR.'PhpCurl.php';
//上传excel,并保存
$file = explode('.', $_FILES['file_path']['name']);
$fileExt = end($file);
if (!in_array($fileExt, ['xlsx','xls'])) {
    exit('上传文件不是excel类型');
}
$currentPath = dirname(__FILE__);
$filePath = $currentPath.DIRECTORY_SEPARATOR.'excel'.DIRECTORY_SEPARATOR.$_FILES['file_path']['name'];
$bool = move_uploaded_file($_FILES['file_path']['tmp_name'], $filePath);
if (!$bool) {
    exit('上传失败');
}
//excel处理
$sheet=0;
$PHPReader = new PHPExcel_Reader_Excel2007(); //建立reader对象
if (!$PHPReader->canRead($filePath)) {
    $PHPReader = new PHPExcel_Reader_Excel5();
    if (!$PHPReader->canRead($filePath)) {
        die('不是excel');
    }
}

$PHPExcel = $PHPReader->load($filePath); //建立excel对象
$currentSheet = $PHPExcel->getSheet($sheet); //**读取excel文件中的指定工作表*/
$allColumn = $currentSheet->getHighestColumn(); //**取得最大的列号*/
$allRow = $currentSheet->getHighestRow(); //**取得一共有多少行*/
$data = [];
for ($rowIndex=1;$rowIndex<=$allRow;$rowIndex++) {
    //循环读取每个单元格的内容。注意行从1开始，列从A开始
    for ($colIndex='A';$colIndex<=$allColumn;$colIndex++) {
        $addr = $colIndex.$rowIndex;
        $cell = $currentSheet->getCell($addr)->getValue();

        if ($cell instanceof PHPExcel_RichText) {
            //富文本转换字符串
            $cell = $cell->__toString();
        }
        $data[$rowIndex][$colIndex] = $cell;
    }
}
//去掉空的数组
$datas = array_filter($data);
//去掉excel中标题的数组
array_shift($datas);
//循环生成
if ($datas) {
    foreach ($datas as $value) {
        $domain = 'http://person.me';//域名需要自己配置
        $url = $domain.'/getImage.php';
        $setopt = array('port' => '80');
        $arrUrlParse = parse_url($url);
        if (isset($arrUrlParse['port']) && !empty($arrUrlParse['port'])) {
            $setopt = array('port' => $arrUrlParse['port']);
        }
        $curl = new PhpCurl($setopt);

        $content = $curl->get($url, [
            'xm'=>$value['A'],
            'cs'=>$value['C'],
            'xba'=>$value['B'],
            'mz'=>$value['F'],
            'zhuzhi'=>$value['E'],
            'hm'=>$value['D'],
            'tx'=>$domain.'/userImages'.'/'.'1245.png',//这里需要修改。。。。
            'yz'=>'zm',
        ]);
    }
}
//重定向到index页面
$Url=$_SERVER['HTTP_REFERER'];
header('location:'.$Url);
