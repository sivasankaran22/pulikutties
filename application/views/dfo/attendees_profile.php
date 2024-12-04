                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Attendes Details</h1>
                        
                    </div>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12 text-center"><img src="<?php echo base_url('').$attend_detail["chd_photo"] ?>" width="150" height="auto"></div>
                                <div class="col-sm-4">Child Name</div><div class="col-sm-8">:<?php echo $attend_detail["full_name"];?></div>
                                <div class="col-sm-4">Parent Name</div><div class="col-sm-8">:<?php echo $attend_detail["p_f_name"].' '.$attend_detail['p_l_name'];?></div>
                                <div class="col-sm-4">Teacher Name</div><div class="col-sm-8">:<?php echo $attend_detail["t_f_name"].' '.$attend_detail['t_l_name'];?></div>
                                <hr>
                                <div class="col-sm-4">Section Title</div><div class="col-sm-8">:<?php echo $attend_detail["title"];?></div>
                                <div class="col-sm-4">Section Start Date & Time</div><div class="col-sm-8">:<?php echo $attend_detail["start_datetime"];?></div>
                                <div class="col-sm-4">Section End Date & Time</div><div class="col-sm-8">:<?php echo $attend_detail["end_datetime"];?></div>
                                <div class="col-sm-4">Section Description</div><div class="col-sm-8">:<?php echo $attend_detail["description"];?></div>
                                <div class="col-sm-4">Section Completed Document</div>
                                                                                    <div class="col-sm-8">
                                                                                        :<?php
                                                                                        // Convert JSON string to PHP array
                                                                                        $imageArray = json_decode($attend_detail["section_details"], true);

                                                                                        // Base path for the images
                                                                                        $imagePath = base_url('assets/img/sections/');

                                                                                        // Print each image with its path, wrapped in a link to open in a new tab
                                                                                        foreach ($imageArray as $image) {
                                                                                            // Create a link to open the image in a new tab
                                                                                            echo '<a href="' . $imagePath . $image . '" target="_blank">';
                                                                                            echo '<img src="' . $imagePath . $image . '" alt="' . $image . '" style="width:150px; height:auto; margin:5px;">';
                                                                                            echo '</a>';
                                                                                        }
                                                                                        ?>
                                                                                    </div>


                            </div>
                        </div>
                    </div>  
                    

                