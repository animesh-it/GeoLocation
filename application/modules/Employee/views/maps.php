<?php $this->load->view('employeejs');?>
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
                                                // $data = $row->LogData; 
                                                // $data = json_decode($data);
                                                if($row->userID == $employeeID)
                                                {
                                        ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $count++;?></td>
                                                    <td><?php echo (isset($row->callerID))?$row->callerID:'-';?></td>
                                                    <td><?php echo (isset($row->carrier))?$row->carrier:'-';?></td>
                                                    <td><?php echo (isset($row->deviceID))?$row->deviceID:'-';?></td>
                                                    <td><?php echo (isset($row->ipAddress))?$row->ipAddress:'-';?></td>
                                                    <td><?php echo (isset($row->latitude))?$row->latitude:'-';?></td>
                                                    <td><?php echo (isset($row->longitude))?$row->longitude:'-';?></td>
                                                    <td><?php echo (isset($row->locationAccessCode))?$row->locationAccessCode:'-';?></td>
                                                    <td><?php echo (isset($row->macAddress))?$row->macAddress:'-';?></td>
                                                    <td><?php echo $row->dateTime?></td>
                                                </tr>
                                        <?php
                                                }
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                 </div>
                                </div>