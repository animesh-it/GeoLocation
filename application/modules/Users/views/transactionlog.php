
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
                    </div>
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> <?php echo $this->session->flashdata('SUCCESS');?>
                        </div>
                        <table class="table table-striped table-bordered table-hover table-checkable order-column" id="queryListTable">
                                        <thead>
                                            <tr>
                                            	<th>#</th>
                                                <th> Lat </th>
                                                <th> Long </th>
                                                <th> Control ID </th>
                                                <th> Device ID </th>
                                                <th> User Name </th>
                                                <th> Session ID </th>
                                                <th> Txn Date </th>
                                                <th> Agent Code </th>
                                                <th> ImageFront </th>
                                                <th> ImageBack </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if($query->num_rows()){
											$i = 1;
                                            foreach($query->result() as $row):
                                        ?>
                                            <tr class="odd gradeX">
                                            	<td><?php echo $i++ ?></td>
                                                <td><?php echo $row->Latitude;?></td>
                                                <td><?php echo $row->Longitude;?></td>
                                                <td><?php echo $row->ControlID;?></td>
                                                <td><?php echo $row->DeviceID;?></td>                                   
                                                <td><?php echo $row->Username;?></td>
                                                <td><?php echo $row->SessionID;?></td>
                                                <td><?php echo $row->TransactionDate;?></td>
                                                <td><?php echo $row->AgentCode;?></td>
                                                <td><?php echo $row->ImageFront;?></td>
                                                <td><?php echo $row->ImageBack;?></td>
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
