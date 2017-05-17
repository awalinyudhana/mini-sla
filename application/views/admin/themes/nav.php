<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() ?>"> Sistem Informasi Pemeliharaan Produk</a>
            <p class="pull-right">
                <?php
                if ($this->ion_auth->is_admin())
                {
                    $group_of= 'admin';
                } elseif ($this->ion_auth->in_group("manager")) {
                    $group_of = 'Technical Manager';
                } elseif ($this->ion_auth->in_group("technical")) {
                    $group_of = 'Technical';
                } elseif ($this->ion_auth->in_group("support")) {
                    $group_of = 'Technikal Support';
                } elseif ($this->ion_auth->in_group("sales")) {
                    $group_of = 'Sales';
                } elseif ($this->ion_auth->in_group("bod")) {
                    $group_of = 'boq';
                } else {
                    $group_of = ' ';
                }

                $user = $this->ion_auth->user()->row();
                echo $user->first_name.' '.$user->last_name.' , Anda login sebagai '. $group_of; ?></p>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a href="<?php echo base_url('logout') ?>" class="navbar-brand"><strong>Logout</strong></a>
                <!-- /.dropdown-messages -->
            </li>
            <li class="dropdown">
                <a href="<?php echo base_url('logout') ?>" class="navbar-brand"><strong>Logout</strong></a>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </nav>
    <!-- /.navbar-static-top -->
