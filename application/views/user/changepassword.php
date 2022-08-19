
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Change Password</h1>

    <div class="row">
        <div class="col-lg-6">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('user/changepassword'); ?>" method="post">
                <div class="mb-3">
                    <label for="currentpassword" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="currentpassword" name="currentpassword">
                    <?= form_error('currentpassword','<small class="text-danger pl-3">','</small>') ?>
                </div>
                <div class="mb-3">
                    <label for="newpassword1" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="newpassword1" name="newpassword1">
                    <?= form_error('newpassword1','<small class="text-danger pl-3">','</small>') ?>
                </div>
                <div class="mb-3">
                    <label for="newpassword2" class="form-label">Re-Type New Password</label>
                    <input type="password" class="form-control" id="newpassword2" name="newpassword2">
                    <?= form_error('newpassword2','<small class="text-danger pl-3">','</small>') ?>
                </div>
                <div class="form-group mt-4">
                    <button type="submit" class="btn btn-primary">Change Passsword</button>
                </div>
            </form>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->