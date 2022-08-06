
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

                    <div class="row">
                        <div class="col-lg">

                        <?php if(validation_errors()) : ?>
                            <div class="alert alert-danger" role="alert">
                                <?= validation_errors(); ?>
                            </div>
                        <?php endif; ?>

                        <a href="" class="btn btn-primary mb-4" data-toggle="modal" data-target="#newSubMenuModal">Add New Submenu</a>

                        <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Title</th>
                                <th scope="col">Menu</th>
                                <th scope="col">URL</th>
                                <th scope="col">Icon</th>
                                <th scope="col">Active</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($subMenu as $sm) : ?>
                            <tr>
                                <th scope="row"><?= $i ; ?></th>
                                <td><?= $sm['title']; ?> </td>
                                <td><?= $sm['menu']; ?> </td>
                                <td><?= $sm['url']; ?> </td>
                                <td><?= $sm['icon']; ?> </td>
                                <td><?= $sm['is_active']; ?> </td>
                                <td>
                                    <a href ="" class="badge badge-success">edit</a>
                                    <a href ="" class="badge badge-danger">delete</a>
                                </td>
                            </tr>
                            <?php $i++ ; ?>
                            <?php endforeach; ?>
                        </tbody>
                        </table>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<!-- Modal -->

<!-- Modal -->
<div class="modal fade" id="newSubMenuModal" tabindex="-1" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="newSubMenuModalLabel">Add New SubMenu</h5>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="<?= base_url('menu/submenu'); ?>" method="post">
      <div class="modal-body">

        <div class="form-group">
            <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
            <input type="text" class="form-control" id="title" name="title" placeholder="Submenu Title">
        </div>
        <div class="form-group">
            <select name="menu_id" id="menu_id" class="form-control">
                <option value="">Select Menu</option>
                <?php foreach ($menu as $m) : ?>
                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
            <input type="text" class="form-control" id="url" name="url" placeholder="Submenu URL">
        </div>
        <div class="form-group">
            <!-- <label for="exampleInputPassword1" class="form-label">Password</label> -->
            <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu Icon">
        </div>
        <div class="form-group">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                <label class="form-check-label" for="is_active">Aktifkan Menu</label>
            </div> 
        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Add</button>
      </div>

      </form>
    </div>
  </div>
</div>