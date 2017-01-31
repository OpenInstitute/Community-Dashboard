<?php /*?><div class=" col-md-12 col-md-offset-2X">
	<form action="ServiceRegister.php#/search" method="post">
		<div class="form-group">
		<div class="col-md-8">
			<input type="text" placeholder="Search by name, location..." name="q" class="form-control">
		</div>
		<div class="col-md-4">
			<input type="submit" class="form-control" value="Search" name="qs">
		</div>
		</div>
	</form>
</div><?php */?>
<div class="col-md-12 col-md-offset-2X">
	<?php
	$crit = "";
	$i = 1;
		if(!empty($_POST['q'])){
			$searchterm = $_POST['q'];
			$crit = "  WHERE name LIKE '%$searchterm%' ";
		}
		
$arr_fu = array();
$sq_fu = "SELECT COUNT(`id`) , `parent_id` FROM `serviceregister` WHERE (`parent_id` <>0) GROUP BY `parent_id`;";
$rs_fu = $cndb->dbQuery($sq_fu); 
while ($cn_fu = $cndb->fetchRow($rs_fu)) {
	$arr_fu[$cn_fu[1]] = $cn_fu[0];
}
//displayArray($arr_fu);
			
					
		//if(isset($_POST['qs'])){
			$query = "SELECT * FROM serviceregister where parent_id = 0 order by `id` desc";
			$res = mysqli_query($conn, $query);

	?>
	<table class="table table-striped display dataTableX">
		<thead>
		<tr>
			<th>No. </th>
			<th>Name</th>
			<th>Phone No.</th>
			<th>Case Type</th>
			<th>Statement</th>
			<th>Sub-location</th>
			<th>Date</th> 
			<th>Follows</th> 
		</tr>
		</thead>
		<tbody>
	<?php
			while($results = mysqli_fetch_array($res)){
				$sr_id = $results['id'];
				$follow_up = (array_key_exists($sr_id, $arr_fu)) ? $arr_fu[$sr_id] : '0';
	?>
		<tr>
			<td><?php echo $i; ?></td>
			<td><a href="ServiceRegisterDetail.php?uid=<?php echo $results['id']; ?>"><?php echo $results['name']; ?></a></td>
			<td><?php echo $results['cell']; ?></td>
			<td><?php echo $results['casetype']; ?></td>
			<td><?php echo $results['statement']; ?></td>
			<td><?php echo $results['location']; ?></td>
			<td nowrap><?php echo $results['date']; ?></td>
			<td><?php echo $follow_up ?></td>
		</tr>


	<?php $i++; }
		//echo "</tbody></table>";

		//}else{ echo "No results found"; }

	?>
	</tbody>
	</table>
	
</div>
