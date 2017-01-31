<?php require_once('../inc/conn.inc');
//include("classes/cls.paths.php");
//displayArray($_GET);

$sess_role_id 	= $_SESSION['sess_lanet_account']['us_role'];

//displayArray($_SESSION);
$raw_row = array('bread_winner_role','bw_age','bw_id','bw_reg_to_vote','bw_occupation','bw_phone','sub_location','plot_number','property_livestock','property_farming','property_farming_other','property_house','property_sanitation_facility','property_source_drinking_water','house_facility_electricity','house_facility_sanitation','security_crime','bw_diseases','bw_health_facility','bw_health_facility_other','health_group_immunization','health_group_mosquito_nets','energy_power_source','energy_cooking_facilities');

$clean_row = array('Role In The Family','Age','ID Number','Registered Voter','Occupation','Phone Number','Location','Plot Number','Has Livestock?','Does Farming?','Farming Detail','House Type','Sanitation Facility','Source of Drinking Water?','Is Electricity Installed?','Is There Sanitation Facility?','Have There Been Any Crime?','Health Category','Visited Health Facility?','Which Health Facility?','Are Children Immunized?','Are Mosquito Nets Available?','What Is The Power Source','Energy Source For Cooking');

$columns_private = array();

$colname= array(0,1,3,4,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23); //,19,20,21,22,23

if($sess_role_id == 1)  
{ 	
	$colname= array(0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23); //,19,20,21,22,23
} 
elseif($sess_role_id == 2)  
{ 	
	$columns_private = array(2,5,7); 							
}


$k= 'bread_winner_name';


/* for($j=0; $j < count($colname); $j++){
	 $l=$colname[$j];
	 $k .= ','. $raw_row[$l];
	 $t .= '<th>'. $clean_row[$l] .'</th>';
 }*/

foreach($colname as $j) {	 
	 $k .= ','. $raw_row[$j];
}

$sq_crit = "";

	/* Array of database columns which should be read and sent back to DataTables. Use a space where
	 * you want to insert a non-database field (for example a counter or static image)
	 */
	
	$aColumns = array( 'pay_date', 'calendar_period', 'tenant', 'unit_name', 'amount', 'purpose' );
	
	/* Indexed column (used for fast and accurate table cardinality) */
	$sIndexColumn = "`id`";
	
	/* DB table to use */
	$sTable = " households ";
	
		
	/* 
	 * Paging
	 */
	$sLimit = "LIMIT 1, 50 ";
	if ( isset( $_GET['iDisplayStart'] ) && $_GET['iDisplayLength'] != '-1' )
	{
		$sLimit = "LIMIT ".$_GET['iDisplayStart'].", ". $_GET['iDisplayLength']  . " ";
	}
	
	
	/*
	 * Ordering
	 */
	$sOrder = "";
	/*if ( isset( $_GET['iSortCol_0'] ) )
	{
		$sOrder = "ORDER BY  ";
		for ( $i=0 ; $i<intval( $_GET['iSortingCols'] ) ; $i++ )
		{
			if ( $_GET[ 'bSortable_'.intval($_GET['iSortCol_'.$i]) ] == "true" )
			{
				$sOrder .= "`".$aColumns[ intval( $_GET['iSortCol_'.$i] ) ]."` ".
				 	mysql_real_escape_string( $_GET['sSortDir_'.$i] ) .", ";
			}
		}
		
		$sOrder = substr_replace( $sOrder, "", -2 );
		if ( $sOrder == "ORDER BY" )
		{
			$sOrder = "";
		}
	}*/
	$sOrder = " ORDER BY `bread_winner_name`  ";	
	
	/* 
	 * Filtering
	 * NOTE this does not match the built-in DataTables filtering which does it
	 * word by word on any field. It's possible to do here, but concerned about efficiency
	 * on very large tables, and MySQL's regex functionality is very limited
	 */
	 
	$sWhere = " WHERE bread_winner_name !='' ";
	
	if ( isset($_GET['sSearch']) && $_GET['sSearch'] != "" )
	{
		/*$sWhere = " and concat_ws(' ', `rems_property_transactions`.`pay_date`, `rems_property_transactions`.`id` , `rems_property_transactions`.`calendar_period` , `rems_property_tenants`.`full_name` , `vw_property_units`.`property_unit` , `rems_property_transactions`.`pay_in` , `rems_property_transactions`.`pay_type`) like '%".mysql_real_escape_string( $_GET['sSearch'] )."%'  ";*/
		$sWhere .= " and CONVERT(CONCAT($k) USING latin1) like ".$cndb->quote_si($_GET['sSearch'], 1)."  " ;
	}
	
	/*if ( isset($_GET['sSearch_0']) && $_GET['sSearch_0'] != "" )
	{
		$sWhere = " and `rems_property_transactions`.`pay_date` like '%".mysql_real_escape_string( $_GET['sSearch_0'] )."%'  ";
	}*/
	
	/* Individual column filtering */
	/*for ( $i=0 ; $i<count($aColumns) ; $i++ )
	{
		if ( isset($_GET['bSearchable_'.$i]) && $_GET['bSearchable_'.$i] == "true" && $_GET['sSearch_'.$i] != '' )
		{
			if ( $sWhere == "" )
			{
				$sWhere = "WHERE ";
			}
			else
			{
				$sWhere .= " AND ";
			}
			$sWhere .= "`".$aColumns[$i]."` LIKE '%".mysql_real_escape_string($_GET['sSearch_'.$i])."%' ";
		}
	}*/
	
	
	/*
	 * SQL queries
	 * Get data to display
	 */
		
	$sQuery = "SELECT  SQL_CALC_FOUND_ROWS  id, $k FROM households
 		$sWhere
		$sOrder
		$sLimit"; 
	//echo $sQuery;	
	$rResult = $cndb->dbQuery( $sQuery ); // or die(mysql_error());
	
	/* Data set length after filtering */
	$sQuery = "
		SELECT FOUND_ROWS()
	";
	$rResultFilterTotal = $cndb->dbQuery( $sQuery); // or die(mysql_error());
	$aResultFilterTotal = $cndb->fetchRow($rResultFilterTotal); //displayArray($aResultFilterTotal);
	$iFilteredTotal = $aResultFilterTotal[0];
	
	/* Total data set length */
	$sQuery = "
		SELECT COUNT(".$sIndexColumn.")
		FROM   $sTable
	";
	$rResultTotal = $cndb->dbQuery( $sQuery); // or die(mysql_error());
	$aResultTotal = $cndb->fetchRow($rResultTotal);
	$iTotal = $aResultTotal[0];
	
	
	/*
	 * Output
	 */
	$output = array(
		"sEcho" => intval($_GET['sEcho']),
		"iTotalRecords" => $iTotal,
		"iTotalDisplayRecords" => $iFilteredTotal,
		"aaData" => array()
	);
	
	while ( $aRow = $cndb->fetchRow( $rResult, 'assoc' ) )
	{
		$row = array();
		//displayArray($aRow);
		//$record_link = 'household.php?id='.$aRow['id'].'';
		
		//$row = array_values($aRow);
		foreach($aRow as $col => $val){
			if($col == 'pay_date'){
				$val = date("Y M d",strtotime($val)); 
			}
			if($col == 'bread_winner_name'){
				$record_link = 'household.php?id='.$aRow['id'].'';
				$val = '<a href="'.$record_link.'">'.$val.'</a>'; 
			}
			if($col == 'calendar_period'){
				$val = cleanCalendarPeriod($val);
			}
			if($col == 'amount'){
				$val = number_format($val,2); 
			}
			if($col <> 'id'){
			$row[] = $val; }
		}
		//$row[] = '<a class="padd5_10 btn-warning link_pay_view" href="'.$record_link.'"><i class="glyphicon glyphicon-edit"></i> View </a> <a class="padd5_10 btn-primary link_pay_receipt" href="receipt.php?id='.$aRow['id'].'" target="_blank"><i class="fa fa-print"></i> Receipt</a>';
		//displayArray($row); exit;
		$output['aaData'][] = $row;
	}
	
	echo json_encode( $output );
	
	
	
?>