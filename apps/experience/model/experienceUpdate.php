<?php
function experienceUpdate($user){
	$start = explode("/", request::read('start'));
	$month = isset($start[0]) ? intval($start[0]) : 8;
	$day = isset($start[1]) ? intval($start[1]) : 2;
	$year = isset($start[2]) ? intval($start[2]) : 1980;
	$start = mktime(8,0,0,$month,$day,$year);
	$completion = explode("/", request::read('completion'));
	$month = isset($completion[0]) ? intval($completion[0]) : 8;
	$day = isset($completion[1]) ? intval($completion[1]) : 2;
	$year = isset($completion[2]) ? intval($completion[2]) : 1980;
	$completion = mktime(17,0,0,$month,$day,$year);
	$result = database::query(sprintf("UPDATE `experience` SET `organisation` = '%s', `start` = %d, `completion` = %d, `role` = '%s', `notes` = '%s', `team` = %d, `updateTime` = %d WHERE `user` = %d LIMIT 1", database::sanitize(request::read('organisation')), $start, $completion,  database::sanitize(request::read('role')), database::sanitize(request::read('notes')), database::sanitize(request::read('team')), time(), $user));
	global $db_link;
	return $result ? mysqli_affected_rows($db_link) : false;
}
?>