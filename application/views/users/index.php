<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Pengguna Sistem</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sipempo | Daftar Pengguna Sistem
                </div>

                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($message) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message; ?></div>
                                <?php
                            } ?>

                            <p align="right">
                                <?php echo anchor('users/create', 'Tambah Pengguna Baru', "class='btn btn-success'") ?>
                            </p>

                            <table cellpadding=0 cellspacing=10 class="table">
                                <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nip</th>
                                    <th>Username</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Groups</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php

                                $i = 1;

                                foreach ($users as $user): ?>
                                    <?php $groups = []; ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo htmlspecialchars($user->nip, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->username, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->first_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($user->last_name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php foreach ($user->groups as $group): ?>
                                                <?php $groups[] = $group->name; ?>
                                                <?php if ($this->config->item('admin_group', 'ion_auth')
                                                    == $group->name
                                                ) : ?>
                                                    <span class="center-block text-center">
                                                        <?php echo htmlspecialchars(
                                                            $group->name, ENT_QUOTES,
                                                            'UTF-8'); ?>
                                                    </span>
                                                <?php else: ?>
                                                    <a href="<?php echo site_url("users/edit_group/$group->id") ?>"
                                                       class="btn btn-default center-block">
                                                        <?php echo htmlspecialchars(
                                                            $group->name,
                                                            ENT_QUOTES, 'UTF-8'
                                                        ) ?>
                                                    </a>
                                                <?php endif; ?>
                                            <?php endforeach ?>
                                        </td>
                                        <td>
                                            <?php if (in_array(
                                                    $this->config->item('admin_group', 'ion_auth'), $groups)) : ?>
                                                <?php echo ($user->active) ? anchor(
                                                    "users/deactivate/" . $user->id , "Aktifkan", "class='btn btn-info'") :
                                                    anchor("users/activate/" . $user->id , "Non Aktifkan");
                                                ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php
                                            echo anchor(
                                                "users/edit/" . $user->id,
                                                'Edit', "class='btn btn-warning'");
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                    $i++;
                                endforeach; ?>

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
            </div>
            <!-- /.panel-heading -->
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
</div>