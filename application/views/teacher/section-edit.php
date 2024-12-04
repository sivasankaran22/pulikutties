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
                                            <h1 class="h4 text-gray-900 mb-4">Section</h1>
                                        </div>
                                        <form class="user" id="registerForm"  enctype="multipart/form-data">
                                        <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="text" class="form-control" id="exampleFirstName"
                                                    placeholder="Title" name="title" value="<?=$section_data["title"]?>" required>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-12 mb-3 mb-sm-0">
                                                    <textarea class="form-control" id="description" name="description"
                                                    placeholder="Description" ><?=$section_data["description"]?></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="datetime-local" class="form-control" id="start_datetime" name="start_datetime"
                                                    placeholder="start datetime"  value="<?=$section_data["start_datetime"]?>">
                                                </div>
                                                <div class="col-sm-6 mb-3 mb-sm-0">
                                                <input type="datetime-local" class="form-control" id="end_datetime" name="end_datetime"
                                                    placeholder="end datetime"  value="<?=$section_data["end_datetime"]?>">
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

                                    