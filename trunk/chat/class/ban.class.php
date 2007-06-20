<?PHP
/****************************************************************************
CLASS ban
-----------------------------------------------------------------------------
Task:
  Manage banned users and IP addresses
****************************************************************************/

CLASS ban{

  /* Class variables */

  /* ID
  *  Type: int
  */
  VAR $id=0;

  /* User ID
  *  Type: int
  */
  VAR $user_id=0;

  /* IP address
  *  Type: string
  */
  VAR $ip='';

  /* Ban date
  *  Type: int (UNIX timestamp)
  */
  VAR $bandate=0;




  /**************************************************************************
  ban
  ---------------------------------------------------------------------------
  Task:
    Constructor.
    Ban user and/or IP address.
  ---------------------------------------------------------------------------
  Parameters:
    $session            object          Session handle
    $user_id            int             User ID
    $ip                 string          IP address
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION ban(&$session,$user_id=0,$ip=""){
    IF($user_id||$ip){
      // Ban user ID and/or IP address
      IF($user_id){
        // Delete other records with the same user ID
        $query="DELETE FROM ".PREFIX."ban WHERE user_id = $user_id";
        $session->db->query($query);
        // Insert new record
        $query="INSERT INTO ".PREFIX."ban (user_id, bandate) VALUES ($user_id, UNIX_TIMESTAMP())";
        $session->db->query($query);
      }
      IF($ip){
        // Delete other records with the same IP address
        $query="DELETE FROM ".PREFIX."ban WHERE ip = '$ip'";
        $session->db->query($query);
        // Insert new record
        $query="INSERT INTO ".PREFIX."ban (ip, bandate) VALUES ('$ip', UNIX_TIMESTAMP())";
        $session->db->query($query);
      }
    }
  }

  /**************************************************************************
  banList
  ---------------------------------------------------------------------------
  Task:
    List banned users and IP addresses
  ---------------------------------------------------------------------------
  Parameters:
    $session            object          Session handle
    $usr_sortby         int             Sort banned users by: (0: Username, 1: Ban date)
    $usr_sortdir        int             Banned users sort direction: (0: Ascending, 1: Descending)
    $ip_sortby          int             Sort banned IP addresses by: (0: IP, 1: Ban date)
    $ip_sortdir         int             Banned IP addresses sort direction: (0: Ascending, 1: Descending)
  ---------------------------------------------------------------------------
  Return:
    Array with banned users and IP addresses
  **************************************************************************/
  FUNCTION banList(&$session, $usr_sortby=0, $usr_sortdir=0, $ip_sordby=0, $ip_sortdir=0){
    $list=ARRAY();
    $usr_orderdir=$usr_sortdir? 'DESC' : 'ASC';
    $usr_orderby=$usr_sortby? 'bandate '.$usr_orderdir : 'login '.$usr_orderdir;
    $ip_orderdir=$ip_sortdir? 'DESC' : 'ASC';
    $ip_orderby=$ip_sortby? 'ip_n '.$ip_orderdir : 'bandate '.$ip_orderdir;
    // Get users
    $query='SELECT bb.*,
                   us.login AS login
              FROM '.PREFIX.'ban bb
         LEFT JOIN '.PREFIX.'user us ON us.id = bb.user_id
             WHERE bb.user_id > 0
          ORDER BY '.$usr_orderby;
    $result=$session->db->query($query);
    $list=$session->db->fetchAll($result, MYSQL_ASSOC);
    // Get IPs
    $query='SELECT bb.*
              FROM '.PREFIX.'ban bb
             WHERE bb.user_id = 0
          ORDER BY '.$ip_orderby;
    $result=$session->db->query($query);
    WHILE($data=$session->db->fetchArray($result, MYSQL_ASSOC)){
      $list[]=$data;
    }
    RETURN $list;
  }

  /**************************************************************************
  unBan
  ---------------------------------------------------------------------------
  Task:
    Remove user/IP address from banlist
  ---------------------------------------------------------------------------
  Parameters:
    $session            object          Session handle
    $id                 int             Ban-ID
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION unBan(&$session,$id=0){
    IF($id){
      $query="DELETE FROM ".PREFIX."ban WHERE id = $id";
      $session->db->query($query);
    }
  }

  /**************************************************************************
  checkUser
  ---------------------------------------------------------------------------
  Task:
    Check whether user banned or not
  ---------------------------------------------------------------------------
  Parameters:
    $session            object          Session handle
    $user_id            int             User-ID
  ---------------------------------------------------------------------------
  Return:
    TRUE if user is not banned
    FALSE if user is banned
  **************************************************************************/
  FUNCTION checkUser(&$session,$user_id=0){
    IF($user_id){
      $query="SELECT 1 FROM ".PREFIX."ban WHERE user_id = $user_id LIMIT 1";
      $result=$session->db->query($query);
      RETURN !$session->db->fetchArray($result);
    }
  }

  /**************************************************************************
  checkIP
  ---------------------------------------------------------------------------
  Task:
    Check whether IP address banned or not
  ---------------------------------------------------------------------------
  Parameters:
    $session            object          Session handle
    $ip                 string          IP address
  ---------------------------------------------------------------------------
  Return:
    TRUE if IP address is not banned
    FALSE if IP address is banned
  **************************************************************************/
  FUNCTION checkIP(&$session,$ip=""){
    IF($ip){
      $query="SELECT 1 FROM ".PREFIX."ban WHERE ip = '$ip' LIMIT 1";
      $result=$session->db->query($query);
      RETURN !$session->db->fetchArray($result);
    }ELSE{
      RETURN TRUE;
    }
  }


}
?>