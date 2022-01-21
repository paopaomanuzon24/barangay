<?php

namespace App\Classes\Permit;



class PermitRequestClass
{

    public function generatePermitLayout(){

        $phpWord = new \PhpOffice\PhpWord\PhpWord();
        $section = $phpWord->addSection();
        $section->addText("Republic of The Philippines",array('name'=>'Times New Roman','size'=>12));
        $section->addText("City Of Malabon",array('name'=>'Times New Roman','size'=>12));
        $section->addText("BARANGAY COUNCIL OF TONSUYA",array('name'=>'Times New Roman','size' => 12,'bold' => true));


        $section->addText("OFFICE OF THE BARANGAY CHAIRMAN",array(),array('alignment'=>'center'));
        $section->addText("BARANGAY CLEARANCE");
        $section->addText("This Business clearance is given to:");




        $section->addText("Name of Business");

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
      #  $objWriter->save('Appdividend.docx');

    }


}
