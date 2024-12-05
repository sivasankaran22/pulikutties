                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">DFO Details</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12"><img src="<?php echo base_url('').$dfo_user["profile_photo"] ?>" width="150" height="auto"></div>
                                <div class="col-sm-4">Name</div><div class="col-sm-8">:<?php echo $dfo_user["first_name"].' '.$dfo_user['last_name'];;?></div>
                                <div class="col-sm-4">Email</div><div class="col-sm-8">:<?php echo $dfo_user["email"];?></div>
                                <div class="col-sm-4">Phone</div><div class="col-sm-8">:<?php echo $dfo_user["phone"];?></div>
                                <div class="col-sm-4">Address</div><div class="col-sm-8">:<?php echo $dfo_user["Address"];?></div>
                                <div class="col-sm-4">Circle</div><div class="col-sm-8">:<?php echo $dfo_user["circle_name"];?></div>
                                <div class="col-sm-4">Division</div><div class="col-sm-8">:<?php echo $dfo_user["division_name"];?></div>
                                <div class="col-sm-4">Gender</div><div class="col-sm-8">:<?php echo $dfo_user["gender"];?></div>
                                <div class="col-sm-4">DOB</div><div class="col-sm-8">:<?php echo $dfo_user["DOB"];?></div>
                                <div class="col-sm-4">Blood Group</div><div class="col-sm-8">:<?php echo $dfo_user["blood_group"];?></div>

                            </div>
                        </div>
                    </div>  
                    
                    <!-- DataTales Example Teacher -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Teacher Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Circle</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Teacher Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Circle</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($teachers as $list): ?>
                                        <tr>
                                            <td><?php echo $list['first_name']." ".$list["last_name"]; ?></td>
                                            <td><?php echo $list['email']; ?></td>
                                            <td><?php echo $list['phone']; ?></td>
                                            <td><?php echo $list['circle_name']; ?></td>
                                            <td><?php echo $list['division_name']; ?></td>
                                            <td><a class="btn btn-primary m-1" href="<?php echo site_url('admin/teacher-profile').'/'.$list['id']; ?>">view</a><a class="btn btn-secondary m-1" href="<?php echo site_url('admin/parent-edit-profile').'/'.$list['id']; ?>">Edit</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div> 

                