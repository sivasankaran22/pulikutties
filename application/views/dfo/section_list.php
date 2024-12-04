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
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Title</th>
                                            <th>Start Date and Time</th>
                                            <th>End Date and Time</th>
                                            <th>Action</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                    <?php foreach ($section as $list): ?>
                                        <tr>
                                            <td><?php echo $list['title']; ?></td>
                                            <td><?php echo $list['start_datetime']; ?></td>
                                            <td><?php echo $list['end_datetime']; ?></td>
                                            <td><a class="btn btn-primary m-1" href="<?php echo site_url('dfo/section-details').'/'.$list['id']; ?>">view</a>
                                            <a class="btn btn-secondary m-1" href="<?php echo site_url('dfo/section-edit-profile').'/'.$list['id']; ?>">Edit</a>
                                            <a class="btn btn-danger m-1" href="<?php echo site_url('dfo/section/delete').'/'.$list['id']; ?>"  onclick="return confirmDelete();">Delete</a></td>
                                        </tr>
                                    <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>                    

                