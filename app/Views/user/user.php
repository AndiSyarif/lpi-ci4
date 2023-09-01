<?= $this->extend('template/main') ?>
<?= $this->section('title') ?>
List Users
<?= $this->endSection() ?>
<?= $this->section('content') ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"><?= $this->renderSection('title') ?></h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="/">Home</a></li>
                        <li class="breadcrumb-item active">List Users</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/user/new" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                    User</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Level</th>
                                        <th>Avatar</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($user as $key => $data) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $data['name'] ?></td>
                                            <td><?= $data['email'] ?></td>
                                            <td>
                                                <?php if ($data['level'] == 1) : ?>
                                                    <span class="badge badge-info">Admin</span>
                                                <?php elseif ($data['level'] == 2) : ?>
                                                    <span class="badge badge-warning">User</span>
                                                <?php else : ?>
                                                    <!-- Handle other cases if needed -->
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <?php if (!empty($data['image'])) : ?>
                                                    <img src="<?= base_url('img/user/' . $data['image']) ?>" class="img-preview img-fluid rounded-circle" width="150px" height="150px">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/img/logo.png') ?>" class="img-preview img-fluid rounded-circle" width="150px" height="150px">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <form class="d-inline" action="/user/<?= $data['id_user'] ?>" method="GET">
                                                    <button type="submit" class="btn btn-info rounded btn-sm mr-1">
                                                        <i class="fa-solid fa-eye"></i> Detail
                                                    </button>
                                                </form>
                                                <form class="d-inline" action="/user/<?= $data['id_user'] ?>/edit" method="GET">
                                                    <button type="submit" class="btn btn-success rounded btn-sm mr-1">
                                                        <i class="fa-solid fa-pen"></i> Edit
                                                    </button>
                                                </form>
                                                <form class="d-inline" action="/user/<?= $data['id_user'] ?>" method="POST">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger rounded btn-sm" id="btn-delete"><i class="fa-solid fa-trash-can"></i> Delete
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content -->
        </div>
    </div>
</div>

<?= $this->endSection() ?>