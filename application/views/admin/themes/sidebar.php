<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="<?php echo base_url() ?>"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                <ul class="nav nav-second-level">

<!--                    --><?php //if ($this->ion_auth->in_group(['superadmin'])) {?>
<!--                        <li>-->
<!--                            <a href="--><?php //echo base_url('voting-result')?><!--">-->
<!--                                <i class="fa fa-bar-chart-o fa-fw"></i> Hasil Pemilihan</a>-->
<!--                        </li>-->
<!--                    --><?php //} ?>

                    <?php if ($this->ion_auth->in_group(['superadmin'])) {?>
                        <li>
                            <a href="<?php echo base_url('voting-result')?>">
                                <i class="fa fa-bar-chart-o fa-fw"></i> Hasil Pemilihan</a>
                        </li>
                    <?php } ?>
                    <li>
                        <a href="<?php echo base_url('voter-percentage')?>">
                            <i class="fa fa-bar-chart-o fa-fw"></i> Prosentase Pemilih</a>
                    </li>
<!--                    <li>-->
<!--                        <a href="--><?php //echo base_url('booth-monitoring')?><!--">-->
<!--                            <i class="fa fa-bar-chart-o fa-fw"></i> Monitor Bilik</a>-->
<!--                    </li>-->
                </ul>
            </li>

            <?php if ($this->ion_auth->in_group(['superadmin'])) {?>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Manajemen Aplikasi<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('users')?>">Users</a>
                        </li>
<!--                        <li>-->
<!--                            <a href="--><?php //echo base_url('groups')?><!--"> Groups</a>-->
<!--                        </li>-->
                        <li>
                            <a href="<?php echo base_url('event')?>"> Event</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php } ?>


            <?php if ($this->ion_auth->in_group(['operator'])) {?>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Data Awal Pemilih<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('ImportExcel') ?>">
                                <i class="fa fa-table fa-fw"></i> Import Data Awal Pemilih
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Voter') ?>">
                                <i class="fa fa-files-o fa-fw"></i> Data Awal Pemilih
                            </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-wrench fa-fw"></i> Aturan Pemilihan <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('Section') ?>"><i class="fa fa-edit fa-fw"></i> Kelembagaan</a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('Booth') ?>"><i class="fa fa-sitemap fa-fw"></i> Bilik</a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
                <li>
                    <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Verifikasi Pemilih<span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a href="<?php echo base_url('VoterList') ?>">
                                <i class="fa fa-files-o fa-fw"></i> Data Pemilih
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('VoterWaiting') ?>">
                                <i class="fa fa-files-o fa-fw"></i> Antrian Pemilih
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo base_url('History') ?>">
                                <i class="fa fa-files-o fa-fw"></i> Riwayat Pemilih
                            </a>
                        </li>
                    </ul>
                    <!-- /.nav-second-level -->
                </li>
            <?php } ?>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->
