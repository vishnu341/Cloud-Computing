<?php
$db=mysqli_connect('localhost','root','','demo') or die("could not connect to database");
$user_name=mysqli_real_escape_string($db,$_POST['uname']);
$invisible=mysqli_real_escape_string($db,$_POST['uname1']);
// $query="update login set cypher='$username' where username='$invisible'";
// mysqli_query($db,$query) or die("Failed to execute the Query :( . Try Again !");
// $db->close();


echo $invisible;



require_once('blowfish.php');

$examples = array(
  array(  'd)U>tQwbUWIozi2R"fOvK0Wuxyl79P%Uxr>;7iiy,b0hByATUB',
          'x03nMwK34x&ciSUH0I1got',
          $user_name
  ),


);

foreach ($examples as $ex) {
  $ciphertext = Blowfish::encrypt(
                //   $ex[2],
                  $user_name,
                  'd)U>tQwbUWIozi2R"fOvK0Wuxyl79P%Uxr>;7iiy,b0hByATUB',
                //   $ex[0], # encryption key
                  Blowfish::BLOWFISH_MODE_CBC, # Encryption Mode
                  Blowfish::BLOWFISH_PADDING_RFC, # Padding Style
                  'x03nMwK34x&ciSUH0I1got'
                //   $ex[1]  # Initialisation Vector - required for CBC
  );
  // echo $ciphertext;
  $deciphered = Blowfish::decrypt(
    $ciphertext,
      'd)U>tQwbUWIozi2R"fOvK0Wuxyl79P%Uxr>;7iiy,b0hByATUB',
      Blowfish::BLOWFISH_MODE_CBC, # Encryption Mode
      Blowfish::BLOWFISH_PADDING_RFC, # Padding Style
      'x03nMwK34x&ciSUH0I1got'  # Initialisation Vector - required for CBC
);
  

  
}
 





  echo '<pre>';
  printf('Plaintext: %s (length %d)%s', $ex[2], strlen($ex[2]), PHP_EOL);
  printf('Ciphertext: %s (length %d)%s', $ciphertext, strlen($ciphertext), PHP_EOL);
  printf('Deciphered text: %s (length %d)%s', $deciphered, strlen($deciphered), PHP_EOL);

  $query="update login set plaintext='".$user_name."' , cyphertext='" .$ciphertext."' , decyphertext='".$deciphered."' where username='" . $invisible . "';";
//   $query="Update login set cypher='" . $ciphertext ."' where username='" . $invisible . "';";
  // echo $query;

  mysqli_query($db,$query) or die("Failed to execute the Query :( . Try Again !");
  $db->close();
 
  header("Location:scene1.php");  
  

//   $sql = "select * from login limit 1";
// $result = $db->query($sql);

// if ($result->num_rows > 0) {
  
//   while($row = $result->fetch_assoc()) {
//     $username1= $row["cypher"];
//     echo $username1;
//   }
// }
    
    
   

//  }
?>