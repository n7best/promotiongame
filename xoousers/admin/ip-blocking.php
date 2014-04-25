<?php
include("../xoo-ini.php");
require_once("security.php");
$OK = false;
$auxP= new IpBlock();

if($_GET["delete"] == "yes" && $_GET["c"] != "")
{
	$auxP->deleteRecord($_GET["c"]);

	$mess = "The I.P. address has been Removed from the Blacklist!";			
	$OK = true;	
	

}


if($_POST["ip_address"] != "")
{
	$auxP->add_item($_POST);

	$mess = "The I.P. address has been Removed from the Blacklist!";			
	$OK = true;	
	

}

$drC = $auxP->getAllInternal() ;

?>
<!DOCTYPE html>
<html class="no-js">
    
    <head>
        <title>Admin Home Page</title>
        <?php include("metainfo.php");?>
       
    </head>
    
    <body>
<?php include("top.php");?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php include("nav.php");?>
                
                <!--/span-->
                <div class="span9" id="content">
                   
                    <div class="row-fluid">
                        
                        	<div class="navbar">
                            	<div class="navbar-inner">
	                                <ul class="breadcrumb">
	                                    <i class="icon-chevron-left hide-sidebar"><a href='#' title="Hide Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <i class="icon-chevron-right show-sidebar" style="display:none;"><a href='#' title="Show Sidebar" rel='tooltip'>&nbsp;</a></i>
	                                    <li>
	                                        <a href="index.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
	                                    
	                                    <li class="active">IP Blocking</li>
	                                </ul>
                            	</div>
                        	</div>
               	  </div>
      <div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">IP Blocking</div>
                                    <div class="pull-right"><span class="badge badge-info"><?php echo $total_items?></span>

                                    </div>
                                </div>
                                
                                
    
                              <div class="block-content ">
                              
                              
                              <p>Here you can manage the ip blocking of your website.</p>
                              
                              <div style="text-align:left">
                              <form name="form1"  method="post" > 
                 
                
                   <input type="text" name="ip_address" id="ip_address" />         
                 
              
                     <input type="submit" name="button" id="button" value="Add New IP" />
               
                 
                 </form>
                                </div>
                                       
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                            <th width="48%">&nbsp;</th>
                                            <th width="12%">&nbsp;</th>
                                          </tr>
                                          <tr>
                                              <th> IP</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        
                    <?php
						
						
						
						$i=1;

                        while($rowItem =  $drC->fetch(PDO::FETCH_OBJ))
                        {
                            
                        ?>    
                                          <tr>
                                              <td><?php echo $rowItem->ip_address?></td>
                                              <td><a href="?p=ipblock&delete=yes&c=<?php echo $rowItem->ip_address?>" title="Delete"><i class="icon-remove"></i></a></td>
                                          </tr>
                                            
                                            
                                           <?php $i++;
						 }?> 
                                           
                                      </tbody>
                                  </table>
                                  
                                
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <div class="span6">
                            <!-- block --><!-- /block -->
              </div>
                    </div>
                   
                    
                </div>
            </div>
            <hr>
            <?php include("footer.php");?>
        </div>
        <!--/.fluid-container-->
       
       
    </body>

</html>