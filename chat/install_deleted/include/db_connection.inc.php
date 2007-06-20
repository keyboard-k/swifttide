<?php
if(!isset($db_host)) $db_host=DBSERVER;
if(!isset($db_user)) $db_user=DBLOGIN;
if(!isset($db_pw)) $db_pw=DBPASSWORD;
if(!isset($db_db)) $db_db=DBSEGMENT;
if(!isset($db_prefix)) $db_prefix=PREFIX;

$databases=array();

// Try to connect to database
if(false===$conn=@MYSQL_CONNECT($db_host, $db_user, $db_pw)){
  // Failed to connect MySQL server
  if(empty($quiet)){
    $errortext[]='MySQL error '.mysql_errno().': '.mysql_error();
  }
}else{
  // Server connected
  // Get databases list
  $result=mysql_query('SHOW DATABASES', $conn);
  while($data=mysql_fetch_array($result, MYSQL_ASSOC)){
    if($data['Database']<>'mysql' && $data['Database']<>'information_schema'){
      $databases[]=$data['Database'];
    }
  }
  if(!empty($databases)){
    sort($databases);
    if($db_db<>''){
      // Try to select database
      if(false===mysql_select_db($db_db, $conn)){
        if(empty($quiet)){
          $errortext[]='MySQL error '.mysql_errno().': '.mysql_error();
        }
      }else{
        if(empty($read_only)){
          // Database selected. Check user privileges.
          $error='User "'.$db_user.'" has insufficient privileges for database "'.$db_db.'"';
          $table_name='pcpin_test_tbl_'.MD5(MICROTIME());
          mysql_query('CREATE TABLE '.$table_name.' (pcpin_test VARCHAR(1) NOT NULL ) TYPE=MyISAM');
          IF(!mysql_errno()){
            mysql_query('DROP TABLE '.$table_name);
            IF(!mysql_errno()){
              mysql_query('CREATE TABLE '.$table_name.' (pcpin_test VARCHAR(1) NOT NULL ) TYPE=MyISAM');
              mysql_query('INSERT INTO '.$table_name.' (pcpin_test) VALUES (1)');
              IF(!mysql_errno()){
                mysql_query('SELECT * FROM '.$table_name);
                IF(!mysql_errno()){
                  mysql_query('ALTER TABLE '.$table_name.' CHANGE pcpin_test pcpin_test TEXT NOT NULL');
                  IF(!mysql_errno()){
                    mysql_query('UPDATE '.$table_name.' SET pcpin_test = "2"');
                    IF(!mysql_errno()){
                      mysql_query('DELETE FROM '.$table_name);
                      IF(!mysql_errno()){
                        // ALL PRIVILEGES OK
                        mysql_query('DROP TABLE '.$table_name);
                      }else{
                        // 'DELETE' test failed
                        $errortext[]=$error.' (\'DELETE\' test failed)';
                        mysql_query('DROP TABLE '.$table_name);
                      }
                    }else{
                      // 'UPDATE' test failed
                      $errortext[]=$error.' (\'UPDATE\' test failed)';
                      mysql_query('DROP TABLE '.$table_name);
                    }
                  }else{
                    // 'ALTER TABLE' test failed
                    $errortext[]=$error.' (\'ALTER TABLE\' test failed)';
                    mysql_query('DROP TABLE '.$table_name);
                  }
                }else{
                  // 'SELECT' test failed
                  $errortext[]=$error.' (\'SELECT\' test failed)';
                  mysql_query('DROP TABLE '.$table_name);
                }
              }else{
                // 'INSERT' test failed
                $errortext[]=$error.' (\'INSERT\' test failed)';
                mysql_query('DROP TABLE '.$table_name);
              }
            }else{
              // 'DROP TABLE' test failed
              $errortext[]=$error.' (\'DROP TABLE\' test failed)';
            }
          }else{
            // 'CREATE TABLE' test failed
            $errortext[]=$error.' (\'CREATE TABLE\' test failed)';
          }
        }
      }
    }
  }else{
    // There were no available databases found
    if(empty($quiet)){
      $errortext[]='No available databases found';
    }
  }
}
?>