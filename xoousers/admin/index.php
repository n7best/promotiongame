<?php
include("../xoo-ini.php");
require_once("security.php");
$auxMember = new Member();

$total_common = $auxMember->getTotalOfType(1);
$total_facebook = $auxMember->getTotalOfType(2);

$total_yahoo = $auxMember->getTotalOfType(3);
$total_google = $auxMember->getTotalOfType(4);
$total_linkedin = $auxMember->getTotalOfType(5);

$howmany = 10;
$total =  $auxMember->getTotal("","","");
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
	                            
	                                    <li class="active">Dashboard</li>
	                                </ul>
                            	</div>
                        	</div>
               	  </div>
                     <div class="row-fluid">
                  <div class="span6" style="width:48%">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Status:</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                       <div style="width:100%;height:150px">
                                        <p>Common Signups: <?php echo $total_common?> </p>
                                        <p><img src="bootstrap/img/f.png" alt="" >Facebook Signups: <?php echo $total_facebook?> </p>
                                        <p><img src="bootstrap/img/g.png" alt="" >Google Signups: <?php echo $total_google?> </p>
                                        <p><img src="bootstrap/img/y.png" alt="" >Yahoo Signups: <?php echo $total_yahoo?> </p>
                                        <p><img src="bootstrap/img/in.png" alt="" >Linkedin Signups: <?php echo $total_linkedin?> </p>
                                        
                                        </div>
                                    </div>
                                </div>
                                                        </div>
                            <!-- /block -->                            
                            
                            
                            
                  </div>  
                  
                  <div class="span6" style="width:48%">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left"> Chart</div>
                                </div>
                                <div class="block-content collapse in">
                                    <div class="span12">
                                       <div id="piechart2" style="width:100%;height:150px"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                  
                         
                        
                        
           </div>
                    
      <div class="row-fluid">
                        <div class="span6">
                            <!-- block -->
                            <div class="block">
                                <div class="navbar navbar-inner block-header">
                                    <div class="muted pull-left">Latest <?php echo $howmany ?> Users</div>
                                    <div class="pull-right"><span class="badge badge-info">Total <?php echo $total?></span>

                                    </div>
                                </div>
                                <div class="block-content ">
                                
                                 <div style="text-align:right">
                             
                               <a href="user_add.php" ><button type="button" class="btn btn-default btn-sm">
  <span class="glyphicon glyphicon-plus"></span> Add New
</button></a>
                                </div>
                                        
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
                                          </tr>
                                          <tr>
                                              <th> Name</th>
                                              <th>Username</th>
                                             
                                              <th>Type</th>
                                              <th>Registered Date</th>
                                              <th>Confirmation Date</th>
                                              <th>Status</th>
                                              <th>Actions</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        
                    <?php
					
					  //get all 
$drC = $auxMember->getLatest($howmany); 
						
						
						
						$i=1;
						

                        while($rowItem =  $drC->fetch(PDO::FETCH_OBJ))
                        {
                            
                        ?>    
                                          <tr>
                                              <td><?php echo $rowItem->member_name?></td>
                                              <td><?php echo $rowItem->member_user?></td>
                                             
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
       
       <script>
	   $(function() {
	   // var data = [ ["Common", 10], ["Facebook", 8], ["Yahoo", 4], ["Google", 13], ["LinkedIn", 17] ];
		
		 var data = [];
           			
		
		data[0] = {label: "Common",  data: <?php echo $total_common?>};
		data[1] = {label: "Facebook",  data: <?php echo $total_facebook?>};
		data[2] = {label: "Yahoo",  data: <?php echo $total_yahoo?>};
		data[3] = {label: "Google",  data: <?php echo $total_google?>};
		data[4] = {label: "LinkedIn",  data: <?php echo $total_linkedin?>};
			
			

        $.plot('#piechart2', data, {
                series: {
                    pie: {
                        show: true,
                        radius: 1,
                        tilt: 0.5,
                        label: {
                            show: true,
                            radius: 1,
                            formatter: labelFormatter,
                            background: {
                                opacity: 0.8
                            }
                        },
                        combine: {
                            color: '#999',
                            threshold: 0.1
                        }
                    }
                },
                legend: {
                    show: false
                }
            });
			
			
			});
			
			 function labelFormatter(label, series) {
            return "<div style='font-size:8pt; text-align:center; padding:2px; color:white;'>" + label + "<br/>" + Math.round(series.percent) + "%</div>";
        }
         </script>   
    </body>

</html>