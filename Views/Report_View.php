<?php 
require_once '../config/config.php';

require_once  '../libs/fpdf.php';
require_once '../libs/html_table.php';

require_once ('../Controllers/Controller_Reports.php');
//echo $_SESSION['Reportid'];

//require('../libs/fpdf.php');
if(isset($_POST['mainpage']))
{
    $_SESSION['path']="mainpage";
    header("Location: ".BASEPATH);
}
if(isset($_POST['logout']))
{
    session_destroy();
    header("Location: ".BASEPATH);
}
//echo $_SESSION['memberid'];
?>
<form method="post" name="show_list" id="show_list" action="">
<table>
	<tr>
		<td>
			<table>
				<tr>
					<td>
						<input type="submit" name="mainpage" value="Close">
					</td>
					<td>
						<input type="submit" name="logout" value="Logout">
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>
</form>
<?php
$obj1=new Controller_Reports();
$shopname=$obj1->getshopdetails($_GET['Reportid']);
foreach ($shopname as $shopaddress)
{
    $address=$shopaddress['Primary_Address'].$shopaddress['Primary_City'].$shopaddress['Primary_State'].$shopaddress['Primary_zip'];
   $date=$shopaddress['Generated_Date'];
   $due=$shopaddress['Due_Date'];
   $amount=$shopaddress['Amount_Due'];
   $invoice=$shopaddress['Report_Id'];
   if($shopaddress['Report_Name']=="insurance_carrier")
   $report="Insurance Carrier";
   elseif($shopaddress['Report_Name']=="monthly_due")
   $report="Dues";
      
}

$obj=new Controller_Reports();
$data=$obj->viewReports($_GET['Reportid']);







class PDFs extends FPDF
{
    protected $B = 0;
    protected $I = 0;
    protected $U = 0;
    protected $HREF = '';
    
    function WriteHTML($html)
    {
        // HTML parser
        $html = str_replace("\n",' ',$html);
        $a = preg_split('/<(.*)>/U',$html,-1,PREG_SPLIT_DELIM_CAPTURE);
        foreach($a as $i=>$e)
        {
            if($i%2==0)
            {
                // Text
                if($this->HREF)
                    $this->PutLink($this->HREF,$e);
                    else
                        $this->Write(5,$e);
            }
            else
            {
                // Tag
                if($e[0]=='/')
                    $this->CloseTag(strtoupper(substr($e,1)));
                    else
                    {
                        // Extract attributes
                        $a2 = explode(' ',$e);
                        $tag = strtoupper(array_shift($a2));
                        $attr = array();
                        foreach($a2 as $v)
                        {
                            if(preg_match('/([^=]*)=["\']?([^"\']*)/',$v,$a3))
                                $attr[strtoupper($a3[1])] = $a3[2];
                        }
                        $this->OpenTag($tag,$attr);
                    }
            }
        }
    }
    
    function Header()
    {
        // Logo
     //   $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Move to the right
        $this->Cell(80);
        $this->SetTextColor(132,174,196);
        // Title
        $this->Cell(30,10,'Speciality Trades Union Local 741',0,0,'C');
        // Line break
        $this->Ln(20);
    }
    
     function OpenTag($tag, $attr)
    {
        // Opening tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,true);
            if($tag=='A')
                $this->HREF = $attr['HREF'];
                if($tag=='BR')
                    $this->Ln(5);
    }
    
    function CloseTag($tag)
    {
        // Closing tag
        if($tag=='B' || $tag=='I' || $tag=='U')
            $this->SetStyle($tag,false);
            if($tag=='A')
                $this->HREF = '';
    }
    
    function SetStyle($tag, $enable)
    {
        // Modify style and select corresponding font
        $this->$tag += ($enable ? 1 : -1);
        $style = '';
        foreach(array('B', 'I', 'U') as $s)
        {
            if($this->$s>0)
                $style .= $s;
        }
        $this->SetFont('',$style);
    }
    
    function PutLink($URL, $txt)
    {
        // Put a hyperlink
        $this->SetTextColor(0,0,255);
        $this->SetStyle('U',true);
        $this->Write(5,$txt,$URL);
        $this->SetStyle('U',false);
        $this->SetTextColor(0);
    }
//for table code starts

    // Margins
    var $left = 10;
    var $right = 10;
    var $top = 10;
    var $bottom = 10;
    
    // Create Table
    function WriteTable($tcolums)
    {
        // go through all colums
        for ($i = 0; $i < sizeof($tcolums); $i++)
        {
            $current_col = $tcolums[$i];
            $height = 0;
            
            // get max height of current col
            $nb=0;
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);
                
                $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));
                $height = $current_col[$b]['height'];
            }
            $h=$height*$nb;
            
            
            // Issue a page break first if needed
            $this->CheckPageBreak($h);
            
            // Draw the cells of the row
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                $w = $current_col[$b]['width'];
                $a = $current_col[$b]['align'];
                
                // Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);
                
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                
                
                // Draw Cell Background
                $this->Rect($x, $y, $w, $h, 'FD');
                
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                
                // Draw Cell Border
                if (substr_count($current_col[$b]['linearea'], "T") > 0)
                {
                    $this->Line($x, $y, $x+$w, $y);
                }
                
                if (substr_count($current_col[$b]['linearea'], "B") > 0)
                {
                    $this->Line($x, $y+$h, $x+$w, $y+$h);
                }
                
                if (substr_count($current_col[$b]['linearea'], "L") > 0)
                {
                    $this->Line($x, $y, $x, $y+$h);
                }
                
                if (substr_count($current_col[$b]['linearea'], "R") > 0)
                {
                    $this->Line($x+$w, $y, $x+$w, $y+$h);
                }
                
                
                // Print the text
                $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);
                
                // Put the position to the right of the cell
                $this->SetXY($x+$w, $y);
            }
            
            // Go to the next line
            $this->Ln($h);
        }
    }
    
    function WriteTables($tcolums)
    {
        // go through all colums
        for ($i = 0; $i < sizeof($tcolums); $i++)
        {
            $current_col = $tcolums[$i];
            $height = 0;
            
            // get max height of current col
            $nb=0;
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);
                
                $nb = max($nb, $this->NbLines($current_col[$b]['width'], $current_col[$b]['text']));
                $height = $current_col[$b]['height'];
            }
            $h=$height*$nb;
            
            // Issue a page break first if needed
            $this->CheckPageBreak($h);
            
            // Draw the cells of the row
            for($b = 0; $b < sizeof($current_col); $b++)
            {
                $w = $current_col[$b]['width'];
                $a = $current_col[$b]['align'];
                
                // Save the current position
                $x=$this->GetX();
                $y=$this->GetY();
                
                // set style
                $this->SetFont($current_col[$b]['font_name'], $current_col[$b]['font_style'], $current_col[$b]['font_size']);
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetFillColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['textcolor']);
                $this->SetTextColor($color[0], $color[1], $color[2]);
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                $this->SetLineWidth($current_col[$b]['linewidth']);
                
                $color = explode(",", $current_col[$b]['fillcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                
                
                // Draw Cell Background
                $this->Rect($x, $y, $w, $h, 'FD');
                
                $color = explode(",", $current_col[$b]['drawcolor']);
                $this->SetDrawColor($color[0], $color[1], $color[2]);
                
                // Draw Cell Border
                if (substr_count($current_col[$b]['linearea'], "T") > 0)
                {
                    $this->Line($x, $y, $x+$w, $y);
                }
                
                if (substr_count($current_col[$b]['linearea'], "B") > 0)
                {
                    $this->Line($x, $y+$h, $x+$w, $y+$h);
                }
                
                if (substr_count($current_col[$b]['linearea'], "L") > 0)
                {
                    $this->Line($x, $y, $x, $y+$h);
                }
                
                if (substr_count($current_col[$b]['linearea'], "R") > 0)
                {
                    $this->Line($x+$w, $y, $x+$w, $y+$h);
                }
                
                
                // Print the text
                $this->MultiCell($w, $current_col[$b]['height'], $current_col[$b]['text'], 0, $a, 0);
                
                // Put the position to the right of the cell
                $this->SetXY($x+$w, $y);
            }
            
            // Go to the next line
            $this->Ln($h);
        }
    }
    
    
    // If the height h would cause an overflow, add a new page immediately
    function CheckPageBreak($h)
    {
        if($this->GetY()+$h>$this->PageBreakTrigger)
            $this->AddPage($this->CurOrientation);
    }
    
    
    // Computes the number of lines a MultiCell of width w will take
    function NbLines($w, $txt)
    {
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
            $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
            $s=str_replace("\r", '', $txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
                $sep=-1;
                $i=0;
                $j=0;
                $l=0;
                $nl=1;
                while($i<$nb)
                {
                    $c=$s[$i];
                    if($c=="\n")
                    {
                        $i++;
                        $sep=-1;
                        $j=$i;
                        $l=0;
                        $nl++;
                        continue;
                    }
                    if($c==' ')
                        $sep=$i;
                        $l+=$cw[$c];
                        if($l>$wmax)
                        {
                            if($sep==-1)
                            {
                                if($i==$j)
                                    $i++;
                            }
                            else
                                $i=$sep+1;
                                $sep=-1;
                                $j=$i;
                                $l=0;
                                $nl++;
                        }
                        else
                            $i++;
                }
                return $nl;
    }
    
    
//for table code ends */
//html table code starts
            
            
//html table code ends            
            
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}


$pdf = new PDFs();
 //First page
$pdf->AddPage();
$pdf->SetMargins(100, 10,0);
//$pdf->SetFont('Arial','',10);
//$pdf->Write(5,"To find out what's new in this tutorial, click ");
//$pdf->SetFont('','U');
//$link = $pdf->AddLink();
//$y = 30;
//$x = 10;
$pdf->setXY(15, 30);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(58,143,181);
$pdf->Cell(40, 8, "Specality Trades Union Local 741", 2);   // CHANGE THESE TO REPRESENT YOUR FIELDS
$pdf->SetTextColor(0,0,0);
$pdf->setXY(15,35);
$pdf->Cell(25, 8, "157 Summerfield Street", 2);
$pdf->setXY(15,40);
$pdf->Cell(30, 8, "Scarsdale,NY 10583", 2);
$pdf->setXY(15,45);
$pdf->Cell(30, 8, "(914)367-0277", 2);
$pdf->setXY(15,50);
$pdf->Cell(30, 8, "nclocal741@yahoo.com", 2);


$pdf->setXY(150,35);
$pdf->AliasNbPages();
//$pdf->SetMargins($pdf->left, $pdf->top, $pdf->right);
/*$pdf->SetDrawColor(200);
$pdf->Line(150,30,150,50);//|-
$pdf->SetFillColor(135,206,250);
$pdf->Line(150,30,200,30);//--
$pdf->Line(200, 30, 200,50);//-|
$pdf->Line(200, 50,150, 50);//__
$pdf->Line(200, 40,150, 40);
$pdf->Line(175, 30, 175,50); */
$pdf->SetMargins(150, 10,0);
$col = array();
$col[] = array('text' => 'Date', 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$col[] = array('text' => 'Invoice #', 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','postion'=>'150');
$columns[] = $col;
//
$col = array();
$col[] = array('text' => $date, 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $invoice, 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns[] = $col;
//$pdf->WriteTables($columns);
$col = array();
$col[] = array('text' => 'Terms', 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$col[] = array('text' => 'Due Date', 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','postion'=>'150');
$columns[] = $col;
//
$col = array();
$col[] = array('text' => 'Due on receipt', 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $due, 'width' => '20', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns[] = $col;
$pdf->WriteTables($columns);
$pdf->setXY(50,65);


$pdf->AliasNbPages();
$pdf->SetMargins(50, 10,0);
$col = array();
$col[] = array('text' => 'Bill To', 'width' => '60', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$columns1[] = $col;
//
$col = array();
$col[] = array('text' => $address, 'width' => '60', 'height' => '20', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns1[] = $col;
$pdf->WriteTable($columns1);
$pdf->setXY(150,75);
$pdf->SetMargins(150, 10,0);
$col = array();
$col[] = array('text' => 'Amount Due', 'width' => '30', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$col[] = array('text' => 'Enclosed', 'width' => '20', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$columns2[] = $col;
//
$col = array();
$col[] = array('text' => '$'.$amount, 'width' => '30', 'height' => '5', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => '', 'width' => '20', 'height' => '5', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns2[] = $col;
$pdf->WriteTable($columns2);

//$pdf->WriteTables($columns);
//$pdf->Write(5,'here',$link);
$pdf->AliasNbPages();
//$pdf->AddPage();
$pdf->SetFont('');
// Second page
//$pdf->AddPage();
//$pdf->SetLink($link);
//$pdf->Image('logo.png',10,12,30,0,'','http://www.fpdf.org');
//$pdf->SetLeftMargin(45);
$pdf->SetFontSize(14);
//$pdf->WriteHTML($html);
//$pdf->Output()

       // $pdf = new PDF();
//$pdf=new pdftable('P','mm','A4');
$pdf->AliasNbPages();
//$pdf->SetMargins($pdf->left, $pdf->top, $pdf->right);
//$pdf->AddPage();
$pdf->setXY(10,95);
$pdf->SetMargins(10, 10,0);
// create table
$columns = array();

// header col
$col = array();
$col[] = array('text' => $report, 'width' => '35', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR','position'=>'150');
$col[] = array('text' => 'Members Name', 'width' => '90', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => 'Quantity', 'width' => '15', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => 'Rate', 'width' => '20', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => 'Amount', 'width' => '30', 'height' => '15', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '135,206,250', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns4[] = $col;
$pdf->WriteTables($columns4);
$obj=new Controller_Reports();
$data=$obj->viewReports($_GET['Reportid']);
foreach ($data as $datas)
{ 
    
// data col
$col = array();
$col[] = array('text' => $datas['Invoice_Name'], 'width' => '35', 'height' => '10', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $datas['Member_Name'], 'width' => '90', 'height' => '10', 'align' => 'L', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $datas['Quantity'], 'width' => '15', 'height' => '10', 'align' => 'C', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $datas['Rate'], 'width' => '20', 'height' => '10', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => 'B', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,255', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$col[] = array('text' => $datas['Rate'], 'width' => '30', 'height' => '10', 'align' => 'R', 'font_name' => 'Arial', 'font_size' => '8', 'font_style' => '', 'fillcolor' => '255,255,255', 'textcolor' => '0,0,0', 'drawcolor' => '0,0,0', 'linewidth' => '0.4', 'linearea' => 'LTBR');
$columns[] = $col;


}
$pdf->WriteTables($columns);
//$pdf->Write(5,"To find out what's new in this tutorial, click ");
//$pdf->SetFont('','U');
//$link = $pdf->AddLink();
//$y = 30;
 //$x = 10;
 //$pdf->setXY(15, 30);
// $pdf->SetFont('Arial','',10);
$pdf->AliasNbPages();
 $pdf->SetTextColor(58,143,181);
// $pdf->Cell(40, 8, "Specality Trades Union Local 741", 2);   // CHANGE THESE TO REPRESENT YOUR FIELDS
 $pdf->setXY(15, 30);
 $pdf->SetFont('Arial','',10);
 $pdf->SetTextColor(58,143,181);
 $pdf->Cell(40, 8, "Specality Trades Union Local 741", 2);   // CHANGE THESE TO REPRESENT YOUR FIELDS
 $pdf->setXY(15,35);
 $pdf->Cell(25, 8, "157 Summerfield Street", 2);
 $pdf->setXY(15,40);
 $pdf->Cell(30, 8, "Scarsdale,NY 10583", 2);
 $pdf->setXY(15,50);
$pdf->AliasNbPages();
$pdf->SetTextColor(0,0,0);
 $pdf->setXY(120, 30);

/*$html='<table>
<tr>
    
</tr>
<tr>
<td width="200" height="30">cell 1</td><td width="200" height="30" bgcolor="#D0D0FF">cell 2</td>
</tr>
<tr>
<td width="200" height="30">cell 3</td><td width="200" height="30">cell 4</td>
</tr>
</table>';*/

$pdf->WriteHTML($html);
// Show PDF
$pdf->Output();
?>

