<?PHP 
        require_once("config.config");
        class Myphp
        {       
                function myphp0()
                {
                        function myphp1()
                        {
                                global $server;
                                return $server;
                        }
                 }
                 //����
                 function inserts($sqlsk)
                 {
                          global $server,$username,$password;
                          $link = mysql_connect($server,$username,$password); 
                          if (!$link) 
                          {
                                die('Could not connect: ' . mysql_error());
                          }
                          mysql_query($sqlsk);
						  $affected_rows = mysql_error();//mysql_affected_rows();
						  //printf ("inelect records: %d\n", mysql_affected_rows());
                          mysql_query("COMMIT");//�ύ����
                          mysql_close($link);
						  return $affected_rows;
                 }
                 //��ѯ
                 function SELECT($sql)
                 {
                        global $server,$username,$password;
                        $link = mysql_connect($server,$username,$password); 
                        if (!$link) 
                        {
                        die('Could not connect: ' . mysql_error());
                 }
                $result = mysql_query($sql);
                if (!$result) 
                        {
                        die('Could not select: ' . mysql_error());
                 }
                    if (mysql_num_rows($result) == 0) 
                        {
                        die('Could not select: ' . mysql_error());
                 }
				 $rows = array();
                while ($row = mysql_fetch_assoc($result)){
                        $rows[] = $row;
                 }
				  mysql_free_result($result);
                  mysql_close($link);
				  return $rows;
                } 
        }
?>