<?php

require('../libs/fpdf.php');


class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('logo.png',10,6,30);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,'Title',1,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    // Page footer
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
/*
// Instanciation of inherited class


<?php
require_once 'config/config.php';
require_once LIBPATH. 'fpdf.php';
require_once (CONTROLLERPATH.'Controller_Reports.php');
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
$shopname=$obj1->getshopdetails();
foreach ($shopname as $shopaddress)
{
    $address=$shopaddress['Primary_Address']."<br>".$shopaddress['Primary_City']."<br>".$shopaddress['Primary_State']."<br>".$shopaddress['Primary_zip'];
   $date=$shopaddress['Generated_Date'];
   $due=$shopaddress['Due_Date'];
   $amount=$shopaddress['Amount_Due'];
}

$obj=new Controller_Reports();
$data=$obj->viewReports();







class PDF extends FPDF
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
}

$html = 'You can now easily print text mixing different styles: <b>bold</b>, <i>italic</i>,
<u>underlined</u>, or <b><i><u>all at once</u></i></b>!<br><br>You can also insert links on
text, such as <a href="http://www.fpdf.org">www.fpdf.org</a>, or on an image: click on the logo.';

$pdf = new PDF();
// First page
$pdf->AddPage();

$pdf->SetFont('Arial','',20);
$pdf->Write(5,"To find out what's new in this tutorial, click ");
$pdf->SetFont('','U');
$link = $pdf->AddLink();
$pdf->Write(5,'here',$link);
$pdf->SetFont('');
// Second page
$pdf->AddPage();
$pdf->SetLink($link);
//$pdf->Image('logo.png',10,12,30,0,'','http://www.fpdf.org');
$pdf->SetLeftMargin(45);
$pdf->SetFontSize(14);
$pdf->WriteHTML($html);
$pdf->Output();
?>


   
    
require_once "../Controllers/Controller_Transaction.php";
require_once "../config/config.php";
$obj=new Controller_Transaction();
$id=$_GET['doc'];
$datas=$obj->showMember_Document($id);

foreach ($datas as $data)
{
 /*   $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    $pdf->AcceptPageBreak();
    $pdf->Cell(0,10,$data['Attachment_path'],0,1);
    $pdf->Output();
  */
            
 
    $new_filename="C:\wamp64\www\SpecialityTradeUnion\public\Members_Documents\_SampleDOCFile_100kb.doc";
    
  //  header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
   // header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");    // always modified
   // header("Content-length: " . $data['Attachment_size']);
   // header("Content-type: ").$data['Attachment_type'];
    header("Content-Disposition: filename={$new_filename}");
    header("Content-Transfer-Encoding: binary");
    
   // readfile($new_filename);  
    
    


    
    ?>
