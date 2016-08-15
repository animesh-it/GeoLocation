
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
                    <form class="form-horizontal" action="<?php echo base_url();?>Users/Edit/<?php echo $user->ID;?>" method="post" role="form" id="EditUserForm">
                        <!-- BEGIN PAGE TITLE-->
                        <h3 class="page-title"> <?php echo $title;?> 
                        <div class="input-group pull-right">
                            <button type="submit" name="Save" value="Save" class="btn blue"><i class="fa fa-save"></i> Save </button> <a href="<?php echo base_url();?>Users/Add" class="btn red"><i class="fa fa-remove"></i> Cancel </a> 
                        </div>
                        </h3>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                    <input type="hidden" name="ID" value="<?php echo $user->ID;?>" />
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Agent Code
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="AgentCode" class="form-control" placeholder="Enter Agent Code" value="<?php echo $user->AgentCode;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Name
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="Name" class="form-control" placeholder="Enter Full Name" value="<?php echo $user->Name;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Email Address</label>
                                        <div class="col-md-6">
                                            <input type="text" name="Email" class="form-control" placeholder="Enter Email Address" value="<?php echo $user->Email;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Device ID
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="DeviceID" class="form-control" placeholder="Enter Device ID" value="<?php echo $user->DeviceID;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">API Password
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="APIPassword" class="form-control" placeholder="Enter API Password" value="<?php echo $user->APIPassword;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Geo Code
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="GeoCode" class="form-control" placeholder="Enter Geo Code" value="<?php echo $user->GeoCode;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Username
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="Username" class="form-control" placeholder="Enter Username" value="<?php echo $user->Username;?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Password
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="password" name="Password" id="Password" class="form-control" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Status</label>
                                        <div class="col-md-6">
                                            <div class="mt-radio-inline">
                                                <label class="mt-radio">
                                                    <input type="radio" name="IsActive" value="yes" <?php echo ($user->IsActive=='yes')?'checked':'';?>> Active
                                                    <span></span>
                                                </label>
                                                <label class="mt-radio">
                                                    <input type="radio" name="IsActive" value="no" <?php echo ($user->IsActive=='no')?'checked':'';?>> Inactive
                                                    <span></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
