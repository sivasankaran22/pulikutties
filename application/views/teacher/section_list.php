                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">All Sections</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>DFO Name</th>
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>DFO Name</th>
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($section as $list): ?>
                                        <tr>
                                            <td><?php echo $list['title']; ?></td>
                                            <td><?php echo $list['first_name']." ".$list['last_name']; ?></td>
                                            <td><?php echo $list['start_datetime']; ?></td>
                                            <td><?php echo $list['end_datetime']; ?></td>
                                            <td><a class="btn btn-primary m-1" href="<?php echo site_url('teacher/section-details').'/'.$list['id']; ?>">view</a>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    

                