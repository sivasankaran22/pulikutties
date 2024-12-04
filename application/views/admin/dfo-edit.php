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
                                            <h1 class="h4 text-gray-900 mb-4">DFO</h1>
                                        </div>
                                        <form class="user" id="registerForm"  enctype="multipart/form-data">
                                            <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control" id="exampleFirstName"
                                                    placeholder="First Name" name="first_name" value="<?php echo $user_data["first_name"]; ?>" required>
                                            </div>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" id="exampleLastName"
                                                    placeholder="Last Name" name="last_name"  value="<?php echo $user_data["last_name"]; ?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="Email Address" value="<?php echo $user_data["email"]; ?>"  readonly>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="number" class="form-control" id="phone" name="phone"
                                                    placeholder="Phone No" value="<?php echo $user_data["phone"]; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="date" class="form-control" id="DOB" name="DOB"
                                                    placeholder="DOB"  value="<?php echo $user_data["DOB"]; ?>">
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
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
                                                <textarea class="form-control" id="Address" name="Address"
                                                    placeholder="Address" ><?php echo $user_data["Address"]; ?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <select class="form-control" id="circle" name="circle">
                                                    <option value="">-- Select circle --</option>
                                                    <?php foreach ($circle as $value): ?>
                                                        <?php $selected = ($value['id'] == $user_data["circle"]) ? "selected" : ""; ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo $selected; ?> ><?php echo $value["circle"] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
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
                                                    <label>Status</label>
                                                    <div>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" value="1" <?php if($user_data["active"]) echo "checked" ?>> Active
                                                        </label>
                                                        <label class="radio-inline">
                                                            <input type="radio" name="status" value="0" <?php if(!$user_data["active"]) echo "checked" ?>> Deactive
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                    <input type="file" class="form-control" name="profile_photo"
                                                        id="profile_photo" placeholder="profile photo">
                                                    <img src="<?php echo base_url('').'/'.$user_data["profile_photo"] ?>" height="auto" width="150px">
                                                        <input type="hidden" name="role" value="dfo" />
                                                </div>
                                            </div>
                                            <button class="btn btn-primary btn-user btn-block" type="submit">
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

                                    