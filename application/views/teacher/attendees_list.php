                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Attendees</h1>
                        
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
                                            <th>DFO Name</th>
                                            <th>Title</th>
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Child Name</th>
                                            <th>Parent Name</th>
                                            <th>DFO Name</th>
                                            <th>Title</th>
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($attend as $list): ?>
                                        <tr>
                                            <td><img src="<?php echo base_url('').$list['chd_photo'] ?>" width="150px" height="auto"><br><?php echo $list['full_name']; ?></td>
                                            <td><?php echo $list['p_f_name']." ".$list['p_l_name']; ?></td>
                                            <td><?php echo $list['d_f_name']." ".$list['d_l_name']; ?></td>
                                            <td><?php echo $list['title']; ?></td>
                                            <td><?php echo $list['start_datetime']; ?></td>
                                            <td><?php echo $list['end_datetime']; ?></td>
                                            <td><a class="btn btn-primary m-1" href="<?php echo site_url('teacher/attendees-details').'/'.$list['id']; ?>">view</a><a class="btn btn-secondary m-1" href="<?php echo site_url('teacher/attendees-edit').'/'.$list['id']; ?>">Edit</a>
                                            <a class="btn btn-danger m-1" href="<?php echo site_url('teacher/attendees-delete').'/'.$list['id']; ?>"   onclick="return confirmDelete();">Delete</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    

                