<?php
/**
 * Created by PhpStorm.
 * User: Fabio Botelho
 * Date: 23/12/2019
 * Time: 15:45
 */

namespace Source\Support;

use Mpdf\Mpdf;

/**
 * Class Pdf
 * @package Source\Support
 */
class Pdf
{
    /** @var Mpdf */
    private $mpdf;

    /**
     * Pdf constructor.
     * @param string $mode
     * @param string $format
     * @param string $orientation
     * @throws \Mpdf\MpdfException
     */
    public function __construct($mode = 'utf-8', $format = 'A4', $orientation = 'P', $margin = 'stretch')
    {
        $this->mpdf = new Mpdf([
            'mode' => $mode,
            'format' => $format,
            'orientation' => $orientation,
            'setAutoTopMargin' => $margin // pad, stretch, false
        ]);
    }


    /**
     * @param $html
     * @return Pdf
     * @throws \Mpdf\MpdfException
     */
    public function write_line($html)
    {
        return $this->mpdf->WriteHTML($html);
    }

    /**
     * @param $title
     */
    public function setHeader(string $header)
    {
        $this->mpdf->SetHeader($header);
    }

    /**
     * @param string $title
     * @param string $author
     * @param string $creator
     * @param string $subject
     */
    public function metadata(string $title, string $author, string $creator, string $subject)
    {
        $this->mpdf->SetTitle($title);
        $this->mpdf->SetAuthor($author);
        $this->mpdf->SetCreator($creator);
        $this->mpdf->SetSubject($subject);
    }

    /**
     * @param $footer
     */
    public function setFooter($footer)
    {
        $this->mpdf->SetFooter($footer);
    }

    /**
     * @param $orientation
     */
    public function addPage($orientation = "P")
    {
        $this->mpdf->AddPage($orientation);
    }


    /**
     * @throws \Mpdf\MpdfException
     */
    public function output($filename = null)
    {
        if (!empty($filename)){
            $this->mpdf->Output($filename, "I");
            return;
        }
        $this->mpdf->Output("ArquivoPDF.pdf", "I");
    }

    /**
     * @param $pathCSSfile
     */
    public function setCSS($pathCSSfile)
    {
        $this->mpdf->defaultCssFile = $pathCSSfile;
    }

    /**
     * ANOTTATIONS
     * {PAGENO} = number of page
     * {DATE j-m-Y} = Date
     */
}