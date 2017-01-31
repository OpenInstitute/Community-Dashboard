<?php include '../inc/conn.inc';

	$crit = "";
	
        if(!empty($_GET['param'])){
            $searchterm = $_GET['param'];
            if ($searchterm=='all'){
                $crit = "";
                $rTitle = "All Cases Report";
            }
            if ($searchterm=='nxtW'){
                $crit = " WHERE week(`date`) = week(DATE_ADD(NOW(), INTERVAL 1 WEEK))";
                $rTitle = "Next Week Cases Report";
            }
            if ($searchterm=='nxtM'){
                $crit = " WHERE month(`date`) = month(DATE_ADD(NOW(), INTERVAL 1 MONTH))";
                $rTitle = "Next Month Cases Report";
            }
            if ($searchterm=='umoja'){
                $crit = " WHERE location = 'Umoja'";
                $rTitle = "Umoja Sublocation Report";
            }
            if ($searchterm=='murunyu'){
                $crit = " WHERE location = 'Murunyu'";
                $rTitle = "Murunyu Sublocation Report";
            }
            if ($searchterm=='kiamunyeki'){
                $crit = " WHERE location = 'Kiamunyeki'";
                $rTitle = "Kiamunyeki Sublocation Report";
            }
            
            
        }
        //if(isset($_POST['qs'])){
            $query = "SELECT * FROM serviceregister $crit";
            $res = mysqli_query($conn, $query);

    ?>
    <div class="panel panel-table">
        <center>
            <h3><?php echo $rTitle; ?></h3>
        </center>
    <table class="table table-striped display">
        <thead>
        <tr>
            <th>No. </th>
            <th>Name</th>
            <th>Phone Number</th>
            <th>Case Type</th>
            <th>Statement</th>
            <th>Sub-location</th>
            <th>Date</th> 
        </tr>
        </thead>
        <tbody>
    <?php
            while($results = mysqli_fetch_array($res)){
                $i++
    ?>
        <tr>
            <td><?php echo $i; ?></td>
            <td><a href="registerDetails.php?uid=<?php echo $results['id']; ?>"><?php echo $results['name']; ?></a></td>
            <td><?php echo $results['cell']; ?></td>
            <td><?php echo $results['casetype']; ?></td>
            <td><?php echo $results['statement']; ?></td>
            <td><?php echo $results['location']; ?></td>
            <td><?php echo $results['date']; ?></td>
        </tr>


    <?php }
        //echo "</tbody></table>";

        //}else{ echo "No results found"; }
    ?>
	</tbody>
	</table>
</div>