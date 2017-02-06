<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() ?>"> SIMILA</a>
            <p class="navbar-brand">
                <?php
                $user = $this->ion_auth->user()->row();

                echo $user->first_name.' '.$user->last_name; ?></p>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a href="<?php echo base_url('logout') ?>" class="navbar-brand"><strong>Logout</strong></a>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </nav>
    <!-- /.navbar-static-top -->
