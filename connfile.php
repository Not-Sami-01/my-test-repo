<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$db = 'mydatabase';
$Technicalerror = '<div class="alert mt-2 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> Sorry we are facing some technical issues.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$successMsg = '<div class="alert mt-2 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Operation executed successfully.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
$conn = mysqli_connect($servername,$username,$password,$db);
if(!$conn){
    die('Connection was not successful!');
}else{
  // echo $successMsg;
}
$br = '<br>';
function myerror($msg){
  echo '<div class="alert mb-0 alert-warning alert-dismissible fade show" role="alert">
  <strong>Error!</strong> '.$msg.'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
function mysuccess($msg){
  echo '<div class="alert mb-0 alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> '.$msg.'.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
?>