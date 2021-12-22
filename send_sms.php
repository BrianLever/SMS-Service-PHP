<?php
if (isset($_POST["Submit"])) {
    error_reporting(0);
    include 'functions.php';

    require('library/php-excel-reader/excel_reader2.php');
    require('library/SpreadsheetReader.php');
    require('db_config.php');

    if (isset($_POST['Submit'])) {
        if ($_POST["api"]=="telnyx") {
            $interval=3;
            $api_name="Gateway 1";
            $from=$_POST["mobile"];
            $apikey=$_POST["apikey"];
            $text=$_POST["textmsg"];
            $api = "Telnyx";
        } else if ($_POST["api"]=="sinch") {
            $api_name="Gateway 2";
            $from=$_POST["mobile"];
            $apikey=$_POST["apikey"];
            $text=$_POST["textmsg"];
            $spid=$_POST["spid"];
            $api = "Sinch";
        } else if ($_POST["api"] == "twilio") {
            $api_name="Twilio";
            $from=$_POST["mobile"];
            $sid =$_POST["twilio_sid"];
            $token = $_POST['twilio_auth_token'];
            $text=$_POST["textmsg"];
            $api = "twilio";
        } else if ($_POST["api"] == "nexmo") {
            $api_name           =   "Nexmo";
            $from               =   $_POST["mobile"];
            $provider_key       =   $_POST["provider_key"];
            $provider_secret    =   $_POST["provider_secret"]; 
            $text               =   $_POST["textmsg"];
            $api                =   "nexmo";

        }else if ($_POST["api"] == "clicksend") {
            $api_name            =   "clicksend";
            $from                =   $_POST["mobile"];
            $clicksend_username  =   $_POST["clicksend_username"];
            $clicksend_apikey    =   $_POST["clicksend_apikey"]; 
            $text                =   $_POST["textmsg"];
            $api                 =   "clicksend";

        }
        /*else if ($_POST["api"] == "clickatell") {
            $api_name            =   "clickatell";
            $from                =   $_POST["mobile"]; 
            $clicksend_apikey    =   $_POST["clickatell_apikey"]; 
            $text                =   $_POST["textmsg"];
            $api                 =   "clickatell"; 
        }*/
        else if ($_POST["api"] == "smsto") {
            $api_name            =   "smsto"; 
            $clicksend_apikey    =   $_POST["smsto_api_key"]; 
            $text                =   $_POST["textmsg"];
            $api                 =   "smsto";
        }
        else if ($_POST["api"] == "proovl") {
            $api_name            =   "proovl";
            $from                =   $_POST["mobile"];
            $proovl_userid       =   $_POST["proovl_userid"]; 
            $proovl_token        =   $_POST["proovl_token"];  
            $text                =   $_POST["textmsg"];
            $api                 =   "proovl";
        }
        else if ($_POST["api"] == "txtsync") {
            $api_name                =   "TxtSync"; 
            $txtsync_client_key      =   $_POST["txtsync_client_key"]; 
            $txtsync_client_secret   =   $_POST["txtsync_client_secret"];
            $text                    =   $_POST["textmsg"];
            $api                     =   "txtsync";
        }
        else if ($_POST["api"] == "message_media") {
            $api_name = "Message Media";
            $from = $_POST["mobile"];
            $username = $_POST["msg_media_username"];
            $password = $_POST['msg_media_pswd'];
            $text = $_POST["textmsg"];
            $api = "message_media";
        } else if ($_POST["api"] == "tm4b") {
            $api_name="TM4B";
            $from=$_POST["mobile"];
            $apikey=$_POST["apikey"];
            $text=$_POST["textmsg"];
            $api = "tm4b";
        } else if ($_POST["api"] == "textbelt") {
            $api_name="TextBelt";
            $from=$_POST["mobile"];
            $apikey=$_POST["apikey"];
            $text=$_POST["textmsg"];
            $api = "textbelt";
        } else if ($_POST["api"]=="globalsms") {
            $api_name="Global SMS";
            $text=$_POST["textmsg"];
            $api = "GlobalSms";
            $api_secret=$_POST["spi_secret"];
            $api_key=$_POST["apikey"];
        } else if ($_POST["api"]=="msgbird") {
            $api_name="MSG Bird";
            $text=$_POST["textmsg"];
            $api = "MessageBird";
            $org=$_POST["mobile"];
            $api_key=$_POST["apikey"];
        } else if ($_POST["api"] == "bulkgate") {
            $api_name="Bulk Gate";
            $text=$_POST["textmsg"];
            $api = "bulkgate";
            $app_id=$_POST["app_id"];
            $app_token = $_POST['app_token'];
        } else if ($_POST["api"]=="cm") {
            $api_name="CM";
            $text=$_POST["textmsg"];
            $api = "cm";
            $prod_token = $_POST["product_token"];
        }

        //print_r($_POST);        
        //print_r($_FILES["file"]);

        if($_FILES["file"]["size"]>0) {
            $req_type="SHEET";
            $mimes = ['application/vnd.ms-excel', 'text/xls', 'text/xlsx', 'application/vnd.oasis.opendocument.spreadsheet', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
            if (in_array($_FILES["file"]["type"], $mimes)) {
                $uploadFilePath = 'uploads/' . basename($_FILES['file']['name']);
                move_uploaded_file($_FILES['file']['tmp_name'], $uploadFilePath);
                $Reader = new SpreadsheetReader($uploadFilePath);
                $totalSheet = count($Reader->sheets());
               // echo "You have total " . $totalSheet . " sheets" .
               // $html = "<table border='1'>";
               // $html .= "<tr><th>Title</th><th>Description</th></tr>";
                $num = 0;
                /* For Loop for all sheets */                
            } else {
                die("<br/>Sorry, File type is not allowed. Only Excel file.");
            }
        } else {
                
            if(isset($_POST["to_mobile"])) {
                $req_type="MOB";
                $to_mob=$_POST["to_mobile"];
            } else {
                header("locatio:index.php?errr=nomob");
            }
        }
    }
} else {
    header("locatio:index.php?errr=unauth");
}
?>

<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>BulkSMS </title>
 <?php include 'include/header.php';  ?>
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <?php include 'include/nav.php'; ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->    
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->     
      <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">              
              <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">SMS Report</h4>
                  <p class="card-description">
                    SMS Report From Callback Of 
                  </p>
                  <div class="table-responsive">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>
                            Mobile Number
                          </th>
                          <th>
                            Status
                          </th>
                          <th>
                            API 
                          </th>
                          <?php if($api=="Sinch"){ 
                              echo "<th> SMS ID </th>";
                              
                          }?>                          
                          <th>
                            Failed Msg
                          </th>
                        </tr>
                      </thead>
                      <tbody>
            <?php
            if($req_type=="SHEET") {
                for ($i = 0; $i < $totalSheet; $i++) {
                    $Reader->ChangeSheet($i);
                    foreach ($Reader as $Row) {
                        $m_number = isset($Row[0]) ? $Row[0] : '';
                        
                        //$num = $num + 1;
                        if($api=="Telnyx") {
                           $status= telnyx_send($m_number, $text,$from,$apikey);
                           //sleep($interval);
                        } else if ($api=="Sinch") {
                             $status= sinch_sms($m_number, $text,$from,$apikey,$spid);
                        } else if($api=="twilio") { 
                            $status= twilio_sms($m_number, $text,$from,$sid,$token); 
                        }else if($api=="nexmo") { 
                            $status = nexmo_sms( $from, $m_number, $text, $provider_key, $provider_secret);  
                        }else if($api=="clicksend") {
                            $status = clicksend_sms($from, $m_number, $text, $clicksend_username, $clicksend_apikey);  
                        }else if($api=="smsto") {
                            $status = smsto_sms($m_number, $text, $clicksend_apikey);  
                        }else if($api=="proovl") {
                            $status = proovl_sms($from, $m_number, $text, $proovl_userid, $proovl_token);  
                        }else if($api=="txtsync") {
                            $status = txtsync_sms($m_number, $text, $txtsync_client_key, $txtsync_client_secret);  
                        }else if($api=="message_media") {
                            $status= message_media_sms($m_number, $text,$from,$username,$password); 
                        } else if($api == "tm4b") {
                            $status = tm4b_sms($m_number, $text,$from,$apikey);
                        } else if($api == "textbelt") {
                            $status = textbelt_sms($m_number, $text, $apikey);
                        } else if($api=="GlobalSms") {
                            $status = global_sms_send($m_number,$text,$api_key,$api_secret);
                        } else if($api=="MessageBird") {
                            $status = message_bird($m_number,$text,$api_key,$org);
                        } else if($api == "bulkgate") {
                            $status = bulkgate_sms($m_number, $text, $app_id, $app_token);
                        } else if($api == "cm") {
                            $status = cm_sms($prod_token, $text, $m_number);
                        }
                        echo "<tr>";
                        echo  "<td>".$m_number."</td>";
                        echo  "<td> ".$status -> status." </td>"; 
                        echo  "<td> $api_name </td>"; 
                        if($api == "Sinch") {
                            echo  "<td> ".$status -> id." </td>"; 
                        } else if($api == "message_media"){
                            echo  "<td> ".$status." </td>"; 
                        }
                        echo  "<td> ".$status -> reason." </td>"; 
                        echo "</tr>";
                    }                   
                }
            } else if($req_type=="MOB") {
                echo "<tr>";
                echo  "<td>".$to_mob."</td>";
                if($api=="Telnyx") {
                    $status= telnyx_send($to_mob, $text,$from,$apikey);
                } else if($api=="Sinch") {
                    $status= sinch_sms($to_mob, $text,$from,$apikey,$spid);
                } else if($api=="twilio") {                    
                    $status= twilio_sms($to_mob, $text,$from,$sid,$token);
                    //print_r($status);
                    echo 'St: '.$status;
                }else if($api=="nexmo") {                    
                    $status = nexmo_sms( $from, $to_mob, $text, $provider_key, $provider_secret);  
                }else if($api=="clicksend") {
                    $status = clicksend_sms($from, $to_mob, $text, $clicksend_username, $clicksend_apikey);  
                }else if($api=="smsto") {
                    $status = smsto_sms($to_mob, $text, $clicksend_apikey);  
                }else if($api=="proovl") {
                    $status = proovl_sms($from, $to_mob, $text,  $proovl_userid, $proovl_token);  
                }else if($api=="txtsync") { 
                    $status = txtsync_sms($to_mob, $text, $txtsync_client_key, $txtsync_client_secret);  
                } else if($api=="message_media") {
                    $status= message_media_sms($to_mob, $text,$from,$username,$password);
                } else if($api=="tm4b") {
                    $status= tm4b_sms($to_mob, $text,$from,$apikey);
                } else if ($api == "textbelt") {
                    $status = textbelt_sms($to_mob, $text, $apikey);
                    //print_r($status);
                } else if($api=="GlobalSms") {
                    $status = global_sms_send($to_mob,$text,$api_key,$api_secret);
                } else if($api=="MessageBird") {
                    $status = message_bird($to_mob,$text,$api_key,$org);
                } else if($api == "bulkgate") {
                    $status = bulkgate_sms($to_mob, $text, $app_id, $app_token);
                } else if($api == "cm") {
                    $status = cm_sms($prod_token, $text, $to_mob);
                }
                
                echo  "<td> ".$status->status." </td>";
                echo  "<td> $api_name </td>"; 
                if($api == "Sinch") {
                    echo  "<td> ".$status->id." </td>"; 
                } else if($api == "message_media"){
                    echo  "<td> ".$status." </td>"; 
                }
                echo  "<td> ".$status->reason." </td>"; 
                echo "</tr>";
            }
            ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
             <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <?php include 'include/footer.php'; ?>
  <!-- End custom js for this page-->
</body>
</html>