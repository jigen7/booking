<?php
include 'conn/config.php';
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Reservation Process 2</title>
<link href="css/main.css" rel="stylesheet" type="text/css" />
<link href="src/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="lib/jquery.js" type="text/javascript"></script>
<script type="text/javascript" src="js/jquery.watermarkinput.js"></script>
<script src="src/facebox.js" type="text/javascript"></script>
<style type="text/css">
	/* This CSS is used for the Show/Hide functionality. */
	.more {
		display: none;
		border-top: 1px solid #666;
		border-bottom: 1px solid #666; }
	a.showLink, a.hideLink {
		text-decoration: none;
		color: #36f;
		padding-left: 8px;
		background: transparent url(down.gif) no-repeat left; }
	a.hideLink {
		background: transparent url(up.gif) no-repeat left; }
	a.showLink:hover, a.hideLink:hover {
		border-bottom: 1px dotted #36f; }
.style5 {color: #FF9900}
a:link {
	color: #0000FF;
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
	color: #FFFF00;
}
a:active {
	text-decoration: none;
}
 #errmsg { color:red; }
 #errmsg1 { color:red; }
</style>
<script type="text/javascript">
    jQuery(document).ready(function($) {
      jQuery('a[rel*=facebox]').facebox({
        loadingImage : 'src/loading.gif',
        closeImage   : 'src/closelabel.png'
      });
    });
  </script>
  <!--sa validate from-->

<script type="text/javascript">
function validateForm(){

var y=document.forms["personal"]["name"].value;
var a=document.forms["personal"]["last"].value;
var b=document.forms["personal"]["address"].value;
var c=document.forms["personal"]["city"].value;
var f=document.forms["personal"]["email"].value;
var g=document.forms["personal"]["cemail"].value;
var x=document.forms["personal"]["cnumber"].value;
var captcha=document.forms["personal"]["6_letters_code"].value;
var atpos=f.indexOf("@");
var dotpos=f.lastIndexOf(".");

if (atpos<1 || dotpos<atpos+2 || dotpos+2>=f.length)
  {
  alert("Not a valid e-mail address");
  return false;
  }
if( f != g ) {
alert("email does not match");
  return false;
} 
if ((a=="Lastname" || a=="") || (b=="Address" || b=="") || (c=="City" || c=="") || (f=="Email" || f=="") || (g=="Confirm Email" || g=="")|| (x=="Contact Number" || x=="") || (y=="Firstname" || y==""))
  {
  alert("all field are required!");
  return false;
  }

if(captcha == ""){
	alert("Captcha Field Missing");
	return false;
}
 
if (document.personal.condition.checked == false){
alert ('pls. agree the term and condition of this hotel');
return false;
}
else { return true; }
}

function validateForm1(){
	var r=document.forms["log"]["email"].value;
	var g=document.forms["log"]["password"].value;
	var atpos=r.indexOf("@");
	var dotpos=r.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=r.length)  {
	  alert("Not a valid e-mail address");
	  return false;
	  }  

	if ((a==null || a==""))  {
	  alert("pls.enter your password");
	  return false;
	  }
} //end fo validateform1

function showHide(shID) {
	if (document.getElementById(shID)) {
		if (document.getElementById(shID+'-show').style.display != 'none') {
			document.getElementById(shID+'-show').style.display = 'none';
			document.getElementById(shID).style.display = 'block';
		}
		else {
			document.getElementById(shID+'-show').style.display = 'inline';
			document.getElementById(shID).style.display = 'none';
		}
	}
}//end of showHide
</script>

<!--sa watermark-->

<script type="text/javascript">
jQuery(function($){
   $("#name").Watermark("Firstname");
   $("#last").Watermark("Lastname");
   $("#address").Watermark("Address");
   $("#city").Watermark("City");
   $("#email").Watermark("Email");
   $("#cemail").Watermark("Confirm Email");
   $("#cnumber").Watermark("Contact Number");
   $("#em").Watermark("Email Address");
   $("#depositDate").Watermark("Date of Deposit");
   $("#depositAmount").Watermark("Amount of Deposit");
   $("#depositBranch").Watermark("BDO Branch");
   });
</script>

<script type="text/javascript">
$(document).ready(function(){
    
    //called when key is pressed in textbox
	$("#zip").keypress(function (e)  
	{ 
	  //if the letter is not digit then display error and don't type anything
	  if( e.which!=8 && e.which!=0 && (e.which<48 || e.which>57))
	  {
		//display error message
		$("#errmsg").html("Number Only").show().fadeOut("slow"); 
	    return false;
      }	
	});
	$("#cnumber").keypress(function (a)  
	{ 
	  //if the letter is not digit then display error and don't type anything
	  if( a.which!=8 && a.which!=0 && (a.which<48 || a.which>57))
	  {
		//display error message
		$("#errmsg1").html("Number Only").show().fadeOut("slow"); 
	    return false;
      }	
	});

  });
  </script>

</head>

<body>
<div style="display:none;">
<?php
	$arival = $_POST['start'];
	$departure = $_POST['end'];
	$adults = $_POST['adult'];
	$child = $_POST['child'];	
	$no_rooms = $_POST['no_rooms'];
	$roomid = $_POST['roomid'];
	$result = $_POST['result'];
	$eta = $_POST['time'];
	
	$_SESSION['arrival'] = ($arival != '') ? $arival: $_SESSION['arrival'];
	$_SESSION['departure'] = ($departure != '') ? $departure: $_SESSION['departure'];
	$_SESSION['adults'] = ($adults != '') ? $adults: $_SESSION['adults'];
	$_SESSION['child'] = ($child != '') ? $child: $_SESSION['child'];
	$_SESSION['no_rooms'] = ($no_rooms != '') ? $no_rooms: $_SESSION['no_rooms'];
	$_SESSION['roomid'] = ($roomid != '') ? $roomid: $_SESSION['roomid'];
	$_SESSION['result'] = ($result != '') ? $result: $_SESSION['result'];
	$_SESSION['eta'] = ($eta != '') ? $eta: $_SESSION['eta'];

	
		
	$name  = $_GET['firstname'];
	$last = $_GET['lastname'];
	$address = $_GET['address'];
	$city = $_GET['city'];
	$email = $_GET['email'];
	$cemail = $_GET['email'];
	$cnumber = $_GET['contactNum'];
	$depositAmount = $_GET['depositAmount'];
	$depositDAte = $_GET['depositDate'];
	$depositBranch = $_GET['depositBranch'];
	
?>
</div>
<div class="mainwrapper">
  <div class="leftother">
    <div class="l"></div>
	<div class="r">
	
	
	
	
	<div class="right3">
  <div style="float: left; margin-left: 25px; margin-top: 12px; font-family:Arial, Helvetica, sans-serif;">
  
 
  <br />
 
            <a href="#" id="example-show" class="showLink" onclick="showHide('example');return false;">login</a>
            </p>
            <div id="example" style="border-top-width: 0px; border-bottom-width: 0px;" class="more">
              <div class="f" style="margin-left: 5px;">
			  <form action="payment1.php" method="post" style="height: 89px; margin-top: -31px;" onsubmit="return validateForm1()" name="log">
			  <input name="start" type="hidden" value="<?php echo $arival; ?>" />
			  <input name="end" type="hidden" value="<?php echo $departure; ?>" />
			  <input name="adult" type="hidden" value="<?php echo $adults; ?>" />
			  <input name="child" type="hidden" value="<?php echo $child; ?>" />
			  <input name="n_room" type="hidden" value="<?php echo $no_rooms; ?>" />
			  <input name="rm_id" type="hidden" value="<?php echo $roomid; ?>" />
			  <input name="result" type="hidden" value="<?php echo $result; ?>" />
              <input name="email" type="text" class="ed" id="em" /><br />
			   <input name="login" type="submit" value="login" />
				  </form>
              </div>
              <p style="margin-bottom: 0px; margin-top: 0px;"><a href="#" id="example-hide" class="hideLink" onclick="showHide('example');return false;">Cancel</a></p>
            </div>
      <br />
  
  </div>
   <div style="float: right; margin-right: 0px; margin-top: 12px; color:#000000; font-family:Arial, Helvetica, sans-serif; width:489px;">
 
 <form action="payment.php" method="post" style="margin-top: -31px;" onsubmit="return validateForm()" name="personal">
  <input name="start" type="hidden" value="<?php echo $arival; ?>" />
  <input name="end" type="hidden" value="<?php echo $departure; ?>" />
  <input name="adult" type="hidden" value="<?php echo $adults; ?>" />
  <input name="child" type="hidden" value="<?php echo $child; ?>" />
  <input name="n_room" type="hidden" value="<?php echo $no_rooms; ?>" />
  <input name="rm_id" type="hidden" value="<?php echo $roomid; ?>" />
  <input name="result" type="hidden" value="<?php echo $result; ?>" />
<?php
	if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
		foreach($_SESSION['ERRMSG_ARR'] as $msg) {
			echo '<br><br><b>'.$msg.'</b>'; 
		}
		unset($_SESSION['ERRMSG_ARR']);
	}
?>
  <br>
<Label> <b>Personal Information</b></Label><br>
 <input name="name" type="text" class="ed" id="name" value="<?php echo $name;?>"/> 
 <input name="last" type="text" class="ed" id="last" value="<?php echo $last;?>"/> <br />
 <input name="address" type="text" class="ed" id="address" value="<?php echo $address;?>"/> 
 <input name="city" type="text" class="ed" id="city" value="<?php echo $city;?>"/> <br />
 <input name="email" type="text" class="ed" id="email" value="<?php echo $email;?>" /> 
 <input name="cemail" type="text" class="ed" id="cemail" value="<?php echo $cemail;?>"/> <br />
 <input name="cnumber" type="text" class="ed" id="cnumber" value="<?php echo $cnumber;?>"/><br>
 <Label> <b>Initial Deposit Details</b></Label><br>
 <input name="depositDate" type="text" class="ed" id="depositDate"  value="<?php echo $depositDate;?>"/> <br>
 <input name="depositAmount" type="text" class="ed" id="depositAmount" value="<?php echo $depositAmount;?>"/> <br />
 <input name="depositBranch" type="text" class="ed" id="depositBranch" value="<?php echo $depositBranch;?>"/><br>
 <span id="errmsg1"></span>  <br />
  <label>
 <input type="checkbox" name="condition" value="checkbox" />
  <small>I Agree to the <a rel="facebox" href="terms_condition.php">Terms and Condition</a> of this hotel</small></label>
 <br />
  <p style="margin-top: 2px; margin-left: 1px;">
<img src="<?php echo $homeLocation;?>captcha_code_file.php?rand=<?php echo rand(); ?>" id='captchaimg' ><br>
<label for='message'><small>If you are a Human Enter the code above here :</small></label><br>
<input id="6_letters_code" name="6_letters_code" type="text" class="ed"><br>
<small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small>
</p>
 <input name="but" type="submit" value="Confirm" />
  </form>


  </div>
  </div>
	
	
	
	</div>
  </div>
  
  
  <div class="rightother">
  
  <div class="reservation">
	  <div align="center" style="padding-top: 7px; font-size:24px;"><strong>RESERVATION  DETAILS</strong></div>
	<div style="margin-top: 14px;">
	<label style="margin-left: 16px;">Check In Date : <?php echo $_SESSION['arrival']; ?></label><br />
	<label style="margin-left: 3px;">Check Out Date : <?php echo $_SESSION['departure']; ?></label><br />
	<label style="margin-left: 3px;">ETA : <?php echo $_SESSION['eta']; ?></label><br />
	<label style="margin-left: 71px;">Adults : <?php echo $_SESSION['adults']; ?></label><br />
	<label style="margin-left: 78px;">Child : <?php echo $_SESSION['child']; ?></label><br />
	<label style="margin-left: -12px;">Number of Rooms : <?php echo $_SESSION['no_rooms']; ?></label><br />
	<label style="margin-left: 53px;">Room ID : <?php echo $_SESSION['roomid']; ?></label><br />
	<label style="margin-left: -9px;">Number Of Nights : <?php echo $_SESSION['result']; ?></label><br />
	<input name="" type="button" value="Cancel Reservation" id="button"  style="margin-left:55px !important" onclick="window.location = '<?php echo $homeLocation;?>';" />
  </div>
	
	
	</div>
  
  
  </div>
  
  
  
  
  
  
</div>
<div class="footer" style="text-align:center; font-family:Arial, Helvetica, sans-serif; font-size:12px;">copyright � tameraplazainn 2011 - 2012 All Rights reserved</div>
<script language='JavaScript' type='text/javascript'>
function refreshCaptcha()
{
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</body>
</html>