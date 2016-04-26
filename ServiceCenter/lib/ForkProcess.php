<?php
$process_num = 5; //Decide how many process!!
$children = array(); //Array for store child
$ResultArr = array();

include("/home/yespasta/ServiceCenter/lib/ForkLib.php");

$obj = new ForkLib();

$arrList = $obj->getJobsList(); //Fetch Jobs list from DB
$totalNum = count($arrList); //Variable for count total

print("Total Jobs: ".count($arrList)."\n");

$ratio = round($totalNum / $process_num); //Slice Jobs

if($totalNum < ($process_num+1)) $ratio = 1; //If Jobs smaller than processes, than slice one.

//The Child Process produce here.
for($i = 1;$i <= $process_num; $i++) {
    $pid = pcntl_fork();

    if($pid == -1) {
        exit(1);
    } else if ($pid) {
    	
    //Father Process here
    $children[] = $pid; //Record all child serial
    //print "No.{$i} Child¡Apid is {$pid}\n";
   } else {
   	
   //Child Process here
    break; //Exit loop directly
   }
}
if($pid) { /* Father Process wait here */
    $status = null;
    sleep(0);
    foreach($children as $pid) { //Wait until every child finished.
        pcntl_waitpid($pid, $status); 
        //print "{$pid} Child, end and status is {$status}\n";
    }
    //print 'Father Process end here. '."\n";
    //$obj = new ForkLib();
    
    
    //You can do put finally things here.
    print "All Processes end.";

} else {
    //*Child Process work here*/
    
    //sleep(10);
    $limit = $i*$ratio; //Decide the default ratio value
    
    //Loop process and save to db
    for($v = $limit-$ratio; $v < $limit; $v++){
    	 switch($obj->JobsDispatch()){
    	    case 1: echo $arrList[$v]."-".$obj->execute(1, $arrList[$v])."\n";
    	    break;    	    
    	    case 2: echo $arrList[$v]."-".$obj->execute(2, $arrList[$v])."\n";
    	    break;    	    
    	    case 3: echo $arrList[$v]."-".$obj->execute(3, $arrList[$v])."\n";
    	    break;    	    
    	    default: print("Error.....");	
    	 	  break;
    	 }
    }
    
    

}


?>

