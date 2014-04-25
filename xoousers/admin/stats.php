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
	                            
                                <li>
	                                        <a href="index.php">Dashboard</a> <span class="divider">/</span>	
	                                    </li>
                                        
	                                    <li class="active">Stats</li>
	                                </ul>
                            	</div>
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
                                
                                  <div id="chart_div"></div>    
                                        
                                   
                                </div>
                            </div>
                            <!-- /block -->
                        </div>
                        <div class="span6">
                            <!-- block --><!-- /block -->
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
         
         
         <?php
                         $auxPer = new Persistent();
		
		 
		 $current_date = date("Y-m-d");
		 $ini_date=  date("Y-m-d", strtotime("$current_date - 12 month"));
		 
		 $ini_date_aux =  $ini_date;
		 
		 $from_month = date("m", strtotime($ini_date_aux));
		 $from_month = $auxPer->getMonthName($from_month);
		 $from_year= date("Y", strtotime($ini_date_aux));
		 
						 ?>
                         
                             <script type="text/javascript">

      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Month');
        
        data.addColumn('number', 'Registrations');
        data.addRows([<?php
		 
						$i = 1;						
						while ($i <= 12) {
							
							$current_month = date("m", strtotime($ini_date_aux));
							
							$current_y= date("Y", strtotime($ini_date_aux));					
							$month = $auxPer->getMonthName($current_month);
							
							//get sales
							
							$tot_sales = $auxMember->getTotalPeriod("",$current_month,$current_y);
							
							
		?>
          ['<?php echo $month."/".$current_y?>', <?php echo $tot_sales?>]<?php  if($i <= 12){ echo ","; }?>		  
		  <?php   $i=$i+1; 		 
		  $ini_date_aux=  date("Y-m-d", strtotime("$ini_date_aux + 1 month"));		  
		// echo $ini_date_aux ." - ";	
		 } 		  
		  $current_month = date("m");
		  $current_y = date("Y");
		  $month = $auxPer->getMonthName($current_month);
		  $tot_sales = $auxMember->getTotalPeriod("",$current_month,$current_y);
		  ?>  	  
		 ['<?php echo $month."/".$current_y?>', <?php echo $tot_sales?>]		  
		  
        ]);

        var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
		
        chart.draw(data, {width:'100%', height: 200, title: '<?php echo $from_month."/".$from_year."-" . $month."/".$current_y?>',
                          hAxis: {title: '<?php echo $current_year?>', titleTextStyle: {color: '#000000'},  textStyle: {fontName: 'arial', fontSize: 10} }
                         });
      }
    </script>
    </body>

</html>