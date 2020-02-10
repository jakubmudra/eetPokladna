<?php


namespace App\Libs;


use Mpdf\Mpdf;

class PDF
{
    public static function test()
    {
        $mpdf = new Mpdf();

        // Write some HTML code:
                $mpdf->WriteHTML('Hello World');

        // Output a PDF file directly to the browser
                $mpdf->Output();
    }
}