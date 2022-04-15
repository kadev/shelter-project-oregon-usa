<!-- Main Footer-->
<div class="main-footer text-center">
    <div class="container">
        <div class="row row-sm">
            <div class="col-md-12">
                <span>Copyright © 2020 <a href="#">NAIA Shelter Project</a>. Designed by <a href="https://www.dodynamic.com/">DoDynamic.com</a> All rights reserved.</span>
            </div>
        </div>
    </div>
</div>
<!--End Footer-->

<!-- Sidebar -->
<div class="sidebar sidebar-right sidebar-animate">
    <div class="sidebar-icon">
        <a href="#" class="text-right float-right text-dark fs-20" data-toggle="sidebar-right" data-target=".sidebar-right"><i class="fe fe-x"></i></a>
    </div>
    <div class="sidebar-body">
        <h5>Todo</h5>
        <div class="d-flex p-3">
            <label class="ckbox"><input checked  type="checkbox"><span>Hangout With friends</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input type="checkbox"><span>Prepare for presentation</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input checked type="checkbox"><span>System Updated</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input type="checkbox"><span>Do something more</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input  type="checkbox"><span>System Updated</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top">
            <label class="ckbox"><input  type="checkbox"><span>Find an Idea</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
        <div class="d-flex p-3 border-top mb-0">
            <label class="ckbox"><input  type="checkbox"><span>Project review</span></label>
            <span class="ml-auto">
							<i class="fe fe-edit-2 text-primary mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Edit"></i>
							<i class="fe fe-trash-2 text-danger mr-2" data-toggle="tooltip" title="" data-placement="top" data-original-title="Delete"></i>
						</span>
        </div>
    </div>
</div>
<!-- End Sidebar -->

</div>
<!-- End Page -->

<!-- Back-to-top -->
<a href="#top" id="back-to-top"><i class="fe fe-arrow-up"></i></a>

<!-- Jquery js-->
<script src="<?php echo URL; ?>plugins/jquery/jquery.min.js"></script>

<!-- Bootstrap js-->
<script src="<?php echo URL; ?>plugins/bootstrap/js/popper.min.js"></script>
<script src="<?php echo URL; ?>plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- BlockUI js -->
<script src="<?php echo URL; ?>plugins/blockui/jquery.blockUI.min.js"></script>

<!-- Internal Sweet-Alert js-->
<script src="<?php echo URL; ?>plugins/sweet-alert/sweetalert.min.js"></script>
<script src="<?php echo URL; ?>plugins/sweet-alert/jquery.sweet-alert.js"></script>

<!-- Select2 js-->
<script src="<?php echo URL; ?>plugins/select2/js/select2.min.js"></script>

<?php if(isset($datatables) AND $datatables === true): ?>
    <!-- Internal Data Table js -->
    <script src="<?php echo URL; ?>plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/dataTables.responsive.min.js"></script>
<?php endif; ?>

<?php if(isset($fileexport) AND $fileexport === true): ?>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/dataTables.buttons.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/buttons.bootstrap4.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/jszip.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/pdfmake.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/vfs_fonts.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/buttons.html5.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/buttons.print.min.js"></script>
    <script src="<?php echo URL; ?>plugins/datatable/fileexport/buttons.colVis.min.js"></script>
<?php endif; ?>

<!-- Perfect-scrollbar js -->
<script src="<?php echo URL; ?>plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>

<!-- Sidemenu js -->
<script src="<?php echo URL; ?>plugins/sidemenu/sidemenu.js"></script>

<!-- Sidebar js -->
<script src="<?php echo URL; ?>plugins/sidebar/sidebar.js"></script>

<!-- Sticky js -->
<script src="<?php echo URL; ?>js/sticky.js"></script>

<!-- Custom js -->
<script src="<?php echo URL; ?>js/custom.js"></script>
<?php if(isset($custom_js)): ?>
    <?php if(is_array($custom_js)): ?>
        <?php foreach ($custom_js as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php else: ?>
        <script src="<?php echo $custom_js; ?>"></script>
    <?php endif; ?>
<?php endif; ?>

</body>
</html>