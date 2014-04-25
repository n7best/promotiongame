<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo WEBSITE_NAME?> - Shopping Cart</title>


<?php include("metainfo.php")?>

</head>

<body>
<?php include("top_sticky.php")?>
 <div class="wrapper">
<?php include("top.php")?>

<script>
function validate_signup(){
	
	var terms_ =  $('#term_agreement').is(":checked");
	
		
	
	if(terms_==false){alert("Please, you must to accept our Terms & Conditions");return;}	
	
	document.frm1.act.value="sign_up_confirm";
	document.frm1.submit();
	
	

}
</script>

<section>
    
 <h1>Member Sign Up</h1>
    
    <div class="shopping_cart corners shadow">
    

        <form method="post" name="frm1" id="frm1" action="member_signup.php">
     
     <input type="hidden" name="act">
     
  <div class="buy_options"> 
  
    
      <div class="personal_details">
      
      <p>Please use a valid email account. A link to download your products will be sent to the specified email account.</p>
      
      <p style="color: #F00"><?php echo $ret_validate?> </p>
      
        <h3>Your Details:</h3>
     
    
     
     <div class="field">
     <label>Your Name:*</label>   
                <input type="text" name="member_name" id="member_name"   class="cbox"  value="<?php echo $member_name?>"/>   
          </div>
          
          <div class="field">
     <label>Your User Name:*</label>   
                <input type="text" name="member_user" id="member_user"    class="cbox" value="<?php echo $member_user?>"/>   
          </div>
          
          
            <div class="field">
     <label>Your Email:*</label>   
                <input type="text" name="member_email" id="member_email"    class="cbox" value="<?php echo $member_email?>"/>   
          </div>
          
           <div class="field">
     <label>Your Email Again:*</label>   
                <input type="text" name="member_email2" id="member_email2"    class="cbox" value="<?php echo $member_email2?>" />   
          </div>
          
          
           <div class="field">
     <label>Your Password:*</label>   
                <input type="password" name="member_pass" id="member_pass"    class="cbox" value="<?php echo $member_pass?>"/>   
          </div>
          
        
                    
                    
     
      </div>
      
      
      
     
    
     
     <div class="buy_buttons">
         
    
      <p><input type="checkbox" value="" name="term_agreement"  id="term_agreement"> 
      I Agree with the <a href="cms/terms-of-use.html" target="_blank">Terms of Use</a></p>
     
    
     
     
     </div>
   
     
      <div><a class="button_payment" href="javascript:validate_signup()">SUBMIT</a></div>
      
          <p class="conf"><a href="member_login.php">Already Registered?</a></p>
  
     
     
  </div>
    
   
    </form>            
    </div>
    
   
       
</section>
    
<?php include("footer.php")?>

</div>

</body>
</html>