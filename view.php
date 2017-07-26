<?php
session_start();
include "config.php";
if(!(isset($_SESSION['regid']))){
	header('Location: http://'.$baseurl.'/grant_form/');
}
$user_id = $_GET['uid'];
include 'database.php';
?>

<!doctype html>
<html lang="en">
	<head>
	<title>Patient Application Form</title>
    <?php include 'header.php';?>
	</head>
  	<body>
	  	<div class="wrap">
	  	  <div class="container admin_controller pad20">
	  	   <div class="col-md-2 col-sm-2 col-xs-2">
	           <div class="logo">
	             <img src="images/logo.png" alt="logo">
	           </div>
           </div>
	  	    <div class="col-xs-10 col-sm-10 col-md-10">
	  	      <p class="main_headind"><?php echo $_SESSION['uname']; ?></p>
	  	    </div>
	  	  </div>
	  	</div>
	    <div class="wrap">
	     	<div class="container">
		        <div class="col-xs-12 col-sm-12 col-md-12">
		        	<table id="example" class="display table table-stripe table-bordered" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th colspan="2">User Details</th>
							</tr>
						</thead>
						<tbody>
					  	<?php
					  	//personal info
						$sql = "SELECT * FROM users WHERE id =".$user_id;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr><td style='color:green;' colspan='2'>Personal Info</td></tr>";
						    	echo "<tr><td>Name</td><td>".$row['name']."</td></tr>";
						    	echo "<tr><td>Date Of Birth</td><td>".$row['dob']."</td></tr>";
						    	echo "<tr><td>Age</td><td>".$row['age']."</td></tr>";
						    	echo "<tr><td>Sex</td><td>".$row['sex']."</td></tr>";
						    	echo "<tr><td>Email Address</td><td>".$row['email']."</td></tr>";
						    	echo "<tr><td>Mobile Phone</td><td>".$row['mobphone']."</td></tr>";
						    	echo "<tr><td>Street</td><td>".$row['street']."</td></tr>";
						    	echo "<tr><td>Suburb</td><td>".$row['suburb']."</td></tr>";
						    	echo "<tr><td>Post Code</td><td>".$row['pincode']."</td></tr>";
						    	echo "<tr><td>occupation</td><td>".$row['occupation']."</td></tr>";
						    	echo "<tr><td>Medicare Number</td><td>".$row['medicareno']."</td></tr>";
						    	echo "<tr><td>Number On Card</td><td>".$row['cardno']."</td></tr>";
						    	echo "<tr><td>Emergency Contact Name</td><td>".$row['emergencyname']."</td></tr>";
						    	echo "<tr><td>Relationship</td><td>".$row['relationship']."</td></tr>";
						    	echo "<tr><td>Contact Number</td><td>".$row['contactno']."</td></tr>";
						    	echo "<tr><td>Reference</td><td>".$row['refrence']."</td></tr>";
						    	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						    }
						}
						//how can we help you
						$sql = "SELECT * FROM how_help_data WHERE user_id =".$user_id;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr><td style='color:green;' colspan='2'>How Can We Help</td></tr>";
						    	if($row['brings_field_1'] != "" && $row['brings_field_1'] != "0"){
						    		echo "<tr><td>What Is The Problem</td><td>".$row['brings_field_1']."</td></tr>";
						    	}
						    	if($row['brings_field_2'] != "" && $row['brings_field_2'] != "0"){
						    		echo "<tr><td>What Is The Problem</td><td>".$row['brings_field_2']."</td></tr>";
						    	}
						    	if($row['cause_field_1'] != "" && $row['cause_field_1'] != "0"){
						    		echo "<tr><td>What Causes The Problem</td><td>".$row['cause_field_1']."</td></tr>";
						    	}
						    	if($row['cause_field_2'] != "" && $row['cause_field_2'] != "0"){
						    		echo "<tr><td>What Causes The Problem</td><td>".$row['cause_field_2']."</td></tr>";
						    	}
						    	if($row['experience_field_1'] != "" && $row['experience_field_1'] != "0"){
						    		echo "<tr><td>How Long Experiencing This Problem</td><td>".$row['experience_field_1']."</td></tr>";
						    	}
						    	if($row['experience_field_2'] != "" && $row['experience_field_2'] != "0"){
						    		echo "<tr><td>How Long Experiencing This Problem</td><td>".$row['experience_field_2']."</td></tr>";
						    	}
						    	echo "<tr><td>How Intense Are Symptoms(Problem 1)</td><td>".$row['intense_field_1']."</td></tr>";
						    	echo "<tr><td>How Intense Are Symptoms(Problem 2)</td><td>".$row['intense_field_2']."</td></tr>";
						    	
						    	$feel_like = array();
						    	$feel_like = unserialize($row['feel_like']);
						    	if(($key = array_search("other", $feel_like)) !== false) {
						    	    unset($feel_like[$key]);
						    	}						    	
						    	$feel_string = implode(', ', $feel_like);
						    	echo "<tr><td>What Does It Feel Like</td><td>".$feel_string."</td></tr>";
						    	echo "<tr><td>Condition Getting Worse</td><td>".$row['condition_worse']."</td></tr>";
						    	if($row['condition_worse'] == "yes"){
						    		echo "<tr><td>How Condition Getting Worse</td><td>".$row['symptoms_worsen']."</td></tr>";
						    	}
						    	echo "<tr><td>Activities That Aggravate symptoms</td><td>".$row['symptoms_aggravate']."</td></tr>";
						    	echo "<tr><td>What Makes It Feel Better</td><td>".$row['feel_better']."</td></tr>";
						    	echo "<tr><td>Radiate Or Move Anywhere Else</td><td>".$row['symptoms_radiate']."</td></tr>";
						    	echo "<tr><td>Who Have Seen For This</td><td>".$row['who_seen']."</td></tr>";
						    	echo "<tr><td>What Did They Do</td><td>".$row['what_do']."</td></tr>";
						    	echo "<tr><td>How Responded</td><td>".$row['how_respond']."</td></tr>";
						    	echo "<tr><td>How Commited To Correct The Issue</td><td>".$row['commited_to_correct']."</td></tr>";
						    	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						    }
						}
						//impact of your syptoms
						$sql = "SELECT * FROM impact WHERE user_id =".$user_id;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr><td style='color:green;' colspan='2'>Impact Of The Symptoms</td></tr>";
						    	echo "<tr><th>Activity</th><th>Rating</th></tr>";
						    	echo "<tr><td>".$row['activity1']."</td><td>".$row['rating1']."</td></tr>";
						    	echo "<tr><td>".$row['activity2']."</td><td>".$row['rating2']."</td></tr>";
						    	echo "<tr><td>".$row['activity3']."</td><td>".$row['rating3']."</td></tr>";
						    	echo "<tr><td>How Feeling Right Now(0=Worst, 10=Best)</td><td>".$row['wellness_survey']."</td></tr>";
						    	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						    }
						}
						//illness history
						$sql = "SELECT illness_history.*,other_history.* FROM illness_history INNER JOIN other_history ON illness_history.id = other_history.illness_history_id WHERE illness_history.user_id =".$user_id;
						$result = $conn->query($sql);
						//print_r($sql);
						
						//die(var_dump($result));
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr><td style='color:green;' colspan='2'>Health And Illness History (1=mild, 10=sever, P=past)</td></tr>";
						    	echo "<tr><th>Illness</th><th>Rating</th></tr>";
						    	if($row['anxiety'] != "" && $row['anxiety'] != "0"){
						    		echo "<tr><td>Anxiety</td><td>".$row['anxiety']."</td></tr>";
						    	}
						    	if($row['Arthritis'] != "" && $row['Arthritis'] != "0"){
						    		echo "<tr><td>Arthritis</td><td>".$row['Arthritis']."</td></tr>";
						    	}
						    	if($row['Asthma'] != "" && $row['Asthma'] != "0"){
						    		echo "<tr><td>Asthma</td><td>".$row['Asthma']."</td></tr>";
						    	}
						    	if($row['Blood_Pressure'] != "" && $row['Blood_Pressure'] != "0"){
						    		echo "<tr><td>Blood pressure</td><td>".$row['Blood_Pressure']."</td></tr>";
						    	}
						    	if($row['Cancer'] != "" && $row['Cancer'] != "0"){
						    		echo "<tr><td>Cancer</td><td>".$row['Cancer']."</td></tr>";
						    	}
						    	if($row['Constipation'] != "" && $row['Constipation'] != "0"){
						    		echo "<tr><td>Constipation</td><td>".$row['Constipation']."</td></tr>";
						    	}
						    	if($row['Depression'] != "" && $row['Depression'] != "0"){
						    		echo "<tr><td>Depression</td><td>".$row['Depression']."</td></tr>";
						    	}
						    	if($row['Diabetes'] != "" && $row['Diabetes'] != "0"){
						    		echo "<tr><td>Diabetes</td><td>".$row['Diabetes']."</td></tr>";
						    	}
						    	if($row['Elbow'] != "" && $row['Elbow'] != "0"){
						    		echo "<tr><td>Elbow</td><td>".$row['Elbow']."</td></tr>";
						    	}
						    	if($row['Foot'] != "" && $row['Foot'] != "0"){
						    		echo "<tr><td>Foot/Ankle</td><td>".$row['Foot']."</td></tr>";
						    	}
						    	if($row['Headache'] != "" && $row['Headache'] != "0"){
						    		echo "<tr><td>Headache</td><td>".$row['Headache']."</td></tr>";
						    	}
						    	if($row['Heart_Disease'] != "" && $row['Heart_Disease'] != "0"){
						    		echo "<tr><td>Heart Disease</td><td>".$row['Heart_Disease']."</td></tr>";
						    	}
						    	if($row['Hip_Issues'] != "" && $row['Hip_Issues'] != "0"){
						    		echo "<tr><td>Hip Issues</td><td>".$row['Hip_Issues']."</td></tr>";
						    	}
						    	if($row['Immune_System'] != "" && $row['Immune_System'] != "0"){
						    		echo "<tr><td>Immune System</td><td>".$row['Immune_System']."</td></tr>";
						    	}
						    	if($row['Low_Back_Pain'] != "" && $row['Low_Back_Pain'] != "0"){
						    		echo "<tr><td>Low Back Pain</td><td>".$row['Low_Back_Pain']."</td></tr>";
						    	}
						    	if($row['Mid_Back_Pain'] != "" && $row['Mid_Back_Pain'] != "0"){
						    		echo "<tr><td>Mid Back Pain</td><td>".$row['Mid_Back_Pain']."</td></tr>";
						    	}
						    	if($row['Neck_Pain'] != "" && $row['Neck_Pain'] != "0"){
						    		echo "<tr><td>Neck Pain</td><td>".$row['Neck_Pain']."</td></tr>";
						    	}
						    	if($row['Reflux'] != "" && $row['Reflux'] != "0"){
						    		echo "<tr><td>Reflux</td><td>".$row['Reflux']."</td></tr>";
						    	}
						    	if($row['Reproductive_Issues'] != "" && $row['Reproductive_Issues'] != "0"){
						    		echo "<tr><td>Reproductive Issues</td><td>".$row['Reproductive_Issues']."</td></tr>";
						    	}
						    	if($row['Ears_Ringing'] != "" && $row['Ears_Ringing'] != "0"){
						    		echo "<tr><td>Ears Ringing</td><td>".$row['Ears_Ringing']."</td></tr>";
						    	}
						    	if($row['Scoliosis'] != "" && $row['Scoliosis'] != "0"){
						    		echo "<tr><td>Scoliosis</td><td>".$row['Scoliosis']."</td></tr>";
						    	}
						    	if($row['Shoulder_Issues'] != "" && $row['Shoulder_Issues'] != "0"){
						    		echo "<tr><td>Shoulder Issues</td><td>".$row['Shoulder_Issues']."</td></tr>";
						    	}
						    	if($row['Sinusitis'] != "" && $row['Sinusitis'] != "0"){
						    		echo "<tr><td>Sinusitis</td><td>".$row['Sinusitis']."</td></tr>";
						    	}
						    	if($row['Thyroid'] != "" && $row['Thyroid'] != "0"){
						    		echo "<tr><td>Thyroid</td><td>".$row['Thyroid']."</td></tr>";
						    	}
						    	if($row['TMJ_Issues'] != "" && $row['TMJ_Issues'] != "0"){
						    		echo "<tr><td>TMJ Issues</td><td>".$row['TMJ_Issues']."</td></tr>";
						    	}
						    	if($row['wrist'] != "" && $row['wrist'] != "0"){
						    		echo "<tr><td>Wrist</td><td>".$row['wrist']."</td></tr>";
						    	}
						    	if($row['hand'] != "" && $row['hand'] != "0"){
						    		echo "<tr><td>Hand</td><td>".$row['hand']."</td></tr>";
						    	}
						    	if($row['Sciatica'] != "" && $row['Sciatica'] != "0"){
						    		echo "<tr><td>Sciatica</td><td>".$row['Sciatica']."</td></tr>";
						    	}
						    	if($row['Knee'] != "" && $row['Knee'] != "0"){
						    		echo "<tr><td>Knee</td><td>".$row['Knee']."</td></tr>";
						    	}
						    	if($row['poor_posture'] != "" && $row['poor_posture'] != "0"){
						    		echo "<tr><td>Poor Posture</td><td>".$row['poor_posture']."</td></tr>";
						    	}
						    	if($row['description'] != "" && $row['description'] != "0"){
						    		echo "<tr><td>Other( ".$row['description']." )</td><td>".$row['rating']."</td></tr>";
						    	}
						    	echo "<tr><td>&nbsp;</td><td>&nbsp;</td></tr>";
						    }
						}
						//Medical History
						$sql = "SELECT * FROM medical_history WHERE user_id =".$user_id;
						$result = $conn->query($sql);
						if ($result->num_rows > 0) {
						    while($row = $result->fetch_assoc()) {
						    	echo "<tr><td style='color:green;' colspan='2'>Medical History</td></tr>";
						    	if($row['motor_accident'] == "yes"){
						    		echo "<tr><td>Motor Accdent</td><td>".$row['explain_1']."</td></tr>";
						    	}else{
						    		echo "<tr><td>Motor Accdent</td><td>No</td></tr>";
						    	}
						    	if($row['hospitalized'] == "yes"){
						    		echo "<tr><td>Hospitalized</td><td>".$row['details']."</td></tr>";
						    	}else{
						    		echo "<tr><td>No</td><td>No</td></tr>";
						    	}
						    	if($row['broken_bones'] == "yes"){
						    		echo "<tr><td>Broken Bones</td><td>".$row['details_1']."</td></tr>";
						    	}else{
						    		echo "<tr><td>Broken Bones</td><td>No</td></tr>";
						    	}
						    	if($row['on_medication'] == "yes"){
						    		echo "<tr><td>On Medication</td><td>".$row['details_2']."</td></tr>";
						    	}else{
						    		echo "<tr><td>On Medication</td><td>No</td></tr>";
						    	}
						    	if($row['supplements'] == "yes"){
						    		echo "<tr><td>Supplements</td><td>".$row['details_3']."</td></tr>";
						    	}else{
						    		echo "<tr><td>Supplements</td><td>No</td></tr>";
						    	}
						    	if($row['chiropractic'] == "yes"){
						    		echo "<tr><td>Chiropractic</td><td>".$row['care_reason']."</td></tr>";
						    	}else{
						    		echo "<tr><td>Chiropractic</td><td>No</td></tr>";
						    	}
						    	echo "<tr><td>Date Of Care</td><td>".$row['date_of_care']."</td></tr>";
						    	echo "<tr><td>Chiropractor</td><td>".$row['chiropractor']."</td></tr>";
						    	echo "<tr><td>Clinic Location</td><td>".$row['clinic_location']."</td></tr>";
						    	if($row['x_rays'] == "yes"){
						    		echo "<tr><td>x rays</td><td>".$row['x_ray_year']."</td></tr>";
						    	}else{
						    		echo "<tr><td>x rays</td><td>No</td></tr>";
						    	}
						    	echo "<tr><td>Date Of Sign</td><td>".$row['date_of_sign']."</td></tr>";
						    }
						}
						?>
						</tbody>
					</table>
					<?php
					//Signature
					$sql = "SELECT * FROM signature WHERE user_id =".$user_id;
					$result = $conn->query($sql);
					if ($result->num_rows > 0) {
					    while($row = $result->fetch_assoc()) {
					    	echo "<input type='hidden' class='signature_value' value='".$row['signature']."'>";
					    }
					}
					?>
		        </div>
		    </div>
	    </div>
	    <div class="wrap">
	    	<div class="container">
	    		<p class="signature">Signature:</p>
	    		<div class="col-xs-12 col-sm-12 col-md-12" style="padding-bottom: 60px;">
	    			<div class="sigPad" id="smoothed" style="width:404px;">
					<div class="sig sigWrapper" style="height:auto;">
					<canvas class="pad" width="400" height="100"></canvas>
					</div>
					</div>
	    		</div>
	    	</div>
	    </div>
      <script src="js/jquery-1.12.4.js"></script>
<!--  <script src="js/jquery.min.js"></script>    -->
      <script src="js/jquery-ui.js"></script>
      <script src="js/jquery.validate.min.js"></script>
      <script src="js/jquery.formtowizard.js"></script>

      <script src="js/script.js"></script>  
      <script src="js/bootstrap-slider.js"></script>

      <script src="js/numeric-1.2.6.min.js"></script>
      <script src="js/bezier.js"></script>
      <script src="js/jquery.signaturepad.js"></script>
      <script src="js/json2.min.js"></script> 
	<script>
		$(function(){
			var sig = $('.signature_value').val();
			console.log(sig);
			$('.sigPad').signaturePad({displayOnly:true}).regenerate(sig);
		});
	</script>
  	<!--<script src="datatable/datatable.js"></script>
	<script>
		$(function(){
			$('#example').DataTable();
		});
	</script>-->
	</body>
</html>