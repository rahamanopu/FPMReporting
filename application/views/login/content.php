<div class="padding-15">
    <div class="login-box">
        <!-- login form -->
        <form action="<?php echo base_url(); ?>authenticate/login" method="post" class="sky-form boxed">
            <header><i class="fa fa-users"></i> <?php echo $this->config->item('softwarename'); ?> - Sign In</header>
            <?php if (!empty($this->session->flashdata('msg'))) { ?>
                <div class="alert alert-danger noborder text-center weight-400 nomargin noradius">
                    <?php echo $this->session->flashdata('msg'); ?>
                </div>
            <?php } ?>
            <fieldset>
                <section>
                    <label class="label">User ID</label>
                    <label class="input">
                        <i class="icon-append fa fa-envelope"></i>
                        <input type="text" name="empcode" id="empcode" value="">
                        <span class="tooltip tooltip-top-right">Type your user id</span>
                    </label>
                </section>
                <section>
                    <label class="label">Password</label>
                    <label class="input">
                        <i class="icon-append fa fa-lock"></i>
                        <input type="password" name="password" id="password" value="">
                        <b class="tooltip tooltip-top-right">Type your Password</b>
                    </label>
                </section>
            </fieldset>
            <footer>
                <button type="submit" class="btn btn-primary pull-right">Sign In</button>
            </footer>
        </form>
        <!-- /login form -->
    </div>
</div>