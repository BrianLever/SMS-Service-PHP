<?php


require('library/php-excel-reader/excel_reader2.php');
require('library/SpreadsheetReader.php');
require('db_config.php');


if(isset($_POST['Submit'])){

    
    if(isset($_POST["sinch"]))
    {
        echo "sinch";
    }
    else if(isset($_POST["telnyx"]))
    {
        echo "telnyx";
    }
    
    print_r ($_FILES["file"]);

  $mimes = ['application/vnd.ms-excel','text/xls','text/xlsx','application/vnd.oasis.opendocument.spreadsheet','application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
  if(in_array($_FILES["file"]["type"],$mimes)){


    $uploadFilePath = 'uploads/'.basename($_FILES['file']['name']);
    move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);


    $Reader = new SpreadsheetReader($uploadFilePath);

    $totalSheet = count($Reader->sheets());


    echo "You have total ".$totalSheet." sheets".


    $html="<table border='1'>";
    $html.="<tr><th>Title</th><th>Description</th></tr>";

$num=0;
    /* For Loop for all sheets */
    for($i=0;$i<$totalSheet;$i++){


      $Reader->ChangeSheet($i);


      foreach ($Reader as $Row)
      {
        $title = isset($Row[0]) ? $Row[0] : ''; 
        $num=$num+1;
        echo $title;
        
       }
    }

}

else { 
    die("<br/>Sorry, File type is not allowed. Only Excel file."); 
  }


}
else { 
    die("<br/>Sorry, File type is not allowed. Only Excel file."); 
  }

?>