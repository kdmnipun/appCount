<!DOCTYPE html>
<html>
<head>
    <title>
     <?php
       if (!empty($title)){ 
              echo $title; 
          }else{ 
              echo 'Web app for phone list'; 
          }
      ?>
    </title>
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo BASE_URL;?>/webroot/css/bootstrap.min.css?<?php echo date('l jS \of F Y h:i:s A'); ?>" rel="stylesheet">

    <style type="text/css">
		.text-center {
		    font-size: 19px;
		    margin-top: 45px;
		}
    </style>
</head>
<body>
<div class="container">
  <h2 style="text-align: center">Selected members</h2>	
  <h3 class="text-center">QA, Male</h3>
  <p></p>            
  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qa' && $value['gender']=='male'){
	$i++;	
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>

  <h3 class="text-center">QA, Female</h3>

  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qa' && $value['gender']=='female'){
	$i++;
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>

  <h3 class="text-center">QG, Male</h3>

  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qg' && $value['gender']=='male'){
	$i++;
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>

  <h3 class="text-center">QG, Female</h3>

  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qg' && $value['gender']=='female'){
	$i++;	
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>

  <h3 class="text-center">QPM, Male</h3>

  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qpm' && $value['gender']=='male'){
	$i++;	
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>

  <h3 class="text-center">QPM, Female</h3>

  <table class="table table-bordered">
    <thead>
		<tr>
		    <th style="width: 5%;">Sl</th>
		    <th style="width: 25%;">Name</th>
		    <th style="width: 15%;">Reg</th>
		    <th style="width: 25%;">Phone</th>
		</tr>
    </thead>
    <tbody>
	<?php
	$i=0;
	foreach ($seletedMembers as $key => $value) {
	if($value['member'] == 'qpm' && $value['gender']=='female'){
	$i++;	
	?>   
      <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $value['name'];?></td>
        <td><?php if ($value['member']== 'qa') {
            echo"QA";
        }elseif($value['member']== 'qg'){
            echo"QG";
        }else{
            echo"QPM";
        }
       ?></br>
       <?php if(!empty($value['reg']) || !empty($value['batch'])){?>
       <?php echo $value['reg'];?>/<?php echo $value['batch'];?>
       <?php }?>
       </td>
       <td><?php echo$value['phone'];?></td>
      </tr>

	<?php }?>
	<?php }?>
    </tbody>
  </table>
</div>
</body>
</html> 