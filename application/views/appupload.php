<section id="main-content">
    <!-- page title -->
    <div class="content-title">
        <h3 class="main-title">APP Upload</h3>
    </div>
    <?php
    echo getFlashMsg();
    ?>
    <div id="content" class="dashboard">
        <div class="row col-md-8 col-md-offset-2">
            <div id="panel-1" class="panel panel-default">
                <div class="panel-body">

                    <?php if ($this->session->userdata('apk_file_path')){
                        echo "New APP : <b>". $this->session->userdata('apk_file_path')."</b><br><br>";
                    } ?>

                    <?php echo form_open_multipart('submit-app-upload'); ?>

                    <input type="file" class="form-control" name="userfile" size="20" />

                    <br />

                    <input type="submit" class="btn btn-danger" value="upload" />

                    </form>

                </div>
            </div>
        </div>
    </div>



</section>