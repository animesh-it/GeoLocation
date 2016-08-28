
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <!-- BEGIN PAGE BAR -->
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <a href="index.html">Home</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <a href="#">Blank Page</a>
                                <i class="fa fa-circle"></i>
                            </li>
                            <li>
                                <span>Page Layouts</span>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE BAR -->
                    <!-- BEGIN PAGE TITLE-->
                    <h3 class="page-title"> <?php echo $title;?> 
                    <div class="input-group pull-right">
                        <a href="<?php echo base_url();?>Users/Add" class="btn blue"><i class="fa fa-plus"></i> Add New User</a>
                    </div>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> <?php echo $this->session->flashdata('SUCCESS');?>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="UsersListTable">
                                        <thead>
                                            <tr>
                                                <th width="8%"> Agent Code </th>
                                                <th> Name </th>
                                                <th> DeviceID </th>
                                                <th> Username </th>
                                                <th width="5%"> Is Active </th>
                                                <th width="10%"> Actions </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($users->num_rows()){
                                            foreach($users->result() as $user):
                                        ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $user->AgentCode;?></td>
                                                <td><?php echo $user->Name;?></td>
                                                <td><?php echo $user->DeviceID;?></td>
                                                <td><?php echo $user->Username;?></td>
                                                <td><?php echo $user->IsActive;?></td>
                                                <td><a href="<?php echo base_url();?>Users/Edit/<?php echo $user->ID;?>" class="btn green btn-sm" title="Edit"><i class="fa fa-edit"></i></a> <a href="" class="btn red btn-sm" title="Delete"><i class="fa fa-remove"></i></a></td>    
                                            </tr>
                                        <?php
                                            endforeach;
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                        </div>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
