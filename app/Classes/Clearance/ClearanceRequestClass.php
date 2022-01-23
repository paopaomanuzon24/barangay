<?php

namespace App\Classes\Clearance;



class ClearanceRequestClass
{

    public function generateLayout(){

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText("Republic of The Philippines",array('name'=>'Times New Roman','size'=>12));
        $section->addText("City Of Malabon",array('name'=>'Times New Roman','size'=>12));
        $section->addText("BARANGAY COUNCIL OF TONSUYA",array('name'=>'Times New Roman','size' => 12,'bold' => true));


        $section->addText("OFFICE OF THE BARANGAY CHAIRMAN",array(),array('alignment'=>'center'));
        $section->addText("BARANGAY CLEARANCE");
        $section->addText("This Business clearance is given to:");

         $table = $section->addTable();
        $table->addRow(1);
        $cell = $table->addCell(1);
        $cell = $table->addCell(200);

        $tableStyle = array(
            'borderColor' => 'FFFFFF',
            'borderSize'  => 6,
            'cellMargin'  => 30
        );
        $firstRowStyle = array('bgColor' => 'FFFFFF');
        $phpWord->addTableStyle('myTable', $tableStyle, $firstRowStyle);
        $table = $section->addTable('myTable');
        $table->addRow(.1);
        $lineStyle = array('weight' => 1, 'width' => 100, 'height' => 0, 'color' => 000000);
        $cell = $table->addCell(2000)->addText("Name of Business");
       # $cell = $table->addCell(1000)->addLine($lineStyle);

        $table->addRow(.1);
        $cell = $table->addCell(2000)->addText("Name of Business");
        $cell = $table->addCell(1000)->addLine($lineStyle);
       # $cell->getStyle()->setGridSpan(5);



        $section->addText("Business Address");
        $section->addText("Name of Owner");
        $section->addText("Owner's Address");
        $section->addText("Capital Investment");
        $section->addText("Product/s");
        $section->addText("No. of Employed Person/s");
        $section->addText("Land Areas");
        $section->addText("Bldg. Floor Area");
        $section->addText("Issued At");



        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save('Clearance.docx');

    }


}
