<?php 
include '../bin/dbconn.php';
// 1. Get $hal from url
IF (ISSET($_GET['hal'])) {
   $hal = $_GET['hal'];
} ELSE {
   $hal = 1;
} 

//2. count total number of rows
$q="select count(*) from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID";
		$s = oci_parse($c, $q);
		oci_execute($s);
$numrows=oci_fetch_row($s);
$numrows=$numrows[0];
echo $numrows."<br>";

// 3. Calculate number of $lastpage
// This code uses the values in $rows_per_page and $numrows in order to identify the number of the last page.
$rows_per_page = 10;
$lastpage = CEIL($numrows/$rows_per_page);
echo $lastpage;

// 4. Ensure that $pageno is within range
// This code checks that the value of $pageno is an integer between 1 and $lastpage.
 
$hal = (int)$hal;
IF ($hal < 1) {
   $hal = 1;
} ELSEIF ($hal > $lastpage) {
   $hal = $lastpage;
} // if

// 5. Construct LIMIT clause
// This code will construct the LIMIT clause for the sql SELECT statement.
$limitmin = ($hal-1)*$rows_per_page;
$limitmax = $limitmin+$rows_per_page;
?><table>
<?php
// 6. Issue the database query
// Now we can issue the database qery with the limit set and process the result.
$qPaging="SELECT outer.*
  FROM (SELECT ROWNUM rn, inner.*
          FROM (select a.SUBJEK_PAJAK_ID, a.JALAN_OP, a.RT_OP, a.RW_OP, b.NM_WP 
		                from DAT_OBJEK_PAJAK a, DAT_SUBJEK_PAJAK b
						WHERE a.SUBJEK_PAJAK_ID = b.SUBJEK_PAJAK_ID) inner) outer
 WHERE outer.rn >= ".$limitmin." AND outer.rn <= ".$limitmax;
 $s = oci_parse($c, $qPaging);
		oci_execute($s);
		$i=0;
while (($row = oci_fetch_array($s))) {
 	   	// Use the uppercase column names for the associative array indices
    	$i=$i+1;
		?>
                                    <tbody>
                                        <tr>
                                            <td><?=$i;?></td>
                                            <td><?=$row['SUBJEK_PAJAK_ID']?></td>
                                            <td><?=$row['JALAN_OP']?></td>
                                            <td><?=$row['RT_OP'].'/'.$row['RW_OP']?></td>
                                            <td><?=$row['NM_WP']?></td>
                                            <td><button type="button" class="btn btn-success btn-sm" onClick="window.open('detail.html','demo','width=1200,height=600,left=150,top=200,toolbar=0,status=0,location=0')">Detail</button></td>
                                        </tr>
         <?php }//end of while (($row = oci_fetch_array($stid, OCI_BOTH)) != false)?>       
                                    </tbody>
                                </table>
                                <br>
<?php
// 7. Construct pagination hyperlinks
// Finally we must construct the hyperlinks which will allow the user to select 
// other pages. We will start with the links for any previous pages.
IF ($hal == 1) {
   ECHO " FIRST PREV ";
} ELSE {
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=1'>FIRST</a> ";
   $prevpage = $hal-1;
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$prevpage'>PREV</a> ";
} // if
// Next we inform the user of his current position in the sequence of available pages.
ECHO " ( Page $hal of $lastpage ) ";
// This code will provide the links for any following pages.
IF ($hal == $lastpage) {
   ECHO " NEXT LAST ";
} ELSE {
   $nextpage = $hal+1;
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$nextpage'>NEXT</a> ";
   ECHO " <a href='{$_SERVER['PHP_SELF']}?hal=$lastpage'>LAST</a> ";
} // if
?>