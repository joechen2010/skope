<?PHP 
        require_once("config.config");
        require_once("util.php");
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
                 
                 
                 
                 //插入
                 function inserts($sqlsk)
                 {
                          global $server,$username,$password;
                          $link = mysql_connect($server,$username,$password); 
                          if (!$link) 
                          {
                          		log_action(mysql_error());
                                //die('Could not connect: ' . mysql_error());
                          }
                          mysql_query($sqlsk);
						  $affected_rows = mysql_error();//mysql_affected_rows();
						  //printf ("inelect records: %d\n", mysql_affected_rows());
                          mysql_query("COMMIT");//提交事务
                          mysql_close($link);
						  return $affected_rows;
                 }
                 
                 
                 
                 
                 
                 //查询
                 function SELECT($sql)
                 {
                 		
                        global $server,$username,$password;
                        $link = mysql_connect($server,$username,$password); 
                        if (!$link) 
                        {	log_action(mysql_error()+"....");
                 		}
                $result = mysql_query($sql);
                if (!$result) {
                	    log_action(mysql_error());
                }
                if (mysql_num_rows($result) == 0){
                	    log_action(mysql_error());
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