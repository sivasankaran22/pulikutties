<!-- <img id="my-image" class="avatar" src="http://lorempixel.com/600/450/sports/1" style="width: 400px;">
<img class="avatar border-white" src="http://192.168.1.139/mykidsvan/assets/img/default_user.png" alt="..." >
<img id="my-image" class="avatar" src="http://192.168.1.139/mykidsvan/assets/img/default_user.png" style="width: 400px;"> -->
    <!--   Core JS Files   -->
    <script type="text/javascript" src="<?php echo base_url(SCRIPTS); ?>/js/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="<?php echo base_url(SCRIPTS); ?>/js/image-tooltip.js"></script>
    <script type="text/javascript" src="<?php echo base_url(SCRIPTS); ?>/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(SCRIPTS); ?>/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(SCRIPTS); ?>/js/additional-methods.js"></script>
    <script src="<?php echo base_url(SCRIPTS); ?>/js/moment-with-locales.js"></script>
    <script src="<?php echo base_url(SCRIPTS); ?>/js/bootstrap-datetimepicker.js"></script>
    <script src="<?php echo base_url(SCRIPTS); ?>/js/jquery.datatables.js"></script>

    <!--  Checkbox, Radio & Switch Plugins -->
    <script src="<?php echo base_url(SCRIPTS); ?>/js/bootstrap-checkbox-radio.js"></script>

    <!--  Charts Plugin -->
    <script src="<?php echo base_url(SCRIPTS); ?>/js/chartist.min.js"></script>

    <!--  Notifications Plugin    -->
    <script src="<?php echo base_url(SCRIPTS); ?>/js/bootstrap-notify.js"></script>

    

    <!-- Paper Dashboard Core javascript and methods for Demo purpose -->
    <script src="<?php echo base_url(SCRIPTS); ?>/js/paper-dashboard.js"></script>

    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="<?php echo base_url(SCRIPTS); ?>/js/demo.js"></script>
    <script src="<?php echo base_url(SCRIPTS); ?>/js/chosen.jquery.min.js"></script>

    


    <script type="text/javascript">
    
    var sidebarclass = $('.sidebarclass').val();

    if(sidebarclass === 'report'){
       
        var subsidebarclass = $('.subsidebarclass').val();
    //$('li.active').removeClass('active');
    $('.feef.'+subsidebarclass).addClass('active');
    $('li.'+sidebarclass).addClass('active'); 
    $('.grgrgrgrrg').addClass('in');  
    }else{
        $('.grgrgrgrrg').removeClass('in');  
        var sidebarclass = $('.sidebarclass').val();
        $('li.active').removeClass('active');
        $('li.'+sidebarclass).addClass('active'); 
    }
    </script>



    <script type="text/javascript">
        $(document).ready(function(){

            //$('.avatar').imageTooltip();

            <?php if($this->session->flashdata('loginsuccessmessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-up',
                message: "<b>Login Success..</b>"

            },{
                type: 'success',
                timer: 4000
            });

            <?php } ?>

            <?php if($this->session->flashdata('insertsuccessmessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-up',
                message: "<b>Inserted Successfully..</b>"

            },{
                type: 'success',
                timer: 4000
            });

            <?php } ?>


            <?php if($this->session->flashdata('insertfailuremessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-down',
                message: "<b>Inserted Failure..</b>"

            },{
                type: 'danger',
                timer: 4000
            });

            <?php } ?>


            <?php if($this->session->flashdata('updatefailuremessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-down',
                message: "<b>Update Failure..</b>"

            },{
                type: 'danger',
                timer: 4000
            });

            <?php } ?>

            <?php if($this->session->flashdata('updatesuccessmessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-up',
                message: "<b>Update Success..</b>"

            },{
                type: 'success',
                timer: 4000
            });

            <?php } ?>

            <?php if($this->session->flashdata('deletesuccessmessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-up',
                message: "<b>Deleted Successfully..</b>"

            },{
                type: 'success',
                timer: 4000
            });

            <?php } ?>

            <?php if($this->session->flashdata('deletefailuremessage') != ''){ ?>
            $.notify({
                icon: 'ti-thumb-down',
                message: "<b>Request Failure..</b>"

            },{
                type: 'danger',
                timer: 4000
            });

            <?php } ?>

            
        });
    </script>


    <!-- Tag my kid Modal -->
<div id="tagmykid" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Tag My Kid To Others</h4>
      </div>
      <div class="modal-body currentparent_id" rel="<?php echo $kiddata[0]['parent_id']; ?>">
        <input type="hidden" value="<?php echo $userdata[0]['id']; ?>" class="currentkidid">
        <input type="text" class="form-control border-input parent_mobile_number required" id="parentmobile" onkeypress='return( event.charCode >= 48 && event.charCode <= 57) || (event.charCode == 8) || (event.charCode <= 10) || (event.charCode==94)' minlength="10" maxlength="10" pattern="[0-9]{10}" autocomplete="off" required name="parent_mobile_number" placeholder="Please Enter Other parent Mobile Number" value="">
        <div id="parentsuggesstion-box"></div>
        <input type="text" class="form-control border-input required tag_parent_id" disabled required name="tag_parent_id" placeholder="Tag Parent id" value="">
        <input type="text" class="form-control border-input required tag_parent_name" disabled required name="tag_parent_name" placeholder="Tag Parent Name" value=""><br>
        <button type="button" class="btn btn-default choooseparent" disabled>Tag to parent</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<script type="text/javascript">


    $(document).ready(function(){
$("#parentmobile").keyup(function(){
        $(".tag_parent_id").val("");
        $(".tag_parent_name").val("");
    });


    })
$(".parent_mobile_number").keyup(function(){
    var parent_id = $('.currentparent_id').attr('rel');
        $.ajax({
        type: "POST",
        url: "<?php echo site_url('user/getparenttotag');?>",
        data:'keyword='+$(this).val()+"&parent_id="+parent_id,
        beforeSend: function(){
            $("#search-box").css("background","#FFF no-repeat 165px");
        },
        success: function(data){
            $("#parentsuggesstion-box").show();
            $("#parentsuggesstion-box").html(data);
            $("#search-box").css("background","#FFF");
        }
        });
    });


$(".choooseparent").click(function(){
    var kid_id = $('.currentkidid').val();
    var tag_parent_id = $('.tag_parent_id').val();

    if(tag_parent_id!=""){
        $.ajax({
        type: "POST",
        url: "<?php echo site_url('user/tagakid');?>",
        data:'kid_id='+kid_id+"&tag_parent_id="+tag_parent_id,
        success: function (response) { 
                if(response == '1'){
                $.notify({
                icon: 'ti-thumb-up',
                message: "<b>kid tagged Successfully..</b>"
                },{
                    type: 'success',
                    timer: 4000
                });
                }else{
                 $.notify({
                icon: 'ti-thumb-down',
                message: "<b>Tagging Failure [or] Already tagged with that person..</b>"
                },{
                    type: 'danger',
                    timer: 4000
                });
                }

            }
        });
    }else{

            $.notify({
                icon: 'ti-thumb-down',
                message: "<b>Please enter details..</b>"
                },{
                    type: 'danger',
                    timer: 4000
                });

    }
    });


</script>
<div id="forgotpassword" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title text-center">Forgot Password</h4>
      </div>
      <div class="modal-body currentparent_id" rel="">
       
        <input type="text" class="form-control border-input required email_id" required name="parent_mobile_number" placeholder="Email or Mobile No." value=""><br>
        
        <button type="button" class="btn btn-default sendmail">Send mail</button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<input type="hidden" class="urlid" value="<?php echo $this->uri->segment(3); ?>">
        <input type="hidden" id="forgottime" value="">
<script type="text/javascript">
    

    $(".sendmail").click(function(){
    var email_id = $('.email_id').val();
    if(email_id == ''){
    $.notify({
            icon: 'ti-thumb-down',
            message: "<b>Enter valid email or mobile number. Field should not be empty</b>"
            },{
                type: 'danger',
                timer: 4000
            });
    }else{
        $.ajax({
        type: "POST",
        url: "<?php echo site_url('user/checkuserexists');?>",
        data:'email_id='+email_id,
        success: function (response) { 
           if(response == 'SUCCESS'){
                $.notify({
                icon: 'ti-thumb-up',
                message: "<b>Email sent Successfully..</b>"
                },{
                    type: 'success',
                    timer: 4000
                });
                }else{
                 $.notify({
                icon: 'ti-thumb-down',
                
                message: "<b>Enter valid email or mobile no.</b>"
                },{
                    type: 'danger',
                    timer: 4000
                });
                }

            }
        });
    }
    });
</script>




<script>
// Get the modal
var modal = document.getElementById('avatarmodal');

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementsByClassName("avatar");
for (var i =0; img.length > i; i++) {
    var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img[i].onclick = function(){
   // alert('yes');
    modal.style.display = "block";
    modalImg.src = this.src;
    captionText.innerHTML = this.alt;
}
};

//console.log(img);
//alert(img.length);


// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
var spans = document.getElementsByClassName("avatarmodalclass")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
    modal.style.display = "none";
}
spans.onclick = function() { 
    modal.style.display = "none";
}
</script>