<?php
/**
 * @author lyq@ottv.tv
 * @description
 * @date 2016年07月19日 13:50
 * @version 1.0
 */

namespace Kernel\Vendor\PHPExcel;

require KERNEL_EXTEND_PATH.'/PHPExcel/PHPExcel.php';
class Excel
{
    /**
     * @description 整数转换为字母;例:0->A,1->B,26->AA,27->AB
     * @author lyq@ottv.tv
     * @date 2016年7月19日14:10:32
     * @param int $number 0至701的整数
     * @return string 转换之后的字母字符串
     */
    public function number_to_letter(int $number):string
    {
        $chrList = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        if($number < 26 && $number >= 0){
            return $chrList[$number];
        }elseif($number >= 26){
            $multiple = floor($number/26);//倍数
            $remainder = $number%26;//余数
            return $chrList[$multiple-1].$chrList[$remainder];
        }
    }

    /**
     * @description 生成Excel并保存
     * @author lyq@ottv.tv
     * @date 2016年7月19日14:16:51
     * @param array $data 要写入到excel的数据,二维数组
     * @param string $path 保存excel的路径及文件名
     * @param string $sheet 工作表名称,默认sheet1
     * @param string $excel_version 生成的excel版本,可选值:Excel5,Excel2007;分别代表excel 95,excel2007
     * @throws \PHPExcel_Exception
     */
    public function save(array $data,string $path,string $sheet='sheet1',string $excel_version='Excel5')
    {
        $PHPExcel = new \PHPExcel();
        //设置当前的sheet
        $PHPExcel->setActiveSheetIndex(0);
        //设置sheet的name
        $PHPExcel->getActiveSheet()->setTitle($sheet);
        //行索引
        $rowIndex = 1;
        foreach($data as $row){
            //列索引
            $columnIndex = 0;
            foreach($row as $value){
                //设置单元格值
                $PHPExcel->getActiveSheet()->setCellValue($this->number_to_letter($columnIndex).$rowIndex,$value);
                $columnIndex++;
            }
            $rowIndex++;
        }
        $PHPExcel = \PHPExcel_IOFactory::createWriter($PHPExcel, $excel_version);
        $PHPExcel->save($path);
    }
}