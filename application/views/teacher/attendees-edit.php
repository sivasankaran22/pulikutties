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
                                <h1 class="h4 text-gray-900 mb-4">Attendees</h1>
                            </div>
                            <form class="user" id="registerForm" enctype="multipart/form-data">
                                <div class="form-group row">    
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" id="section_id" name="section_id">
                                            <option value="">-- Select Section --</option>
                                            <?php foreach ($section as $list): ?>
                                                <?php $selected = ($list["id"] == $attendees["section_id"]) ? "selected" : ""; ?>
                                                <option value="<?= $list["id"] ?>" <?=$selected?>><?= $list["title"] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <select class="form-control" id="child_id" name="child_id">
                                            <option value="">-- Select Child --</option>
                                            <?php foreach ($all_child as $value): ?>
                                                <?php $selected = ($value["child_id"] == $attendees["child_id"]) ? "selected" : ""; ?>
                                                <option value="<?php echo $value["child_id"] ?>" data-parent="<?=$value['parent_id']?>" <?=$selected?>><?php echo $value["full_name"]." (".$value["first_name"]." ".$value["last_name"].")"; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <!-- Multiple file input for images -->
                                        <input type="file" class="form-control" name="section_details[]" id="section_details" placeholder="profile photo" multiple>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <!-- Preview container for existing images -->
                                        <div id="preview-container" class="row">
                                            <?php
                                            // Existing images array
                                            $existingImages = json_decode($attendees["section_details"], true);

                                            // Base path for images
                                            $imagePath = base_url('assets/img/sections/');

                                            // Loop through existing images and display them with delete button
                                            if (!empty($existingImages)) {
                                                foreach ($existingImages as $image) {
                                                    echo '<div class="col-sm-4 image-preview" id="image-' . $image . '">';
                                                    echo '<img src="' . $imagePath . $image . '" alt="' . $image . '" style="width:150px; height:auto; margin:5px;">';
                                                    echo '<button type="button" class="btn btn-danger btn-sm remove-image" data-image="' . $image . '" style="position: absolute; top: 5px; right: 5px;">Remove</button>';
                                                    echo '</div>';
                                                }
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>

                                <input type="hidden" name="dfo_id" value="<?=$dfo_id?>" />
                                <input type="hidden" id="parent_id" name="parent_id" value="<?=$attendees["parent_id"]?>">
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
