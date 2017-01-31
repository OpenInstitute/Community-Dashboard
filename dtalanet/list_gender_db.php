<?php
                               

$raw_row = array('cluster', 'age', 'gender', 'profession', 'employment', 'group_number', 'group_1name', 'group_1purpose', 'group_1gender', 'group_1contribution', 'group_2name', 'group_2purpose', 'group_2gender', 'group_2contribution', `group_3name`, 'group_3purpose', 'group_3gender', 'group_3contribution', 'group_4name', 'group_4purpose', 'group_4gender', 'group_4contribution', 'group_5name', 'group_5purpose', 'group_5gender', 'group_5contribution', 'violence_physical', 'violence_sexual', 'violence_psych');

$clean_row = array('Cluster', 'Age', 'Gender', 'Profession', 'Employment', 'Number of Groups', 'Group 1 Name', 'Group 1 Purpose', 'Group 1 Gender', 'Group 1 Monthly Contribution', 'Group 2Name', 'Group 2 Purpose', 'Group 2 Gender', 'Group 2 Monthly Contribution', `Group 3 Name`, 'Group 3 Purpose', 'Group 3 Purpose', 'Group 3 Monthly Contribution', 'Group 4 Name', 'Group 4Purpose', 'Group 4 Gender', 'Group 4 Monthly Contribution', 'Group 5 Name', 'Group 5 Purpose', 'Group 5 Gender', 'Group 5 Monthly Contribution', 'Physical Violence?', 'Sexual Violence?', 'Psychological Violence?');

$columns_private = array();

?>


<div class="containerX">
  <div class="col-md-12X" style="display:inline-block; position:relative;">

<?php
/* @Murage: Redeclare column accessibility based on roles */
  $t= '<th>No. </th><th>Sub-Location</th>';
$colname= array(0,1,2,3,4,5,6,7); //[1,2,3,4,5,6,7];



if(count($colname)==0) { $colname= array(1,2,3,4,5,6,7); /*[1,2,3,4,5,6,7]*/ }

for($i=0; $i< count($clean_row); $i++){
if(in_array($i,$colname)){$checked='checked';}

 /* @Murage: Hide private columns from list  */
if(!in_array($i,$columns_private)) 
{ 
echo '<label style="font-weight:normal"><input type="checkbox" '.$checked.' value='. $i .' name="col[]"> '. $clean_row[$i] .'</label> &nbsp; ';
}
  $checked=''; 
}
//$colids=implode(",",$colname);

$k= 'sublocation';
//$t= '<th>No. </th><th>Name</th>';
for($j=0; $j < count($colname); $j++){
$l=$colname[$j];
$k .= ','. $raw_row[$l];
$t .= '<th>'. $clean_row[$l] .'</th>';
}

?>
  </div>
</div>


<?php
  /* @Murage */
  //displayArray($colname);
  ?>
	<div class="example table-responsive">
			<table id="paged" class="panel table table-striped dataTable display" data-page-size="50" data-plugin="dataTable">
				<thead>
				  <tr>
					<?php echo $t; ?>
				  </tr>
				</thead>
				<tbody>

	<?php
	$start=0;
	$limit=5000;

	if(isset($_GET['page']))
	{
		$page=$_GET['page'];
		$start=($page-1)*$limit;
	}
	else{
		$id=1;
	}
		if (($locale == "")) {
			  $subloc = "";
			} 
			elseif (($locale != "")) {
			  $subloc = " WHERE 1 OR sublocation ='". $locale ."'" ;
			}
			elseif (($locale == "")) {
			  //$subloc = " WHERE MATCH(bread_winner_name) AGAINST('$breadwinnername' IN BOOLEAN MODE)";
			  $subloc = " WHERE CONVERT(CONCAT($k) USING latin1) like '%".$sublocation."%'  " ;
			}
		   //echo "SELECT id, $k FROM households $subloc ORDER BY bread_winner_name AND bread_winner_name !=''  LIMIT $start, $limit";
	//Fetch from database first 10 items which is its limit. For that when page open you can see first 10 items.
	//$query="SELECT post_id, $k FROM `mob_form_posts_sdg_gender`  $subloc ORDER BY sublocation LIMIT $start, $limit";
	$query=mysqli_query($conn,"SELECT post_id, $k FROM `mob_form_posts_sdg_gender` $subloc ORDER BY sublocation  LIMIT $start, $limit");					

	/* @Murage: Row numbers */
	$z = ($page > 1) ? ((($page - 1) * $limit)) : 0;


			//print 10 items
			while($result=mysqli_fetch_array($query))
			{

// displayArray($result); //exit;

			   $z++;
	  ?>
			  <tr>
				<td><?php echo $z; ?></td>
<td><?php echo $result['sublocation']; ?></td>
				<?php 
				/* @Murage: added IF below */	
				for($j=0; $j < count($colname); $j++){
				  $col_=$colname[$j];
				  echo '<td>'. $result[$raw_row[$col_]] .'</td>';
				}
				?>
			  </tr>
	   <?php } ?>

			</tbody>
		</table>
	<div>
  <!-- Table ends here -->
  <!-- Pagination begin here -->
	<nav>
	  <ul class="pagination pagination-sm">
	<?php 
	//fetch all the data from database.
	$rows=mysqli_num_rows(mysqli_query($conn,"SELECT id, $k FROM `mob_form_posts_sdg_gender`  $subloc ORDER BY bread_winner_name"));
	/* @Murage : Reset variable $val */
	if(count($val)==0) { $val = ''; }

	//calculate total page number for the given table in the database
	$total=ceil($rows/$limit);
	if($page>1)
	{
	//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
		echo "<li ><a class='page-link' href='gender-database.php?MID=". $MID ."&$typ=$val&page=1' aria-label='First'>First</a></li>";

		//Go to previous page to show previous 10 items. If its in page 1 then it is inactive
		echo "<li class='page-item'><a class='page-link' href='gender-database.php?MID=". $MID ."&$typ=$val&page=". ($page-1) ."' aria-label='Previous'><span aria-hidden='true'>&laquo;</span><span class='sr-only'>Previous</span></a></li>";
	}
		$y=0;
		if ($page<11){ $p=$page;} else { $p = $page-10;}
		//show all the page link with page number. When click on these numbers go to particular page.

		for($i=$p;$i<=$total;$i++)
		{
			if($i==$page) { 
				echo '<li class="page-item active"><a class="page-link" href="#">'.$i.' <span class="sr-only">(current)</span></a></li>'; 
			} else {
				if($y==50) { break; }
				 echo "<li class='page-item'><a class='page-link' href='gender-database.php?MID=". $MID ."&$typ=$val&page=". $i ."'>". $i ."</a></li>"; 
			}
			$y++;
		}
		if($page!=$total)
			{
				////Go to previous page to show next 10 items.
				echo "<li class='page-item'><a class='page-link' href='gender-database.php?MID=". $MID."&$typ=$val&page=". ($page+1) ."' aria-label='Next'><span aria-hidden='true'>&raquo;</span><span class='sr-only'>Next</span>
				</a></li>";
			////Go to end page to sitems.
				echo "<li><a class='page-link' href='gender-database.php?MID=". $MID."&$typ=$val&page=". $total ."' aria-label='Last'>Last</a></li>";
			}
		?>
	  </ul>
	</nav>
  <!-- Pagination ends here -->


</div>
<!-- Everything that appears on the website ends here -->
</div>
