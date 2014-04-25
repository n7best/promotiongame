<?php
require("EmailTemplatePersistent.php");

class EmailTemplate extends Common 
{
	
	var $mPer;	
	var $ip_address;
	
	
	public function __construct() 
	{
		$this->mPer = new EmailTemplatePersistent();				 
	}
	
	
	function parse_confirmation_message($template, $DATA, $d_link) 
	{
		$template = str_replace("{{user_name}}", $DATA["member_name"],  $template);
		$template = str_replace("{{confirmation_link}}", $d_link,  $template);
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }
	
	function parse_reset_password_message($template, $DATA, $new_password) 
	{
		$template = str_replace("{{user_name}}", $DATA->member_name,  $template);
		$template = str_replace("{{user_nick}}", $DATA->member_user,  $template);
		$template = str_replace("{{user_password}}", $new_password,  $template);
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }
	
	function parse_reset_password_link($template, $DATA, $reset_link) 
	{
		$template = str_replace("{{user_name}}", $DATA->member_name,  $template);
		
		$template = str_replace("{{reset_link}}", $reset_link,  $template);
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }	
	
	function parse_confirmation_message_sucess($template, $rowMember, $d_link) 
	{
		$template = str_replace("{{user_name}}", $rowMember->member_name,  $template);
		$template = str_replace("{{user_nick}}", $rowMember->member_user,  $template);
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }
	
	function parse_confirmation_message_sucess_social($template, $rowMember, $d_link) 
	{
		$template = str_replace("{{user_name}}", $rowMember->member_name,  $template);
		$template = str_replace("{{user_nick}}", $rowMember->member_user,  $template);
		$template = str_replace("{{user_password}}", $rowMember->member_pass,  $template);
		
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }	
		
	function parse_confirmation_message_numeric($template, $rowMember, $d_link, $random) 
	{
		$template = str_replace("{{user_name}}", $rowMember->member_name,  $template);
		$template = str_replace("{{confirmation_link}}", $d_link,  $template);
		$template = str_replace("{{confirmation_number}}", $random,  $template);
		
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }
	
	function parse_confirmation_message_manual($template, $rowMember) 
	{
		$template = str_replace("{{user_name}}", $rowMember->member_name,  $template);
				
		$template = str_replace("{{company_name}}", WEBSITE_NAME,  $template);
		$template = str_replace("{{company_email}}", WEBSITE_EMAIL,  $template);
		
		return $template;
    }	

	function getOne($c) 
	{
		$res = true;
		$dr = $this->mPer->getOne($c);		
		$row = $this->fetchResults($dr);	
        return $row;
    }
	
	function update_template($c, $n, $body)  
	{				
		$this->mPer->update_template($c, $n, $body) ;
		
    }
	
}
?>