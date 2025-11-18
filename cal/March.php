<?php

$month = $_GET['month'];
$year = $_GET['year'];

/*
 
  A little Calendar function        Created on 01/03/2001
 
  by Chris Wetherell
  Oakland, CA, U.S.A.  chriswetherell.com/massless.org
 
  Distribute or use as you would like. It would be nice if you give me credit, but
  you're certainly not under any obligation.
  
  PURPOSE:
	Displays a calendar.

  REQUIREMENTS:
	PHP 4+

  Instructions?
	Just save this code as a .php file. 

	Some ways to execute this function would include:
*/	
	
	// 	Without a border...
	// MakeCalendar("01/01/2002");

	//	Specifying the size of the border...	
	MakeCalendar("$month/01/$year",2);

	//	With a border; its size and color specified...	
	// MakeCalendar("10/01/2002",5,"#99ccff");

?>


<?
 
function MakeCalendar($sDateArg,$iSizeArg="",$sColorArg="") {
	
	//	You can modify the following variables as you see fit:
		$DefaultCalendarBorderColor = "#000000";    //use a hex value
		$DefaultCalendarBorderSize = 1;             //use an integer

	//	Some useful local variable assignments
		$borderSize = $DefaultCalendarBorderSize;
		$borderColor = $DefaultCalendarBorderColor;
	
	//	Store the month names in an array
		$monthName = array('January','February','March','April','May','June','July','August','September','October','November','December');
		
	/*	Transform and store the date	*/
		
		//	Separate the date passed to the function into m, d, y...
			list ($iThisMonth, $iThisDay, $iThisYear) = split ('[/.-]', $sDateArg);		
			
		//	...and calculate the date as a UNIX timestamp (useful for calculations later)	
			$thismonthfulldate = mktime (0,0,0,$iThisMonth,$iThisDay,$iThisYear);	
			
		//	Get the month name for the date passed to the function	
			$sThisMonthName = $monthName[$iThisMonth-1];
			
		//	Retrieve the day of the week this month starts on	
			$iThisMonthStartsThisDay = date ("w", mktime (0,0,0,$iThisMonth, $iThisDay, $iThisYear));
			
			
		
	/*	Calculate how many days there are in this month	*/	
	
		//	Get the UNIX timestamp for the following month...
			$nextmonthfulldate = mktime (0,0,0,$iThisMonth+1,$iThisDay,$iThisYear);
		
		//	Get the difference between the two timestamps	
			$iDateDiffInMs = $thismonthfulldate - $nextmonthfulldate; 
		
		//	Get the numbers of days from the remainder
			$iDaysThisMonth = abs (  $iDateDiffInMs / 86400 );
			if ($iDaysThisMonth>31) {$iDaysThisMonth = 31;}
			
			
	
	//	If border size is supplied as an argument...
		if ($iSizeArg) {$borderSize = $iSizeArg;}
	
	//	And if a border color is supplied as an argument...
		if ($sColorArg) {$borderColor = $sColorArg;}
	
	/*	...then depending on whether the border size argument is supplied, start a
			border table -- a layout that will work in browsers with poor
			standards support.	*/
		if ($iSizeArg) {
			echo "<table cellpadding=\"$borderSize\" cellspacing=\"0\" border=\"0\" 
			bgcolor=\"$borderColor\"><tr><td>";
		}
		
	//	Start the calendar table...				
	echo "<table cellpadding=\"4\" cellspacing=\"1\" border=\"0\" bgcolor=\"#ffffff\">
					<tr><td colspan=\"7\"><b>
					$sThisMonthName ($iThisYear)</b></td></tr>";
	
	//	Write the row of weekday initials...
	echo "
		<tr> 
		<td align=\"center\">S</td>
		<td align=\"center\">M</td>
		<td align=\"center\">T</td>
		<td align=\"center\">W</td>
		<td align=\"center\">T</td>
		<td align=\"center\">F</td>
		<td align=\"center\">S</td>
		</tr>";
	
	//	then calculate and display the first week.
	
		echo "\n<tr>\n";
		
		static $iDayToDisplay=1;
			
		for ($i=0; $i<7; $i++) {
			if ($i==$iThisMonthStartsThisDay) {         // start with the numeral 1.
				$iDayToDisplay=1;
			} else if ($i>$iThisMonthStartsThisDay) {   // increment the date
				$iDayToDisplay+=1;
			} else {                                    // not first day yet? a non-breaking space
				$iDayToDisplay="&nbsp;";				
			}
			echo "<td align=\"center\">$iDayToDisplay</td>\n";
		}
		
		echo "</tr>\n";
		
	//	Now, display the rest of the month.
	
		$weekstogo = round( ($iDaysThisMonth-$iDayToDisplay+$iThisMonthStartsThisDay) / 7 );
		
		//	Bugfix below! [There seemed to be a problem with my math.  I'm bad at math. 
		//                 Got a problem with that? Well! Then let's settle this the way nudists 
		//                 throughout history have always settled their differences. 
		//                 Beach Volleyball!]
		//                 Special thanks to Howard van Rooijen for the fix below.]
		//	Here's the fix:			
			if (($iDaysThisMonth==30) && ($iThisMonthStartsThisDay==0)) {$weekstogo=4;}
			if (($iDaysThisMonth==30) && ($iThisMonthStartsThisDay==5)) {$weekstogo=4;}
			if (($iDaysThisMonth==31) && ($iThisMonthStartsThisDay==0)) {$weekstogo=4;}
			if (($iDaysThisMonth==31) && ($iThisMonthStartsThisDay==6)) {$weekstogo=5;}
			if (($iDaysThisMonth==31) && ($iThisMonthStartsThisDay==4)) {$weekstogo=4;}
		
		for ($x=1; $x<=$weekstogo; $x++) {
			echo "<tr>\n";
			for ($i=0; $i<7; $i++) {
				if ( $iDayToDisplay<$iDaysThisMonth && is_int($iDayToDisplay) ) {
					$iDayToDisplay+=1;          // if not end of month, display.
				} else {								
					$iDayToDisplay="&nbsp;";    // month ended?  non-breaking spaces.
				}
				echo "<td align=\"center\">$iDayToDisplay</td>\n";
			}
			echo "</tr>\n";
		}
		
	//	End the calendar table...	
		
		echo "</table>";
	
	/*	...then depending on whether the border size argument is supplied, end the
			border table	*/
	
	if ($iSizeArg) { echo "</td></tr></table>"; }	
}
 
 ?>
