<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 21.01.2019
 * Time: 10:04
 */
include_once ('CreateTable.php');
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CreateExl extends CreateTable
{
    public function writeToExl($arr, $thead, $name, $id) {

        $exhead = array();
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();


        for ($i = ord('A'), $y = 0 ; $i<=ord('Z') && $y<count($thead); $i++, $y++) {

            $sheet->setCellValue(chr($i).'1', $thead[$y]);
            $exhead[$y]=chr($i);
        }

        $z = 2;

        foreach ($arr as $key1=>$val) {


            for($i = 0; $i < count($thead); $i++) {

                if(!empty($val[$thead[$i]])) {

                    $sheet->setCellValue($exhead[$i].$z, $val[$thead[$i]]);

                }  else {

                    $sheet->setCellValue($exhead[$i].$z, '');
                }
            }
            $z++;
        }

        $writer = new Xlsx($spreadsheet);
        $full_name = $name.'_'.$id;
        $writer->save('files/'.$full_name.'.xlsx');

        $file = 'files/'.$full_name.'.xlsx';

        if (! $file) {
            die('file not found'); //Or do something
            return 1;
        } else {
            // Set headers

            return $full_name;
        }

    }

    public function superTblExl($arr, $name, $id) {

        $i = 0;
        $thead = array();
        $mass = array();

        foreach ($arr as $val) {

            $result = $this->openArr($val, $thead);

            $thead = $result['thead'];

            $mass[] = $result['mass'];

            $i++;
        }

        $res = $this->writeToExl($mass, $thead, $name, $id);

        return $res;
    }

}