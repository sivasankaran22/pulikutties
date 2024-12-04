                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Edit</h1>
                        
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
                                            <h1 class="h4 text-gray-900 mb-4">Child</h1>
                                        </div>
                                        <form class="user" id="registerForm"  enctype="multipart/form-data">
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="text" class="form-control" id="exampleFirstName"
                                                        placeholder="Full Name" name="full_name" value="<?php echo $child_data["full_name"]; ?>" required>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" class="form-control" id="DOB" name="DOB"
                                                    placeholder="DOB" value="<?php echo $child_data["dob"]; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">    
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control" id="blood_group" name="blood_group">
                                                    <option value="">-- Select blood group --</option>
                                                    <?php foreach ($blood_groups as $key => $value): ?>
                                                        <?php $selected = ($key == $child_data["child_blood_group"]) ? "selected" : ""; ?>

                                                        <option value="<?= $key ?>" <?php echo $selected; ?>><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="file" class="form-control" name="profile_photo"
                                                        id="profile_photo" placeholder="profile photo" >
                                                        <img src="<?php echo base_url('').'/'.$child_data["chd_photo"] ?>" height="auto" width="150px">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="">-- Select Gender --</option>
                                                    <?php foreach ($gender as $key => $value): ?>
                                                        <?php $selected = ($key == $child_data["gender"]) ? "selected" : ""; ?>
                                                        <option value="<?= $key ?>" <?php echo $selected; ?>><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                                
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control" id="school_standards" name="school_standards">
                                                    <option value="">-- Select School Standards --</option>
                                                    <?php foreach ($school_standards as $value): ?>
                                                        <?php $selected = ($value["id"] == $child_data["school_standards_id"]) ? "selected" : ""; ?>
                                                        <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?>><?php echo $value["name"]; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-user" type="submit">
                                                Edit
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>                    

                                    