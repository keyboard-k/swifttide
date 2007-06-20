<?PHP
/****************************************************************************
CLASS email
-----------------------------------------------------------------------------
Task:
  Send emails
****************************************************************************/

CLASS email{

  /**************************************************************************
  send
  ---------------------------------------------------------------------------
  Task:
    Send email
  ---------------------------------------------------------------------------
  Parameters:
    $from             string            Sender
    $to               string            Receiver
    $subject          string            Email subject
    $body             string            Email body
  ---------------------------------------------------------------------------
  Return: --
  **************************************************************************/
  FUNCTION send($from_email="",$from_name="",$to="",$subject="",$body=""){
    IF($to){
      $headers="";
      IF($from_name){
        $from=$from_name." <".$from_email.">";
      }ELSE{
        $from=$from_email;
      }
      IF($from_email){
        $headers.="From: $from\r\n";
        $headers.="Reply-To: $from\r\n";
      }
      MAIL($to,$subject,$body,$headers);
    }
  }




}
?>