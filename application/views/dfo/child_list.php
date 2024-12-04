                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Child</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Child Name</th>
                                            <th>Parent Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Circle</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Child Name</th>
                                            <th>Parent Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Circle</th>
                                            <th>Division</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($child as $list): ?>
                                        <tr>
                                            <td><?php echo $list['full_name']; ?></td>
                                            <td><?php echo $list['first_name']." ".$list["last_name"]; ?></td>
                                            <td><?php echo $list['email']; ?></td>
                                            <td><?php echo $list['phone']; ?></td>
                                            <td><?php echo $list['circle_name']; ?></td>
                                            <td><?php echo $list['division_name']; ?></td>
                                            <td><a class="btn btn-primary m-1" href="<?php echo site_url('dfo/child-profile').'/'.$list['child_id']; ?>">view</a>
                                            <a class="btn btn-secondary m-1" href="<?php echo site_url('dfo/child-edit-profile').'/'.$list['child_id']; ?>">Edit</a>
                                            <a class="btn btn-danger m-1">Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    

                