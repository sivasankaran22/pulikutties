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
                                            <h1 class="h4 text-gray-900 mb-4">Parent</h1>
                                        </div>
                                        <form class="user" id="registerForm"  enctype="multipart/form-data">
                                            <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                            <label>First Name</label>
                                                <input type="text" class="form-control" id="exampleFirstName"
                                                    placeholder="First Name" name="first_name" value="<?php echo $user_data["first_name"]; ?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                            <label>Last Name</label>
                                                <input type="text" class="form-control" id="exampleLastName"
                                                    placeholder="Last Name" name="last_name"  value="<?php echo $user_data["last_name"]; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Email Address</label>
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email Address" value="<?php echo $user_data["email"]; ?>"  readonly>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Phone No</label>
                                                <input type="number" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone No" value="<?php echo $user_data["phone"]; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>DOB</label>
                                                <input type="date" class="form-control" id="DOB" name="DOB"
                                                    placeholder="DOB"  value="<?php echo $user_data["DOB"]; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Select Blood Group</label>
                                                <select class="form-control" id="blood_group" name="blood_group">
                                                    <option value="">-- Select blood group --</option>
                                                    <?php foreach ($blood_groups as $key => $value): ?>
                                                        <?php $selected = ($key == $user_data["blood_group"]) ? "selected" : ""; ?>

                                                        <option value="<?= $key ?>" <?php echo $selected; ?> ><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mb-3 mb-sm-0">
                                                <label>Address</label>
                                                <textarea class="form-control" id="Address" name="Address"
                                                    placeholder="Address" ><?php echo $user_data["Address"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Select circle</label>
                                                <select class="form-control" id="circle" name="circle">
                                                    <option value="">-- Select circle --</option>
                                                    <?php foreach ($circle as $value): ?>
                                                        <?php $selected = ($value['id'] == $user_data["circle"]) ? "selected" : ""; ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?> ><?php echo $value["circle"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Select division</label>
                                                <select class="form-control" id="division" name="division">
                                                    <option value="">-- Select division --</option>
                                                    <?php foreach ($division as $value): ?>
                                                        <?php $selected = ($value['id'] == $user_data["division"]) ? "selected" : ""; ?>
                                                        <option value="<?php echo $value["id"] ?>" <?php echo $selected; ?> ><?php echo $value["division"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Select Gender</label>
                                                <select class="form-control" id="gender" name="gender">
                                                    <option value="">-- Select Gender --</option>
                                                    <?php foreach ($gender as $key => $value): ?>
                                                        <option value="<?= $key ?>"><?= $value ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                                    <input type="hidden" name="status" value="1">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <label>Profile Photo</label>
                                                    <input type="file" class="form-control" name="profile_photo"
                                                        id="profile_photo" placeholder="profile photo">
                                                    <img src="<?php echo base_url('').'/'.$user_data["profile_photo"] ?>" height="auto" width="150px">
                                                        <input type="hidden" name="role" value="parent" />
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

                                    