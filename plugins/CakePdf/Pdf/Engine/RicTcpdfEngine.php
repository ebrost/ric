<?php
App::uses('AbstractPdfEngine', 'CakePdf.Pdf/Engine');
App::uses('Multibyte', 'I18n');


class RicTcpdfEngine extends AbstractPdfEngine {


public $RICTCPDF;
/**
 * Constructor
 *
 * @param $Pdf CakePdf instance
 */
	public function __construct(CakePdf $Pdf) {
		parent::__construct($Pdf);
		App::import('Vendor', 'RICTCPDF', array('file' =>'rictcpdf.php'));
		$this->RICTCPDF= new RICTCPDF($this->_Pdf->orientation(), 'mm', $this->_Pdf->pageSize());
	}


/**
 * Generates Pdf from html
 *
 * @return string raw pdf data
 */
 
	public function output() {
		//TCPDF often produces a whole bunch of errors, although there is a pdf created when debug = 0
		Configure::write('debug', 0);
		$options=$this->config('options');
		$this->RICTCPDF->SetTextColor(0, 0, 0);
		if (isset($options['linkColor']) && is_array($options['linkColor'])){
			$this->RICTCPDF->setLinkColor($options['linkColor']);
		}
		
		if (isset($options['logo'])){
			$this->RICTCPDF->setLogo($options['logo']);
		}
		
		$this->RICTCPDF->setFooterText($options['footerText']);
		$this->RICTCPDF->AddPage();
		$html=trim($this->_Pdf->html());
		$this->RICTCPDF->SetFont('helvetica','',10,'',false);
		//$html="&#61589;";
		$pos= strpos($html,"<checkForPageBreak>");
		if($pos === false) {
			 // string needle NOT found in haystack$
			 $this->RICTCPDF->setY($this->RICTCPDF->getY()+5);
			$this->RICTCPDF->writeHTML($html);
		}
		else {
			 // string needle found in haystack
			 $htmlArray=explode("<checkForPageBreak>",$html);
			foreach($htmlArray as $html){
				if (isset($options['bgColor'])){
					$fill = ($fill===array(255,255,255))?$options['bgColor']:array(255,255,255);
				}
				else{
					$fill=array(255,255,255);
				}
				 	$this->writeHTMLWithBreaks($html,$fill);
			 }
		}
		
		
		return $this->RICTCPDF->Output('', 'S');
	}
	

	
	function writeHTMLWithBreaks($html, $RVBBgColor=''){
		if(!empty($html)){
			if(!empty($RVBBgColor)){
						$this->RICTCPDF->setFillColor($RVBBgColor[0],$RVBBgColor[1],$RVBBgColor[2]);
			}
			$this->RICTCPDF->setCellMargins(0,2,0,2);
					$this->RICTCPDF->setCellPadding(2);
					$this->RICTCPDF->setAutoPageBreak(false);
					$this->RICTCPDF->startTransaction();
					//$this->RICTCPDF->writeHTML($html, true, true, true, false, '');
					$this->RICTCPDF->writeHTMLCell(0, 0, '', '', $html, 0, 1, 1, true, 'L', true);
					if ($this->RICTCPDF->getY() > $this->RICTCPDF->getPageHeight() - 20) {
						$this->RICTCPDF->rollbackTransaction(true);
						$this->RICTCPDF->addPage();
						//$this->RICTCPDF->writeHTML($html, true, true, true, false, '');
						$this->RICTCPDF->writeHTMLCell(0, 0, '', '', $html, 0, 1, 1, true, 'L', true);
					}
					$this->RICTCPDF->commitTransaction();
					$this->RICTCPDF->setAutoPageBreak(true, 20);
		}
	}
	
}