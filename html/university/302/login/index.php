<?php
	/*session_start();
	
	if(isset($_SESSION["SupervisorID"]) && $_SESSION['SupervisorLoggingIn'] == "true"){
		unset($_SESSION['SupervisorLoggingIn']);
		
		die();
	}*/
?>
<html class="no-js gr__esoe_qut_edu_au" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <title>Home - QUT Login</title>

    <script src="https://esoe.qut.edu.au/static/lib/jquery/jquery-2.1.1.min-0c2b6a372f7128c8eb6c46c2fe7b5dd2.js" type="text/javascript"></script>

    <script src="https://esoe.qut.edu.au/static/qut-template-mobile-70e19e40a83197ac0f0f02e9075f5f86.js" type="text/javascript"></script>

    <link rel="stylesheet" media="all" href="https://esoe.qut.edu.au/static/lib/bootstrap/bootstrap.min-fa020ae16a52aacca6edb045e0578dfa.css">
    <link rel="stylesheet" media="all" href="https://esoe.qut.edu.au/static/lib/bootstrap/bootstrapValidator.min-674dc537be7297fe78564de4cdc213a1.css">
    <link rel="stylesheet" media="all" href="https://esoe.qut.edu.au/static/lib/font-awesome/font-awesome.min-6a5237a2f15f98e4cce5dbda900822f2.css">
    <link rel="stylesheet" media="all" href="https://esoe.qut.edu.au/static/global-867dab1bd9297324c13379ed58c417d7.css">
    <link rel="stylesheet" media="all" href="https://esoe.qut.edu.au/static/custom-4c2d82bab20b53151540c0ecad09ce9a.css">
    <link rel="stylesheet" media="print" href="https://esoe.qut.edu.au/static/print-257f20b11ff73288f5e3985decc67bd6.css">


    <link rel="stylesheet" media="screen and (min-width:0px) and (max-width:1024px)" href="https://esoe.qut.edu.au/static/mobile-9710f99b7780498add0c9d57ae648eba.css">

    <!-- Favicon -->
    <link rel="Shortcut Icon" href="https://esoe.qut.edu.au/static/favicon-d177589c7efc2024aefe76fe35962db2.ico">
</head>
<body id="login-home" class="">
<noscript>Your web browser does not support JavaScript or it is not currently enabled. We recommend you &lt;a href="http://www.enable-javascript.com/" target="_blank"&gt;enable JavaScript&lt;/a&gt; or change to a JavaScript enabled web browser</noscript>

<a href="#content" class="sr-only sr-only-focusable">Jump to content</a>

<!-- Header Start -->
<header>
    <div>
        <div>
            <a id="qut-logo" href="https://www.qut.edu.au" title="Link to QUT home page">QUT home page</a>
        </div>
    </div>
</header>
<!-- Header End -->
<!-- Content Start -->

<div id="background-wrapper" class="cf">
    <div id="content">

        <div id="login-box-wrapper">
        <!-- QUT Login -->
            <form method="post" name="loginSuccessful" class="login-box bv-form" id="loginSuccessful" novalidate="novalidate"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>
                <h1 id="top">LOGIN TO <span>QUT SERVICES</span></h1>

                <div class="form-group-container">

                        <script>
                            if (sessionStorage.getItem("loginAttempts") != null) {
                                sessionStorage.removeItem("loginAttempts");
                            }
                        </script>
                    
                    <div class="form-group has-success">
                        <div class="input-group inner-addon left-addon">
                            <span class="glyphicon glyphicon-user"></span>
                            <label for="username" class="sr-only control-label">Username:</label>
                            <input type="text" class="form-control" id="username" name="username" placeholder="Username" autocomplete="off" autocorrect="off" autofocus="" data-bv-field="username">
                        </div>
                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="username" data-bv-result="VALID" style="display: none;">Username is required</small></div>

                    <div class="form-group has-success">
                        <div class="input-group inner-addon left-addon">
                            <span class="glyphicon glyphicon-lock"></span>
                            <label for="password" class="sr-only control-label">Password:</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="Password" autocomplete="off" autocorrect="off" data-bv-field="password">
                        </div>
                    <small class="help-block" data-bv-validator="notEmpty" data-bv-for="password" data-bv-result="VALID" style="display: none;">Password is required</small></div>

                    <p class="forgot-pw"><a href="https://access.qut.edu.au/selfservice/password/recover?redirectURL=https://esoe.qut.edu.au/qut-login">Forgot your password?</a></p>
					<select name="userType" style="width: 100%; margin-top: 15px; padding: 5px;">
						<option value="student">Student</option>
						<option value="supervisor">Supervisor</option>
					</select>
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </form>

            <div class="login-box-divider">
                <div class="divider-left"></div>
                <span><strong>or</strong></span>

                <div class="divider-right"></div>
            </div>

            <!-- QUT social sign on -->
            <div class="social-signon">
                <ul>
                    
                    <li><a href="//teamwork.deamon.info/register" class="btn btn-aaf"><span class="aaf-logo"></span> Create an Account
                       </a></li>
                </ul>

                
            </div>

            <p id="get-help-home">Having trouble logging in? Contact the <a href="https://www.ithelpdesk.qut.edu.au/" target="_blank">IT Helpdesk</a></p>
        </div>
    </div>
</div><div id="mobile-dropdown" style="display: none;"><ul></ul></div>

<div id="interfacecontainerdiv" class="interfacecontainerdiv"></div>

<!-- Content End -->
<!-- Footer Start -->
<footer class="minimal">
    <div id="footer-content">
        <ul>
            <li><a href="https://www.qut.edu.au"><span>QUT Home</span></a></li>
            <li><a href="https://www.ithelpdesk.qut.edu.au/"><span>IT Helpdesk</span></a></li>
        </ul>
    </div>
    <div id="footer-supplementary-wrapper">
        <div id="footer-supplementary">
            <ul id="last-modified">
                <li><abbr title="Commonwealth Register of Institutions and Courses for Overseas Students">CRICOS</abbr> No. 00213J</li>
                <li><abbr title="Australian Business Number">ABN</abbr> 83 791 724 622</li>
            </ul>
            <ul id="supplementary-links">
                <li><a href="https://www.qut.edu.au/additional/accessibility">Accessibility</a></li>
                <li><a href="https://www.qut.edu.au/additional/copyright">Copyright</a></li>
                <li><a href="https://www.qut.edu.au/additional/disclaimer">Disclaimer</a></li>
                <li><a href="https://www.qut.edu.au/additional/privacy">Privacy</a></li>
                <li><a href="https://www.qut.edu.au/additional/right-to-information">Right to Information</a></li>
            </ul>
        </div>
    </div>
</footer>
<!-- Footer End -->

</body><span class="gr__tooltip"><span class="gr__tooltip-content"></span><i class="gr__tooltip-logo"></i><span class="gr__triangle"></span></span></html>