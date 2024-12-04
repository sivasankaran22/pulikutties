                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Child Details</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12"><img src="<?php echo base_url('').$child_user["profile_photo"] ?>" width="150" height="auto"></div>
                                <div class="col-sm-4">Child Name</div><div class="col-sm-8">:<?php echo $child_user["full_name"];?></div>
                                <div class="col-sm-4">Parent Name</div><div class="col-sm-8">:<?php echo $child_user["first_name"].' '.$child_user['last_name'];;?></div>
                                <div class="col-sm-4">Email</div><div class="col-sm-8">:<?php echo $child_user["email"];?></div>
                                <div class="col-sm-4">Phone</div><div class="col-sm-8">:<?php echo $child_user["phone"];?></div>
                                <div class="col-sm-4">Address</div><div class="col-sm-8">:<?php echo $child_user["address"];?></div>
                                <div class="col-sm-4">Circle</div><div class="col-sm-8">:<?php echo $child_user["circle_name"];?></div>
                                <div class="col-sm-4">Division</div><div class="col-sm-8">:<?php echo $child_user["division_name"];?></div>
                                <div class="col-sm-4">DOB</div><div class="col-sm-8">:<?php echo $child_user["dob"];?></div>
                                <div class="col-sm-4">Blood Group</div><div class="col-sm-8">:<?php echo $child_user["blood_group"];?></div>

                            </div>
                        </div>
                    </div>  
                    

                