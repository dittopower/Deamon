<?php 



	include 'header.php';

	if(checkFilePermission(__FILE__, $mysqli)){

?>

            

			<!-- CONTENT START -->

			

			<?php

			$message = 'PHP not running correctly...';

			if (isset($_POST['gname']) == false || isset($_POST['sname']) == false || isset($_POST['sex']) == false || isset($_POST['dob']) == false || isset($_POST['phone']) == false || isset($_POST['address']) == false){

				$message = "Please fill in the required fields.";

			} else{

				$existing = singleSQL("SELECT Firstname, Lastname, dob FROM patients WHERE Firstname='" . $_POST['gname'] . "' AND Lastname='" . $_POST['sname'] . "' AND dob='" . $_POST['dob'] . "'",$mysqli);

				if($existing!=0){

					$message = "Patient already exists.";

				} else{

					

					$newID = singleSQL("SELECT PatientNo FROM patients ORDER BY PatientNo DESC LIMIT 1",$mysqli) + 1;

					

					$formattedDOB = date("d-m-Y", strtotime($_POST['dob']));

					

					$patientinfo = runSQL("INSERT INTO patients (PatientNo, Firstname, Lastname, sex, email, dob, phone, address, medicare, insurance) VALUES ($newID,'" . $_POST['gname']."', '".$_POST['sname']."', '".$_POST['sex']."', '".$_POST['email']."', '".$formattedDOB."', '".$_POST['medicare']."', '".$_POST['phone']."', '".$_POST['address']."', '".$_POST['insurance']."');",$mysqli);

					if($patientinfo){ $message = 'Patient added'; }

					else{ $message = 'Something went wrong...'; }

				}

			}

			?>



			<h2>New Patient</h2>

			<?php //searchbox(); ?>

			<h4 class="red"><i><?php echo $message; ?></i></h4>

			<form method="post" name="contact" action="#" id="contact_form">

				

				<div class="col_2">

					<label for="gname">Given Name:</label>

					<input name="gname" type="text" class="required input_field" id="gname" maxlength="30" />

				</div>

				

				<div class="col_2 right">

					<label for="address">Address:</label>

					<input name="address" type="text" class="required input_field" id="address" maxlength="40" />

				</div>

										

				<div class="col_2">

					<label for="sname">Surname:</label>

					<input name="sname" type="text" class="required input_field" id="sname" maxlength="30" />

				</div>

				

				<div class="col_2 right">

					<label for="email">Email:</label>

					<input name="email" type="text" class="validate-email required input_field" id="email" maxlength="30" />

				</div>

				

				<div class="col_2">

					<label for="dob">Date Of Birth (dd/mm/yyyy):</label>

					<input name="dob" type="date" class="required input_field" id="dob" maxlength="30" />

				</div>

				

				<div class="col_2 right">

					<label for="Medicare">Medicare:</label>

					<input name="medicare" type="#" class="required input_field" id="Medicare" maxlength="30" />

				</div>

				

				 <div class="col_2">

					<label for="phone">Phone:</label>

					<input name="phone" class="required input_field" id="phone" maxlength="20" />

				</div>

				

				<div class="col_2 right">

					Gender:<br><br>

					<input type="radio" name="sex" value="M">Male<br>

					<input type="radio" name="sex" value="F">Female

				</div>

				

				<div class="col_2">

					<label for="phone">Private Health Insurance:</label>

					<input name="insurance" type="#" class="required input_field" id="insurance" maxlength="30" />

				</div>

				

				<div class="col_2 right"> </div>

				<div class="col_2 "> </div>

				<div class="col_2 right"> </div>

				

				<div class="col_2">

					<input type="submit" name="Submit" value="Submit" class="submit_btn" />

				</div>

				

				<div class="col_2" right>

					<!--<input type="reset" name="Reset" value="Reset" class="submit_btn" />-->

				</div>

			</form>

				

			<!-- CONTENT END -->





<?php } else { include 'permissionDenied.html'; } ?>

<?php include 'footer.php'; ?>



