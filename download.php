<?php
include_once('include/db.php');
if(isset($_REQUEST['file'])){
  $id_dir=$_REQUEST['file'];
  $result = findFile($id_dir);
  $path_file = 'upload/'.$id_dir.'/'.$result['name'].'.'.$result['type'];
  if (file_exists($path_file)) {
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="'.basename($path_file).'"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($path_file));
    readfile($path_file);
    exit;
  }
}
else{
  echo 'File not found.';
}
?>
