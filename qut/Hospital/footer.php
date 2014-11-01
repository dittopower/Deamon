			</div>
			</div>
		</div>
	</div><!-- closes a div from the header -->
	
	<div id="health_footer_wrapper">
		<div id="health_footer">
			<div class="col_3">
				<h4>Pages</h4>
				<ul class="nobullet bottom_list">
					<li><a href="./">Home</a></li>
					<li><a href="./newPatient.php">New Patient</a></li>
					<li><a href="./xraySubmit.php">XRay Submit</a></li>
					<li><a href="./createUser.php">Create User</a></li>
					<li><a href="./filePermissions.php">File Permissions</a></li>
				</ul>
			</div>
			
			<div class="col_3">
				<center>
					<h4>Account</h4>
					<?php if(isset($_SESSION['User'])) echo "Logged in as: <strong>" . $_SESSION['User'] . "</strong> | <a href='logout.php'>Logout</a>"; else echo '<a href="userAuth.php">Log in/signup</a>'; ?>
				</center>
			</div>
			<div class="col_3 rightA">
				<h4>Team</h4>
				<ul class="nobullet bottom_list">
					<li>Josh</li>
					<li>Damon</li>
					<li>Harrison</li>
					<li>Jordan</li>
					<li>Lathaam</li>
				</ul>
			</div>
			<div class="clear"></div>
			<div id="health_copyright">
				Copyright © 2014 Hospital X 
			</div>
		</div> <!-- END of health_footer -->
	</div> <!-- END of health_footer_wrapper -->
	
</body>

</html>