<?= $this->extend('template/main') ?>
<?= $this->section('title') ?>
List Employee
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
                        <li class="breadcrumb-item active">List Employee</li>
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
                                <a href="/employee/new" class="btn btn-primary"><i class="fa-solid fa-plus"></i> Add
                                    Employee</a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-striped table-bordered table-hover text-center" style="width: 100%">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Phone</th>
                                        <th>Position</th>
                                        <th>Join Date</th>
                                        <th>Salary</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($employee as $key => $data) : ?>
                                        <tr>
                                            <td><?= $key + 1 ?></td>
                                            <td><?= $data['id'] ?></td>
                                            <td><?= $data['name'] ?></td>
                                            <td><?= $data['phone'] ?></td>
                                            <td><?= $data['position'] ?></td>
                                            <td><?= date('d F Y', strtotime($data['join_date'])) ?></td>
                                            <td>Rp. <?= number_format($data['salary'], 0, ',', '.') ?></td>
                                            <td>
                                                <?php if (!empty($data['image'])) : ?>
                                                    <img src="<?= base_url('img/employee/' . $data['image']) ?>" class="img-preview img-fluid rounded-circle" width="150px" height="150px">
                                                <?php else : ?>
                                                    <img src="<?= base_url('assets/img/logo.png') ?>" class="img-preview img-fluid rounded-circle" width="150px" height="150px">
                                                <?php endif; ?>
                                            </td>
                                            <td>
                                                <form class="d-inline" action="/employee/<?= $data['id_employee'] ?>" method="GET">
                                                    <button type="submit" class="btn btn-info rounded btn-sm mr-1">
                                                        <i class="fa-solid fa-eye"></i>
                                                    </button>
                                                </form>
                                                <form class="d-inline" action="/employee/<?= $data['id_employee'] ?>/edit" method="GET">
                                                    <button type="submit" class="btn btn-success rounded btn-sm mr-1">
                                                        <i class="fa-solid fa-pen"></i>
                                                    </button>
                                                </form>
                                                <form class="d-inline" action="/employee/<?= $data['id_employee'] ?>" method="POST">
                                                    <?= csrf_field() ?>
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit" class="btn btn-danger rounded btn-sm" id="btn-delete"><i class="fa-solid fa-trash-can"></i>
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