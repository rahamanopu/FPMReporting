<style type="text/css">
    .h4, h4{
        font-size: 14px;
    }
</style>
<?php
$usertype = $this->session->userdata('UserType');
?>
<section id="main-content">

<?php //if($usertype != 'F'){ ?>
<!-- page title -->
<div class="content-title" style="background-color: #626263;">
    <h3 class="main-title" style=" color: white;">Dasahboard</h3>
</div>

<div id="content" class="dashboard padding-20">
    <!-- BOXES -->
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <h4>Dashboard Data goes here</h4>
        </div>        
    </div>
    <?php if(file_exists("uploads/apk/TSI.apk")) {
        echo  "<span class='badge' style='margin-right:20px'>APK File: </span><a href='".base_url()."/uploads/apk/TSI.apk'>Download app</a>";
    }?>
   
</div>

    

</section>
 