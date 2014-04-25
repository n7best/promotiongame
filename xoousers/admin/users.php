<?php
include("../xoo-ini.php");
require_once("security.php");
$auxMember = new Member();

$uri= $_SERVER['REQUEST_URI'] ;
$url = explode("?ini=",$uri);

$ini = $url["1"];


//delete
if($_POST["act"]=="delete_user")
{
	$auxMember->delete_user($_POST["c"]);
	$status = true;
	$message = '<strong>Success!</strong> The member has been deleted.';

}
$keyword = $_POST["keyword"];
/*Pager*/
$auxPager = new Pager();
$howManyPagesPerSearch =PRODUCTS_PER_PAGE;
$rowsToShow = PRODUCTS_PER_PAGE;

/*get total registries*/
$total_items=$auxMember->getTotal($keyword , $from, $to);

$totalPages = ceil($total_items/PRODUCTS_PER_PAGE);

if($ini>$totalPages)
{
	$ini = $totalPages;	
}

$current_page= $ini;
$pager= $auxPager->getPager($total_items, $current_page, $target_page, $howManyPagesPerSearch);


if($ini == ""){$initRow = 0;}else{$initRow = $ini;}
if($initRow<= 1) {
	$initRow =0;
}else{
	
	if(($howManyPagesPerSearch * $ini)-$howManyPagesPerSearch>= $total_items) 
	{
		$initRow = $totalPages-$howManyPagesPerSearch;
		
	}else{
		
		$initRow = ($howManyPagesPerSearch * $ini)-$howManyPagesPerSearch;
	}
	
	
}
if($ini == ""){$ini=1;}

/*Displaying total*/
$displaying_total=$rowsToShow;

//get all 
$drC = $auxMember->getAll($keyword, $initRow,$rowsToShow); 

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
	                                    
	                                    <li class="active">Users</li>
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
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Users</div>
                                    <div class="pull-right">Page: <strong><?php echo $ini?> </strong> Total: <strong><?php echo $total_items?></strong> Displaying: <strong><?php echo $displaying_total?> per page</strong> 

                                    </div>
                                </div>
                                
                                
    
                              <div class="block-content ">
                              
  <div style="margin-top:10px; ">
										
										<p>Here you can manage your users.</p>
                                       </div>
                                       
                                       
                               <div style="text-align:right">
                             
                                <a href="user_add.php" ><button type="button" class="btn btn-default btn-sm">
  <span class="glyphicon glyphicon-plus"></span> Add New
</button></a>
                                </div>
                               <div class="NrResults"> <?php echo $pager?>  </div>
                                 
                               
                               
                                        <form id="frm1" name="frm1" class="form-search form-horizontal pull-right" method="post">
                                        <input type="hidden" name="act" id="act">
                                        <input type="hidden" name="c" id="c">
    <div class="input-append span12" style="float:left">
        <input name="keyword" type="text" class="search-query" id="keyword" placeholder="Search">
        <button type="submit" class="btn"><i class="glyphicon glyphicon-zoom-in"></i> Search</button>
    </div>
</form>         
                                  <table class="table table-striped">
                                      <thead>
                                          <tr>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                            <th>&nbsp;</th>
                                          </tr>
                                          <tr>
                                              <th>#</th>
                                             
                                              <th>Username</th>
                                              <th>E-mail</th>
                                              <th>Type</th>
                                              <th>Registered Date</th>
                                              <th>Confirmation Date</th>
                                              <th>Status</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        
                    <?php
						
						
						
						$i=1;

                        while($rowItem =  $drC->fetch(PDO::FETCH_OBJ) )
                        {
                            
                        ?>    
                                          <tr>
                                              <td><?php echo $i?></td>
                                             
                                              <td><?php echo $rowItem->member_user?></td>
                                              <td><?php echo $rowItem->member_email?></td>
                                              <td><?php echo $rowItem->role_name?></td>
                                              <td><?php echo date("m/d/Y", strtotime($rowItem->member_creation_date))?></td>
                                              <td><?php echo date("m/d/Y", strtotime($rowItem->member_activation_date))?></td>
                                              <td> <?php
	  
	  if($rowItem->member_status==0)	  
	  {        
		 
		 echo '<span class="label label-warning">Pending </span>';
		 
	   }elseif($rowItem->member_status==1){
		   
		 echo '<span class="label label-success">Active</span>';
	   
	   }elseif($rowItem->member_status==2){
		   
		 echo '<span class="label label-important">Banned</span>';
	   
	   }
	  
	  ?></td> 
                                              <td>
                                              
                                                                                          
                                              
                                              <a href="user_edit.php?c=<?php echo $rowItem->member_id?>" ><button type="button" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-edit"></span> Edit</button></a>
                                              
                                               <a href="javascript:delete_users('<?php echo $rowItem->member_id?>')" ><button type="button" class="btn btn-default btn-sm"> <span class="glyphicon glyphicon-remove"></span> Remove</button></a>
                                              
                                              
                                              </td>
                                          </tr>
                                            
                                            
                                           <?php $i++;
						 }?> 
                                           
                                      </tbody>
                                  </table>
                                  
                                  <div class="NrResults"> <?php echo $pager?>  </div>
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