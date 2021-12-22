<!DOCTYPE html>
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
              
               <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h2>AOS BulkSMS</h2>
                  <p class="card-description">
                    Select SMS Gateway & Enter Numbers with country code to send sms.
                  </p>
                  <form class="forms-sample" method="post" action="send_sms.php" enctype="multipart/form-data">
                        <div class="form-group row">
                          <label class="col-md-4">Select SMS Gateway</label>
                          <div class="col-md-8">
                            <select name="api" class="form-control" id="gateway">
                              <option value="telnyx" selected="">Gateway 1</option>
                              <option value="sinch">SNC</option>
                              <option value="twilio">TWL</option>
                              <option value="message_media">MGM</option>
                              <option value="tm4b">TM4B</option>
                              <option value="textbelt">TXTBLT</option>
                              <option value="globalsms">Global SMS</option>
                              <option value="msgbird">MSG Bird</option>
                              <option value="bulkgate">Gateway 9</option>
                              <option value="cm">CM</option>
                              <option value="nexmo">Nexmo</option>
                              <option value="clicksend">ClickSend</option>
                              <!--option value="clickatell">Clickatell</option-->
                              <option value="smsto">SMS TO</option>  
                              <option value="txtsync">TxtSync</option>
                              <option value="proovl">Proovl</option> 
                            </select>
                            <!-- <div class="form-check">
                              <label class="form-check-label">
                                  <input onclick="telnyx()" type="radio" class="form-check-input" name="api" id="membershipRadios1" value="telnyx" checked> 
                              </label>
                            </div> -->
                          </div>
                          <!-- <div class="col-md-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input onclick="sinch()" type="radio" class="form-check-input" name="api" id="membershipRadios2" value="sinch">
                                Gateway 2
                              </label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="api" id="twilio" value="twilio"> Twilio
                              </label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="api" id="message_media" value="message_media"> Message Media
                              </label>
                            </div>
                          </div>
                          <div class="col-md-2">
                            <div class="form-check">
                              <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="api" id="tm4b" value="tm4b"> TM4B
                              </label>
                            </div>
                          </div> --> 
                        </div>
                      <div class="form-group row gateway_info form-group telnyx_input sinch_input tm4b_input textbelt_input msgbird_input globalsms_input">
                        <label class="col-md-4">API Key</label>
                        <div class="col-md-8">
                          <input type="text" name="apikey" class="form-control" placeholder="API Key">
                        </div>
                      </div>
                      <div class="form-group row gateway_info globalsms_input d-none">
                        <label class="col-md-4">API Secret</label>
                        <div class="col-md-8">
                          <input type="text" name="provider_secret" class="form-control" placeholder="API Secret">
                        </div>
                      </div>
                      <div class="form-group row gateway_info d-none form-group sinch_input">
                        <label class="col-md-4">Service Plan Id</label>
                        <div class="col-md-8">
                          <input type="text" name="spid" class="form-control" placeholder="Service Plan Id">
                        </div>
                      </div>
                       
                      <div class="nexmo_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">Provider Key </label>
                          <div class="col-md-8">
                            <input type="text" name="provider_key" class="form-control" placeholder="Provider Key">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-4">Provider Secret</label>
                          <div class="col-md-8">
                            <input type="text" name="provider_secret" class="form-control" placeholder="Provider Secret">
                          </div>
                        </div>
                      </div>

                      <div class="clicksend_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">User Name </label>
                          <div class="col-md-8">
                            <input type="text" name="clicksend_username" class="form-control" placeholder = "User Name">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-4">API KEY</label>
                          <div class="col-md-8">
                            <input type="text" name="clicksend_apikey" class="form-control" placeholder = "Password">
                          </div>
                        </div>
                      </div>

                      <div class="smsto_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">API KEY </label>
                          <div class="col-md-8">
                            <input type="text" name="smsto_api_key" class="form-control" placeholder = "api-key">
                          </div>
                        </div>  
                      </div>

                      <div class="proovl_input gateway_info d-none">
                          <div class="form-group row">
                            <label class="col-md-4"> User ID </label>
                            <div class="col-md-8">
                              <input type="text" name="proovl_userid" class="form-control" placeholder = "User ID">
                            </div>
                          </div>

                          <div class="form-group row">
                            <label class="col-md-4"> Token </label>
                            <div class="col-md-8">
                              <input type="text" name="proovl_token" class="form-control" placeholder = "Token">
                            </div>
                          </div>
                      </div>

                      
                      <div class="clickatell_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">API KEY </label>
                          <div class="col-md-8">
                            <input type="text" name="clickatell_api_key" class="form-control" placeholder = "api-key">
                          </div>
                        </div>  
                      </div>

                      <div class="txtsync_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">Client Key </label>
                          <div class="col-md-8">
                            <input type="text" name="txtsync_client_key" class="form-control" placeholder = "Client Key">
                          </div>
                        </div>   
                        <div class="form-group row">
                          <label class="col-md-4">Client Secret  </label>
                          <div class="col-md-8">
                            <input type="text" name="txtsync_client_secret" class="form-control" placeholder = "Client Secret">
                          </div>
                        </div> 
                      </div>
                      
                      
                      <div class="message_media_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">Username</label>
                          <div class="col-md-8">
                            <input type="text" name="msg_media_username" class="form-control" id="msg_media_username" placeholder="Username">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-4">Password</label>
                          <div class="col-md-8">
                            <input type="text" name="msg_media_pswd" class="form-control" id="msg_media_pswd" placeholder="Password">
                          </div>
                        </div>
                      </div>
                    
                      <div class="twilio_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">SID</label>
                          <div class="col-md-8">
                            <input type="text" name="twilio_sid" class="form-control" id="twilio_sid" placeholder="SID">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label class="col-md-4">Auth Token</label>
                          <div class="col-md-8">
                            <input type="text" name="twilio_auth_token" class="form-control" id="twilio_auth_token" placeholder="Auth Token">
                          </div>
                        </div>
                      </div>

                      <div class="bulkgate_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">Application ID</label>
                          <div class="col-md-8">
                            <input type="text" name="app_id" class="form-control" placeholder="Application ID">
                          </div>
                        </div> 
                        <div class="form-group row">
                          <label class="col-md-4">Application Token</label>
                          <div class="col-md-8">
                            <input type="text" name="app_token" class="form-control" placeholder="Application Token">
                          </div>
                        </div>
                      </div>

                      <div class="cm_input gateway_info d-none">
                        <div class="form-group row">
                          <label class="col-md-4">Product Token</label>
                          <div class="col-md-8">
                            <input type="text" name="product_token" class="form-control" placeholder="Product Token">
                          </div>
                        </div> 
                      </div>
                      
                      <div class="form-group row gateway_info telnyx_input sinch_input twilio_input msgbird_input nexmo_input clicksend_input proovl_input gateway_info">
                        <label class="col-md-4">From Mobile Number</label>
                        <div class="col-md-8">
                          <input type="text" name="mobile" class="form-control" placeholder="From Mobile Number">
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-4">To Mobile Number</label>
                        <div class="col-md-8">
                          <input type="text" name="to_mobile" class="form-control" placeholder="To Mobile Number">
                        </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-4"></label>
                        <div class="col-md-8"> ------------- OR -------------- </div>
                      </div>
                      <div class="form-group row">
                        <label class="col-md-4">Upload Excel Sheet</label>
                        <div class="col-md-8">
                          <div class="custom-file">
                            <label class="custom-file-label-remove d-none">Remove</label>
                            <input type="file" name="file" class="custom-file-input" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose file</label>
                          </div>
                          <!-- <input type="file" name="file" class="file-upload-default">
                          <div class="input-group">                          
                            <div class="input-group-append">
                              <span class="input-group-text">Upload</span>
                            </div>
                          </div> -->


                          <!-- <input type="file" name="file" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Excel Sheet">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div> -->
                        </div>
                      </div>
                        
                      <div class="form-group row">
                        <label class="col-md-4">Text Message</label>
                        <div class="col-md-8">
                          <textarea name="textmsg" id="textmsg" required class="form-control" placeholder="Text Message" rows="7"></textarea>
                          <ul id="sms-counter">
                            <li>Encoding: <span class="encoding"></span></li>
                            <li>Length: <span class="length"></span></li>
                            <li>Messages: <span class="messages"></span></li>
                            <li>Per Message: <span class="per_message"></span></li>
                            <li>Remaining: <span class="remaining"></span></li>
                          </ul>
                          <!-- <input type="hidden" id="char_count">
                          Messages: <span id="msgs"></span>, 
                          Per Message: <span id="prmsg"></span>, 
                          Remaining: <span id="rmn"></span> -->
                        </div>
                      </div>

                      <div class="form-group row">
                        <label class="col-md-4"></label>
                        <div class="col-md-8">
                          <button name="Submit" type="submit" class="btn btn-primary me-2 btn-block" style="background-color:#27367f">Send SMS</button>
                        </div>
                      </div>

                  </form>
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
<style>
.d-none{
  display: none !important;
}
select.form-control{
  background-color: #FFF !important;
  color: #000 !important;
}
.form-group{
  margin-bottom: 7px !important;
}
form label{
  font-weight: bolder !important;
}
.card{
  border-radius: 1.25rem;
  border: none;
}
.custom-file .custom-file-label-remove{
  position: absolute;
  z-index: 9;
  padding: 8px 12px;
  background: #F00;
  color: #FFF;
  border-radius: 0.25rem 0 0 0.25rem;
}
</style>
<script type="text/javascript" src="js/sms-counter/sms_counter.min.js"></script>
<script>
function sinch()
{
   //document.getElementById("sinch").style.display = "block";
}
function telnyx()
{
   //document.getElementById("sinch").style.display = "none";
}

//$(document).on("click", "input[name=api]", function(){
$(document).on("change", "#gateway", function(){
    //var val = $(this).is(":checked") ? $(this).val() : "";
    var val = $(this, "option:selected").val();
    $(".gateway_info").addClass("d-none");
    $("."+val+"_input").removeClass("d-none");
});

$('#customFile').on('change', function(e) {
  $(this).next("label").text(e.target.files[0].name);
  $(".custom-file-label-remove").removeClass("d-none");
  $(".custom-file .custom-file-label").css("left", "70px");
});

$('.custom-file-label-remove').on('click', function() {
  $(this).addClass("d-none");
  $('#customFile').next("label").text("Choose File");
  $('#customFile').val("");
  $(".custom-file .custom-file-label").css("left", "0");
});

$(function(){
  /*$("#msgs").text(1);
  $("#prmsg").text(160);
  $("#rmn").text(160);
  $("#char_count").val(160);*/
  $('#textmsg').countSms('#sms-counter');
});

/*$("#textmsg").bind('keyup', function() {
  // var char_lngt = $(this).val().length;
  // console.log(char_lngt);
  // var msgCount = parseInt(char_lngt / 160);
  // $("#msgs").text(msgCount+1);
  var charCount = $("#char_count");
  var msgcnt = $("#msgs").text();
  var rmn = $("#rmn").text();
  var char_lngt = $(this).val().length;
  var char_count = (rmn == 0 ? charCount.val(160) : 160 - parseFloat(char_lngt));
  msgcnt = (char_count == 160 ? parseFloat(msgcnt) + 1 : msgcnt); 
  $("#msgs").text(msgcnt);
  $("#rmn").text(char_count);
});*/
</script>  
</body>
</html>