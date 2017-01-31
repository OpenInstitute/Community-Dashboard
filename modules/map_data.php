<?php include '../inc/conn.inc'; 
date_default_timezone_set('Africa/Nairobi');
$id=$_GET['id'];
if($id==0){
	$chk = "SELECT id , Latitude , Longitude, bread_winner_name FROM households WHERE Latitude !=  '' AND Longitude !=  '' ";
} else {
	$chk = "SELECT id , Latitude , Longitude, bread_winner_name FROM households WHERE id = $id AND Latitude !=  '' AND Longitude !=  ''";
}
    $rs = mysqli_query($conn, $chk);  
	$totalRows_Contents = mysqli_num_rows($rs);
	if($totalRows_Contents>=1) {
			$js = '{"type": "FeatureCollection", "features": [';
		
		while($rslist=mysqli_fetch_array($rs)){
			
			$js .= '{"type": "Feature", "properties": {"Name": "<a href=household.php?id='.$rslist['id'].'>'. str_replace("\n", "",$rslist['bread_winner_name']) .'</a>","BusType": "Households","Description": "'. str_replace("\n", "",$rslist['bread_winner_name']) .'" },"geometry": {"type": "Point", "coordinates": ['.$rslist['Latitude'].', '.$rslist['Longitude'].']}},';
		
		}
       
			$js=substr($js, 0, -1);
     
			$js .=']}';
	}

$js=str_replace('\n','',$js);
echo($js);
?>