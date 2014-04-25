<?php
include("../xoo-ini.php");
require_once("security.php");
$auxM = new MemberRole();

//delete
$status = false;
if($_POST["act"]=="delete_roles")
{
	//check users
	$dr = $auxM->getUsersInRole($_POST["c"]);
	
	//get all 
    $drC = $auxM->getAllInternal(); 
	
	$row_countD = $drC->rowCount();
	
	if($row_countD==1)
	{   
		    $error = true;
			$message = '<strong>Error!</strong> There has to be at leats one role in the system.';
	
	}else{
		
		$row_countDD = $dr->rowCount();
		
		if($row_countDD==0)
		{
			$auxM->deleteRecord($_POST["c"]);
			$status = true;
			$message = '<strong>Success!</strong> The role has been deleted.';
		
		}else{
			
			$error = true;
			$message = '<strong>Error!</strong> The role has users associated to it.';
		
		}
	
	}

}

//get all 
$drC = $auxM->getAllInternal(); 

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
	                                    
	                                    <li class="active">Roles</li>
	                                </ul>
                            	</div>
                        	</div>
               	  </div>
      <div class="row-fluid">
                        <div class="span6">
                        
                         <?php if($status){?>
      
      <div class="alert alert-success">
		<button class="close" data-dismiss="alert">&times;</button>
			<?php echo $message?>
		</div>
       <?php }?> 
       
       <?php if($error){?>
       <div class="alert alert-error">
				<button class="close" data-dismiss="alert">&times;</button>
				<?php echo $message?>
									</div>
                                    
                                     <p style="color: #F00"><?php echo $ret_validate?> </p>
           <?php }?>    
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Roles</div>
                                    <div class="pull-right"><span class="badge badge-info"><?php echo $total_items?></span>

                                    </div>
                                </div>
                                
                                
    
                              <div class="block-content ">
                              
                              <div style="text-align:right">
                                                             
                                <a href="role_add.php" ><button type="button" class="btn btn-default btn-sm">
  <span class="glyphicon glyphicon-plus"></span> Add New
</button></a>
                                </div>
                                   
                                        <form id="frm1" name="frm1" class="form-search form-horizontal pull-right" method="post">
                                        <input type="hidden" name="act" id="act">
                                        <input type="hidden" name="c" id="c">
                                        
                                        </form>    
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                            <th width="19%">&nbsp;</th>
                                            <th width="32%">&nbsp;</th>
                                            <th width="22%">&nbsp;</th>
                                            <th width="27%">&nbsp;</th>
                                          </tr>
                                          <tr>
                                              <th>#</th>
                                              <th> Name</th>
                                              <th>Users</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        
                    <?php
						
						
						
						$i=1;

                        while($rowItem = $drC->fetch(PDO::FETCH_OBJ))
                        {
							//get users with this role
							$dr = $auxM->getUsersInRole($rowItem->role_id);
							
							
							$t = $dr->rowCount();
                            
                        ?>    
                                          <tr>
                                              <td><?php echo $rowItem->role_id?></td>
                                              <td><?php echo $rowItem->role_name?></td>
                                              <td><?php echo $t?></td>
                                              <td>
                                              <a href="role_edit.php?c=<?php echo $rowItem->role_id?>" ><button type="button" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-edit"></span> Edit</button></a>
                                              
                                               <a href="javascript:delete_roles('<?php echo $rowItem->role_id?>')" ><button type="button" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-remove"></span> Remove</button></a>
                                              
                                              </td>
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