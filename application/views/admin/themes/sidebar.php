<nav class="navbar-default navbar-static-side" role="navigation">
    <img src="<?php echo base_url('assets/logo.jpg') ;?>" class="text-left" width="250px" height="100px" alt="logo">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <ul class="nav nav-second-level side-nav">
                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#master-menu"><i class="fa fa-fw fa-table"></i> Master <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="master-menu" class="collapse ul-sub-menu">
                            <?php if ($this->ion_auth->in_group(['admin','manager'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('users')?>">
                                        <i class="fa fa-user fa-fw"></i>Staff</a>
                                </li>
                            <?php endif; ?>
                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('customer')?>">
                                    <i class="fa fa-user-md fa-fw"></i>Konsumen</a>
                            </li>
                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('perangkat')?>">
                                    <i class="fa fa-apple fa-fw"></i>Perangkat</a>
                            </li>
                            <?php if ($this->ion_auth->in_group(['manager','technical'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('service_level')?>">
                                        <i class="fa fa-adjust fa-fw"></i>Service Level</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#boq-menu"><i class="fa fa-fw fa-magic"></i> BoQ <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="boq-menu" class="collapse ul-sub-menu">
                            <?php if ($this->ion_auth->in_group(['admin'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('boq')?>">
                                        <i class="fa fa-magic fa-fw"></i>BoQ</a>
                                </li>
                            <?php endif; ?>
                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('boq/lists')?>">
                                    <i class="fa fa-list fa-fw"></i>Daftar BoQ</a>
                            </li>
                        </ul>
                    </li>

                    <?php if ($this->ion_auth->in_group(['manager', 'technical'])) :?>
                        <li>
                            <a href="<?php echo base_url('ticket/by_device')?>">
                                <i class="fa fa-android fa-fw"></i>Perangkat Terinstal</a>
                        </li>
                    <?php endif; ?>
                    <?php if ($this->ion_auth->in_group(['manager', 'technical'])) :?>
                        <li>
                            <a href="<?php echo base_url('ticket/by_customer')?>">
                                <i class="fa fa-book fa-fw"></i>Daftar Customer</a>
                        </li>
                    <?php endif; ?>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#ticket-menu"><i class="fa fa-fw fa-ticket"></i> Ticket <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="ticket-menu" class="collapse ul-sub-menu">
                            <?php if ($this->ion_auth->in_group(['admin','manager', 'technical','sales','boq'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('ticket_list')?>">
                                        <i class="fa fa-ticket fa-fw"></i>Ticket Pending</a>
                                </li>
                            <?php endif; ?>
                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('ticket_list/closed')?>">
                                    <i class="fa fa-ticket fa-fw"></i>Ticket Closed</a>
                            </li>
                            <!--
                            <?php if ($this->ion_auth->in_group(['admin'])) :?>
                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('ticket_list/all')?>">
                                    <i class="fa fa-ticket fa-fw"></i>Daftar Semua Ticket</a>
                            </li>
                            <?php endif; ?>-->
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:;" data-toggle="collapse" data-target="#report-menu"><i class="fa fa-fw fa-file"></i> Report <i class="fa fa-fw fa-caret-down"></i></a>
                        <ul id="report-menu" class="collapse ul-sub-menu">
                            <?php if ($this->ion_auth->in_group(['admin', 'manager', 'technical','sales','boq'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('ticket_list/overdue')?>">
                                        <i class="fa fa-ticket fa-fw"></i>Overdue Ticket</a>
                                </li>
                            <?php endif; ?>

                            <?php if ($this->ion_auth->in_group(['manager', 'technical','sales','boq'])) :?>
                                <li class="li-sub-menu">
                                    <a href="<?php echo base_url('report/technical_score')?>">
                                        <i class="fa fa-dashboard fa-fw"></i>Technical Score</a>
                                </li>
                            <?php endif; ?>

                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('report/ticket_graph')?>">
                                    <i class="fa fa-ticket fa-fw"></i>Ticket Count Graph</a>
                            </li>

                            <li class="li-sub-menu">
                                <a href="<?php echo base_url('report/ticket_graph_by_category')?>">
                                    <i class="fa fa-ticket fa-fw"></i>Ticket Type Graph</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->
