<?PHP
/****************************************************************************
CLASS dbAccess
-----------------------------------------------------------------------------
Task:
  Manage database access
****************************************************************************/
CLASS dbAccess{


  /**************************************************************************
  dbAccess
  ---------------------------------------------------------------------------
  Task:
    Constructor. Creates dbaccess object.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION dbAccess(){
  }


  /**************************************************************************
  connect
  ---------------------------------------------------------------------------
  Task:
    Conects to database.
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION connect(){
    /* Trying to connect to database server */
    MYSQL_CONNECT(DBSERVER,DBLOGIN,DBPASSWORD)||DIE("Could not connect to database server");
    /* Trying to select database */
    MYSQL_SELECT_DB(DBSEGMENT)||DIE("Database server connected but no database found or access to database denied");
    // Check MySQL server version
    $result=mysql_query('SELECT VERSION()');
    if($data=mysql_fetch_array($result, MYSQL_NUM)){
      $mysql_version=$data[0];
    }
    $mysql_exists=explode('.', $mysql_version);
    $mysql_needed=explode('.', PCPIN_REQUIRESMYSQL);
    foreach($mysql_needed as $key=>$val){
      if(!isset($mysql_exists[$key])){
        // Installed MySQL version is OK
        break;
      }else{
        if($val>$mysql_exists[$key]){
          // MySQL version is too old
          die("<b>Fatal error</b>: Installed MySQL server version is <b>$mysql_version</b> (minimum required MySQL version is <b>".PCPIN_REQUIRESMYSQL."</b>)");
        }elseif($val<$mysql_exists[$key]){
          // Installed MySQL version is OK
          break;
        }
      }
    }
  }

  /**************************************************************************
  query
  ---------------------------------------------------------------------------
  Task:
    Queries SQL database and returns pointer to result.
  ---------------------------------------------------------------------------
  Parameters:
    sql       string      SQL string
  ---------------------------------------------------------------------------
  Return:
    RESOURCE              SQL query result
  **************************************************************************/
  FUNCTION query($sql=""){
    $result=MYSQL_QUERY($sql);
    RETURN $result;
  }


  /**************************************************************************
  fetchArray
  ---------------------------------------------------------------------------
  Task:
    Reads dataset from query result
  ---------------------------------------------------------------------------
  Parameters:
    resource        Resource          SQL query result resource
    result_type     int               Type of result
  ---------------------------------------------------------------------------
  Return:
    array                   Dataset fetched from SQL query result
  **************************************************************************/
  FUNCTION fetchArray($resource, $result_type=MYSQL_BOTH){
    $data=NULL;
    IF($resource){
      $data=MYSQL_FETCH_ARRAY($resource, $result_type);
    }
    RETURN $data;
  }


  /**************************************************************************
  fetchAll
  ---------------------------------------------------------------------------
  Task:
    Fetches all datasets from query result
  ---------------------------------------------------------------------------
  Parameters:
    result          RESOURCE      SQL query result
    result_type     int           Result type
  ---------------------------------------------------------------------------
  Return:
    array                   All datasets fetched from SQL query result
  **************************************************************************/
  FUNCTION fetchAll($result, $result_type=MYSQL_BOTH){
    WHILE($tmp=$this->fetchArray($result, $result_type)){
      IF(!ISSET($data)){
        $data=ARRAY();
      }
      $data[]=$tmp;
    }
    IF(!ISSET($data)){
      $data=NULL;
    }
    RETURN $data;
  }


  /**************************************************************************
  analyzeDB
  ---------------------------------------------------------------------------
  Task:
    Analyze database tables
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return:
    Boolean TRUE if table(s) need(s) to be optimized
  **************************************************************************/
  FUNCTION testDB(){
    // List all chat tables
    $query="SHOW TABLES LIKE '".PREFIX."%'";
    $result=$this->db->query($query);
    WHILE($data=$this->db->fetchArray($result)){
      $query="CHECK TABLE {$data[0]}";
      $result2=$this->db->query($query);
      $data2=$this->db->fetchArray($result2);
      IF($data2[Msg_text]<>"OK"){
        // Error or warning found. One or more tables needs to be optimized.
        RETURN TRUE;
      }
    }
    // Looking for overhead
    $query="SHOW TABLE STATUS LIKE '".PREFIX."%'";
    $result=$this->db->query($query);
    WHILE($data=$this->db->fetchArray($result)){
      IF($data[Data_free]){
        // Overhead found. One or more tables needs to be optimized.
        RETURN TRUE;
      }
    }
    // Looking for errors and warnings
    // No optimization needed.
    RETURN FALSE;
  }

  /**************************************************************************
  optimizeDB
  ---------------------------------------------------------------------------
  Task:
    Optimize database tables
  ---------------------------------------------------------------------------
  Parameters: --
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION optimizeDB(){
    // List all chat tables
    $query="SHOW TABLES LIKE '".PREFIX."%'";
    $result=$this->db->query($query);
    $tables=$this->db->fetchAll($result);
    $tables_count=COUNT($tables);
    FOR($i=0;$i<COUNT($tables);$i++){
      $query="OPTIMIZE TABLE {$tables[$i][0]}";
      $this->db->query($query);
    }
  }

  /**************************************************************************
  getUsersRoom
  ---------------------------------------------------------------------------
  Task:
    Get user's room ID
  ---------------------------------------------------------------------------
  Parameters:
    $user_id            int             User ID
  ---------------------------------------------------------------------------
  Return:
    Room ID (int)
  **************************************************************************/
  FUNCTION getUsersRoom($user_id=0){
    IF($user_id){
      $query="SELECT room_id FROM ".PREFIX."session WHERE user_id = $user_id";
      $result=$this->db->query($query);
      $data=$this->db->fetchArray($result);
      RETURN $data[0];
    }
  }


}
?>