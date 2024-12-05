                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Teacher Details</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12"><img src="<?php echo base_url('').$teacher_user["profile_photo"] ?>" width="150" height="auto"></div>
                                <div class="col-sm-4">Name</div><div class="col-sm-8">:<?php echo $teacher_user["first_name"].' '.$teacher_user['last_name'];;?></div>
                                <div class="col-sm-4">Email</div><div class="col-sm-8">:<?php echo $teacher_user["email"];?></div>
                                <div class="col-sm-4">Phone</div><div class="col-sm-8">:<?php echo $teacher_user["phone"];?></div>
                                <div class="col-sm-4">Address</div><div class="col-sm-8">:<?php echo $teacher_user["Address"];?></div>
                                <div class="col-sm-4">Circle</div><div class="col-sm-8">:<?php echo $teacher_user["circle_name"];?></div>
                                <div class="col-sm-4">Division</div><div class="col-sm-8">:<?php echo $teacher_user["division_name"];?></div>
                                <div class="col-sm-4">Gender</div><div class="col-sm-8">:<?php echo $teacher_user["gender"];?></div>
                                <div class="col-sm-4">DOB</div><div class="col-sm-8">:<?php echo date('d-m-Y', strtotime($teacher_user["DOB"]));?></div>
                                <div class="col-sm-4">Blood Group</div><div class="col-sm-8">:<?php echo $teacher_user["blood_group"];?></div>

                            </div>
                        </div>
                    </div>  
                    

                