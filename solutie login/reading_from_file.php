<?php
//get user/ password from external file
function getData($user , $password){
  $myfile = fopen("data.txt", "r") or die("Unable to open file!");
  $filestring = fread($myfile, filesize("data.txt"));
  if(strlen($filestring) != 0){
    $stringbreak = "\n";
    $filestring = explode($stringbreak, $filestring);
    for($i = 0 ; $i < count($filestring); $i++) {
      $temp = array();
      $temp = explode("=>", $filestring[$i]);
      if($user == $temp[0] && $password == $temp[1]){
        return true;
      }
    }
  }
}



//set user/ password on external file
function setData($user, $password){
  $myfile = fopen("data.txt", "a") or die("Unable to open file!");
  fwrite($myfile , $user.'=>'.$password);
  $stringbreak = "\n";
  fwrite($myfile, $stringbreak);
  fclose($myfile);
}


 ?>
