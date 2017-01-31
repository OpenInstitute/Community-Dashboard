<?php

$sqList = "SELECT 
sr_serviceregister.register_id as `id`,
sr_serviceregister.visit_date as `date`,
sr_casetype.casetype,
sr_serviceregister.name,
sr_serviceregister.location,
sr_serviceregister.cell,
sr_casestatus.status,
sr_serviceregister.statement as `description`,
count(sr_followup.followup_id) as `reviews`,
public_login.name as `posted_by`
	
FROM
	sr_serviceregister 
LEFT JOIN sr_casetype ON sr_serviceregister.casetype = sr_casetype.casetype_id 
left JOIN sr_casestatus ON sr_serviceregister.status_id = sr_casestatus.status_id
LEFT JOIN sr_followup ON sr_serviceregister.register_id = sr_followup.register_id  
LEFT JOIN public_login ON sr_serviceregister.post_by = public_login.id  
GROUP BY sr_serviceregister.register_id, sr_serviceregister.visit_date, sr_casetype.casetype, sr_serviceregister.name, sr_serviceregister.location,
sr_serviceregister.cell,
sr_casestatus.status,
sr_serviceregister.statement, public_login.name
";

 echo $m2_data->getData($sqList,"srdetail.php?d=$dir&", 0, 80, "uid");

?>