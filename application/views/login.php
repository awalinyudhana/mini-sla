<?php echo '<?xml version="1.0" encoding="UTF-8"?>' ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/css/bootstrap.css"); ?>"/>
    <script type="text/javascript" src="<?php echo base_url("assets/bootstrap/js/bootstrap.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo base_url("assets/bootstrap/jquery-1.10.2.js"); ?>"></script>
    <link rel="stylesheet" href="<?php echo base_url("assets/bootstrap/loginstyle.css"); ?>"/>
    <title>SIMILA: Login</title>
    <style>
        /*@import "bourbon";*/

        body {
            background: #eee !important;
        }

        .wrapper {
            margin-top: 80px;
            margin-bottom: 80px;
        }

        .form-signin {
            max-width: 380px;
            padding: 15px 35px 45px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid rgba(0, 0, 0, 0.1);

        .form-signin-heading,
        .checkbox {
            margin-bottom: 30px;
        }

        .checkbox {
            font-weight: normal;
        }

        .form-control {
            position: relative;
            font-size: 16px;
            height: auto;
            padding: 10px;
        @include box-sizing(border-box);

        &
        :focus {
            z-index: 2;
        }

        }

        input[type="text"] {
            margin-bottom: -1px;
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 0;
        }

        input[type="password"] {
            margin-bottom: 20px;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
        }

        }

    </style>
</head>
<body>
    <div class="container">
        <div class="wrapper">
            <?php echo form_open(current_url(), array('class' => 'form-signin')); ?>
            <h1>User Login</h1>
            <?php if ($message) {
                ?>
                <div class="alert alert-warning"><?php echo $message; ?></div>
                <?php
            } ?>
            <label for="username">Username:</label>
            <input name="username" type="text" class="form-control">
            <label for="password">Password:</label>
            <input name="password" value="" id="password" type="password" class="form-control">
            <input name="submit" value="Login" type="submit" class="btn btn-lg btn-primary btn-block">
            <?php echo form_close(); ?>
        </div>
    </div>
</body>
</html>