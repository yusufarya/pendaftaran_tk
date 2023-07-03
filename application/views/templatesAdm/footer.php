<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; TK AMALIA KAB> BANDUNG <?php echo date('Y') ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingin Logout?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Pilih 'Logout' untuk keluar.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="<?php echo base_url('logoutAdmin') ?>">Logout</a>
            </div>
        </div>
    </div>
</div>

<script>
    var random = Math.random();
    // function target_popup(form, popupWindow = 'formpopup'){
    function target_popup(form, popupWindow = random) { // biar bisa multi window
        window.open('', popupWindow, 'width=800,height=600,resizeable,scrollbars');
        form.target = popupWindow;
    }
</script>