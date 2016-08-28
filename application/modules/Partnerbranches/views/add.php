
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
                    <form class="form-horizontal" action="<?php echo base_url();?>Partnerbranches/Add" method="post" role="form" id="AddNewPartnerbranchForm">
                        <!-- BEGIN PAGE TITLE-->
                        <h3 class="page-title"> <?php echo $title;?> 
                        <div class="input-group pull-right">
                            <button type="submit" name="Save" value="Save" class="btn blue"><i class="fa fa-save"></i> Save </button> <a href="<?php echo base_url();?>Partnerbranches/ListAll" class="btn red"><i class="fa fa-remove"></i> Cancel </a> 
                        </div>
                        </h3>
                        <!-- END PAGE TITLE-->
                        <!-- END PAGE HEADER-->
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-body">
                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button> You have some form errors. Please check below. </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Branch Code
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="Code" class="form-control" placeholder="Enter Branch Code">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Branch Name
                                            <span class="required"> * </span>
                                        </label>
                                        <div class="col-md-6">
                                            <input type="text" name="Title" class="form-control" placeholder="Enter Partner branch Name">
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
