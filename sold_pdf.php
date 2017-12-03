<?php
session_start();
require('FPDF/fpdf.php');
include("database_connection.php");

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial','B',15);
        $this->Cell(0,10,'TheBidders(Sold Item Report)','B',0,'C');
        $this->Ln(20);
    }
    
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial','I',12);
        $this->Cell(0,10,'By Shubham Rana and Shivani Ghughtyal',0,0,'C');
    }
    
function Table($header, $data)
{
	$this->SetFillColor(188,196,194);
	$this->SetTextColor(0);
	$this->SetDrawColor(0,0,0);
	$this->SetLineWidth(.3);
	$this->SetFont('','B');

	$w = array(40, 35, 40, 40, 35);
	for($i=0;$i<count($header);$i++)
		$this->Cell($w[$i],7,$header[$i],1,0,'C',true);
	$this->Ln();
    
    $this->SetFillColor(224,235,255);
	$this->SetTextColor(0);
	$this->SetFont('');
    
    $fill = false;
    for($i=0;$i<sizeof($data);)
    {
		$this->Cell($w[0],8,$data[$i++],'LR',0,'C',$fill);
		$this->Cell($w[1],8,$data[$i++],'LR',0,'C',$fill);
		$this->Cell($w[2],8,"Rs ".number_format($data[$i++]),'LR',0,'C',$fill);
        $this->Cell($w[3],8,$data[$i++],'LR',0,'C',$fill);
        $this->Cell($w[4],8,$data[$i++],'LR',0,'C',$fill);
        $this->Ln();
        $fill = !$fill;
    }   
	$this->Cell(array_sum($w),0,'','T');
}
}

$pdf = new PDF();
$header = array('Item Name', 'Sold Date', 'Sold Amount', 'Total Bidders','Buyer');

$username=$_SESSION['user'];
$query=mysqli_query($connect,"select * from bid_won where item_id in(select item_id from items where seller='$username')") or die(mysqli_error($connect));

$data = array();
while($row = mysqli_fetch_array($query))
{
    $query1=mysqli_query($connect,"select item_name from items where item_id='".$row['item_id']."'") or die(mysqli_error($connect));
    $row1=mysqli_fetch_array($query1);
    $date=explode(' ',$row['bid_date']);
    $query2=mysqli_query($connect,"select count(item_id) from bid where item_id='".$row['item_id']."'") or die(mysqli_error($connect));
    $row2=mysqli_fetch_array($query2);

    $data[]=$row1['item_name'];
    $data[]=$date[0];
    $data[]=$row['price'];
    $data[]=$row2[0];
    $data[]=$row['winner'];
}

$pdf->SetFont('Arial','',14);
$pdf->AddPage();
$pdf->Table($header,$data);
$pdf->Output();
    
?>
