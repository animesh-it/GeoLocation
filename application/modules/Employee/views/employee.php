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
                    </h3>
                    <!-- END PAGE TITLE-->
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                        <div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button> <?php echo $this->session->flashdata('SUCCESS');?>
                        </div>
                        <?php if(!isset($show)){?>
                        <form action ="<?php echo base_url()?>Employee/ListAll" method="POST">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="col-sm-8">
                                    <label for="Employee">Employee</label>
                                    <select name="Employee" id="Employee" class="form-control select2" >
                                        <?php echo $employeedropdown?>           
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-5">
                                    <label for="FromDate">From</label>
                                    <input type="readonly" name="FromDate" id="FromDate" data-date-format="yyyy-mm-dd" class="datepicker form-control" value="<?php echo date('Y-m').'-01'?>"/>
                                </div>
                                <div class="col-sm-5">
                                    <label for="ToDate">To</label>
                                    <input type="readonly" name="ToDate" id="ToDate" data-date-format="yyyy-mm-dd" class="datepicker form-control" value="<?php echo date('Y-m-d');?>"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                            <label></label>
                                <button type="Submit" class="form-control btn btn-success" name="Submit" value="Submit">Go</button>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div><?php } ?>
                     <div class="row">
                        <div class="col-md-12">
                        <?php if(isset($show) && $show == "show"){ ?>
                            <form action ="<?php echo base_url()?>Employee/ListAll" method="POST">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="col-sm-8">
                                    <label for="Employee">Employee</label>
                                    <select name="Employee" id="Employee" class="form-control select2" >
                                        <?php echo $selectedemployeedropdown?>           
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="col-sm-5">
                                    <label for="FromDate">From</label>
                                    <input type="readonly" name="FromDate" id="FromDate" data-date-format="yyyy-mm-dd" class="datepicker form-control" value="<?php echo $fromdate?>"/>
                                </div>
                                <div class="col-sm-5">
                                    <label for="ToDate">To</label>
                                    <input type="readonly" name="ToDate" id="ToDate" data-date-format="yyyy-mm-dd" class="datepicker form-control" value="<?php echo $todate?>"/>
                                </div>
                            </div>
                            <div class="col-md-2">
                            <label></label>
                                <button type="Submit" class="form-control btn btn-success" name="Submit" value="Submit">Go</button>
                            </div>
                        </div>
                        </form>
                        </div>
                    </div>
                    <hr>
                    <br>
                    <ul class="nav nav-pills">
                        <li class="active"><a data-toggle="pill" href="#map">Map</a></li>
                        <li><a data-toggle="pill" href="#List">Table</a></li>
                      </ul>
                   <div class="tab-content">
                    <div id="map" class="tab-pane fade in active">
                        <head><?php echo $map['js']; ?></head>
                        <body><?php echo $map['html']; ?></body>
                    </div>
                    <div id="List" class="tab-pane fade">
                             <table class="table table-striped table-bordered table-hover table-checkable order-column" id="PartnerbranchesListTable">
                                        <thead>
                                            <tr>
                                                <th> # </th>
                                                <th> Caller ID </th>
                                                <th> Carrier </th>
                                                <th> Device ID </th>
                                                <th> IP Address </th>
                                                <th> Latitude </th>
                                                <th> Longitude </th>
                                                <th> LAC </th>
                                                <th> Mac </th>
                                                <th>Time </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php 
                                            $count =1;
                                            foreach($employeedata->result() as $row){
                                                $data = $row->LogData; 
                                                $data = json_decode($data);
                                                if($data->userID == $employeeID)
                                                {
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $count++;?></td>
                                                    <td><?php echo (isset($data->callerID))?$data->callerID:'-';?></td>
                                                    <td><?php echo (isset($data->carrier))?$data->carrier:'-';?></td>
                                                    <td><?php echo (isset($data->deviceID))?$data->deviceID:'-';?></td>
                                                    <td><?php echo (isset($data->ipAddress))?$data->ipAddress:'-';?></td>
                                                    <td><?php echo (isset($data->latitude))?$data->latitude:'-';?></td>
                                                    <td><?php echo (isset($data->longitude))?$data->longitude:'-';?></td>
                                                    <td><?php echo (isset($data->locationAccessCode))?$data->locationAccessCode:'-';?></td>
                                                    <td><?php echo (isset($data->macAddress))?$data->macAddress:'-';?></td>
                                                    <td><?php echo $row->DateOfLog?></td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                 </div>
                                </div>
                                <?php }  ?>
                    </div>
                </div>
                <!-- END CONTENT BODY -->
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->