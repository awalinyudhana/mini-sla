<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"> Groups Pengguna Sistem</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Sipempo | Daftar Group Pengguna Sistem
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <?php if ($message) {
                                ?>
                                <div class="alert alert-warning"><?php echo $message; ?></div>
                                <?php
                            } ?>

                            <p align="right"><?php echo anchor('groups/create', 'create', "class='btn btn-default'", lang('index_create_group_link'), "class='btn btn-success'") ?></p>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Description</th>
                                    <th><?php echo lang('index_action_th'); ?></th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($groups as $group): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($group->name, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td><?php echo htmlspecialchars($group->description, ENT_QUOTES, 'UTF-8'); ?></td>
                                        <td>
                                            <?php echo anchor("groups/edit/" . $group->id, 'Edit', "class='btn btn-warning'"); ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
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


