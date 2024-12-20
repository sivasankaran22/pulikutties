                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Create New</h1>
                        
                    </div>

                        <!-- Content Row -->
                    <div class="row">

                            <!-- Earnings (Monthly) Card Example -->
                            <div class="col-12">
                                <div class="card shadow h-100 py-2">
                                    <div class="card-body">
                                    <div class="row">
                                <div class="col-lg-12">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Attendees</h1>
                                        </div>
                                        <form class="user" id="registerForm"  enctype="multipart/form-data">
                                            <div class="form-group row">    
                                                <div class="col-12 mb-3 mb-sm-0">
                                                <label for="child_id">Select Section</label>
                                                <select class="form-control" id="section_id" name="section_id">
                                                    <option value="">-- Select Section --</option>
                                                    <?php foreach ($section as $list): ?>
                                                        <option value="<?= $list["id"] ?>"><?= $list["title"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="child_id">Select Attend Child List</label>
                                                    <select class="form-control" id="child_id" name="child_id">
                                                        <option value="">-- Select Child --</option>    
                                                    <?php foreach ($all_child as $value): ?>
                                                            <option value="<?php echo $value["child_id"]; ?>" data-parent="<?=$value['parent_id']?>">
                                                                <?php echo $value["full_name"] . " (" . $value["first_name"] . " " . $value["last_name"] . ")"; ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <div>
                                                        <div id="child-list-container">
                                                            <p id="no-child-message">No child is selected yet.</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <label for="section_details">Upload Section Notes ( Multiple images )</label>
                                                    <input type="file" class="form-control" name="section_details[]"
                                                        id="section_details" placeholder="profile photo" required multiple>

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <div id="preview-container" class="row"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="dfo_id" value="<?=$dfo_id?>" />
                                            <input type="hidden" id="parent_id" name="parent_id">
                                            <button class="btn btn-primary btn-user" type="submit">
                                                Create
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    

                                    