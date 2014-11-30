<!DOCTYPE html>
<html>
   <head>
      <title>Test za posao</title>
      <link href="style.css" rel="stylesheet" type="text/css" media="screen" />
   </head>
   <body>
      <?php
         require('shifts.php');
         ?>
      <br><br>
      <h2>Today's shifts:</h2>
      <br>
      <table>
         <?php
            $shifts = $shiftplanning->getResponse(); // returns the response/data for the api call
            if( $shifts['status']['code'] == 1){// shifts were retrieved successfully
            
            	foreach ($shifts['data'] as $number => $shift) {// loop through each shift that was returned
            	?>
         <tr>
            <th>
               <?php
                  for ($i = 0; $i < count($shift['employees']); $i++) {//loop through each employee for current shift
                  	echo $shift['employees'][$i]['name'];//display name of each employee for current shift
                  	if ($i < (count($shift['employees']) - 1)) {
                  		echo ',';
                  ?>
               <br/>
               <?php
					}
                  }
                  ?>
            </th>
         </tr>
         <tr>
            <td>Position:
               <?php
                  echo $shift['schedule_name'] . " " . $shift['start_date']['time'] . " - " . $shift['end_date']['time'];
                  ?>
            </td>
         </tr>
         <?php    
				}
            }
             ?>
      </table>
   </body>
</html>