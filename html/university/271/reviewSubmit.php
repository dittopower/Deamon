<?php include 'head.php' ?>



<!--_______________________________ Start Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Header  - - - - - - - - - - - - - -->



<?php include 'header.php' ?>







<!-- - - - - - - - - - - - - - Navigation Bar  - - - - - - - - - - - - - -->

<?php include 'navbar.php' ?>







<!-- - - - - - - - - - - - - - Page Content  - - - - - - - - - - - - - -->

<div id="page">

	

	<div id='inner'>

		

		<?php 

			if(isset($_SESSION['User'])){

				if(isset($_POST['parkID']) && isset($_POST['comment']) && $_POST['comment'] != "" && isset($_POST['rater'])){

					$id = $_POST['parkID'];

					$comment = $_POST['comment'];

					$user = $_SESSION['User'];

					$rating = $_POST['rater'];

					

					$newreviewid = singleSQL("SELECT reviewId FROM reviews ORDER BY reviewId DESC LIMIT 1",$mysqli) + 1;

					$sql2 = "INSERT INTO reviews (reviewId, user, parkID, text, rating) VALUES(".$newreviewid.", '".$user."', ".$id.", '".$comment."', ".$rating.")";

					if(runSQL($sql2,$mysqli)){

						echo 'Comment submitted successfully. <a href="./parks.php?playground=' . $id . '">Back.</a>';

					} else{ echo 'You can only post one review. <a href="./parks.php?playground=' . $id . '">Back.</a>'; }

					

				} else if(isset($_POST['parkID']) ){

				

					

				

				} else { echo 'You need to enter a comment.'; }

			} else{

				echo 'You shouldn\'t be on this page.';

			}

		

		?>

		

	</div>



</div>





<!--_______________________________ End Body _______________________________-->

<!-- - - - - - - - - - - - - - Page Footer  - - - - - - - - - - - - - -->

<?php include 'footer.php' ?>









</html>



