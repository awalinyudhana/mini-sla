<body>
<div id="wrapper">
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
        <div class="navbar-header">
            <a class="navbar-brand" href="<?php echo base_url() ?>"> Sistem Informasi Pemeliharaan Produk</a>
        </div>
        <!-- /.navbar-header -->
        <ul class="nav navbar-top-links navbar-right">
            <?php
                if ($this->ion_auth->is_admin())
                {
                    $group_of= 'FAO';
                } elseif ($this->ion_auth->in_group("manager")) {
                    $group_of = 'Technical Manager';
                } elseif ($this->ion_auth->in_group("technical")) {
                    $group_of = 'Technical';
                } elseif ($this->ion_auth->in_group("support")) {
                    $group_of = 'Technical Support';
                } elseif ($this->ion_auth->in_group("sales")) {
                    $group_of = 'Sales';
                } elseif ($this->ion_auth->in_group("boq")) {
                    $group_of = 'BOQ';
                } else {
                    $group_of = ' ';
                }

                $user = $this->ion_auth->user()->row();
            ?>
            <li class="account-info">
                <p><?php echo $user->first_name.' '.$user->last_name; ?></p>
                <p><?php echo $group_of; ?></p>
            </li>
            <li class="nav-logout">
                <a href="<?php echo base_url('logout') ?>" class="navbar-brand logout-link"><strong>Logout</strong></a>
                <!-- /.dropdown-messages -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
    </nav>
    <!-- /.navbar-static-top -->
