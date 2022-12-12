<!DOCTYPE html>
<html lang="en">
<head>
    <?php echo $head; ?>
</head>

<body sarah-navigation-type="vertical" sarah-nav-placement="left" theme-layout="wide-layout" theme-bg="bg1" >
    <div id="sarahapp-wrapper" class="sarah-hide-lpanel" sarah-device-type="desktop">
        <?php echo $header; ?>
        <div id="sarahapp-container" sarah-color-type="lpanel-bg2" sarah-lpanel-effect="shrink">
            <?php echo $menu; ?>   			
			<!-- Section  -->
            <?php echo $content; ?>			
        </div>
    </div>

    <div class="modal fade" id="imagePopupButtonModal" tabindex="-1" role="dialog" aria-labelledby="imageShowModalLabel">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <img id="imageShow" src="" class="img-responsive" alt="image">
                </div>
                <div class="clearfix"></div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <?php echo $footer; ?>	
</body>
</html>
