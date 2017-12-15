             <?php
                include_once('include/Conn.php');
                $strSQL = "SELECT * FROM reserv WHERE id_status_reserv='1' ORDER BY id_reserv DESC";
                $objQuery = mysql_query($strSQL) or die (mysql_error());
                $intNumField = mysql_num_fields($objQuery);
                $resultArray = array();
                while($obResult = mysql_fetch_array($objQuery))
                {
                    $arrCol = array();
                    for($i=0;$i<$intNumField;$i++)
                    {
                        $arrCol[mysql_field_name($objQuery,$i)] = $obResult[$i];
                    }
                    array_push($resultArray,$arrCol);
                }
                
                echo json_encode($resultArray);
                 ?>
