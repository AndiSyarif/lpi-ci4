<?= $this->extend('template/main') ?>
<?= $this->section('title') ?>
Edit Employee
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
                        <li class="breadcrumb-item"><a href="/employee">Employee</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="text-right">
                                <a href="/employee" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/employee/<?= $employee['id_employee'] ?>" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <input type="hidden" name="_method" value="PUT">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="number" name="id" class="form-control <?= session('errors.id') ? 'is-invalid' : '' ?>" id="id" placeholder="ID Employee" value="<?= old('id', $employee['id']) ?>" required>
                                            <?php if (session('errors.id')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.id') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" placeholder="Full Name" value="<?= old('name', $employee['name']) ?>" required>
                                            <?php if (session('errors.name')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.name') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="phone">Phone</label>
                                            <input type="number" name="phone" class="form-control <?= session('errors.phone') ? 'is-invalid' : '' ?>" id="phone" placeholder="Phone" value="<?= old('phone', $employee['phone']) ?>" required>
                                            <?php if (session('errors.phone')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.phone') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="position">Position</label>
                                            <input type="text" name="position" class="form-control <?= session('errors.position') ? 'is-invalid' : '' ?>" id="position" placeholder="Position" value="<?= old('position', $employee['position']) ?>" required>
                                            <?php if (session('errors.position')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.position') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="join_date">Join Date</label>
                                            <input type="date" name="join_date" class="form-control <?= session('errors.join_date') ? 'is-invalid' : '' ?>" id="join_date" placeholder="Join Date" value="<?= old('join_date', $employee['join_date']) ?>" required>
                                            <?php if (session('errors.join_date')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.join_date') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="salary">Salary</label>
                                            <input type="number" name="salary" class="form-control <?= session('errors.salary') ? 'is-invalid' : '' ?>" id="salary" placeholder="Salary" value="<?= old('salary', $employee['salary']) ?>" required>
                                            <?php if (session('errors.salary')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.salary') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" id="address" class="form-control <?= session('errors.address') ? 'is-invalid' : '' ?>" cols="100%" rows="5" required><?= old('address', $employee['address']) ?></textarea>
                                            <?php if (session('errors.address')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.address') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image">Image</label>
                                            <input type="hidden" name="oldImage" value="<?= $employee['image'] ?>">
                                            <?php if (!empty($employee['image'])) : ?>
                                                <div id="img-prev">
                                                    <img src="<?= base_url('img/employee/' . $employee['image']) ?>" class="img-preview img-fluid rounded" width="200px" height="200px">
                                                </div>
                                            <?php else : ?>
                                                <div id="img-prev">
                                                    <img src="<?= base_url('assets/img/logo.png') ?>" class="img-preview img-fluid rounded" width="200px" height="200px">
                                                </div>
                                            <?php endif; ?>
                                            <input type="file" class="form-control <?= session('errors.image') ? 'is-invalid' : '' ?>" name="image" id="image" onchange="previewImage()">
                                            <?php if (session('errors.image')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.image') ?></span>
                                            <?php else : ?>
                                                <span class="invalid-feedback">Please upload a valid image</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-dark mr-1" type="reset"><i class="fa-solid fa-arrows-rotate"></i>
                                    Reset</button>
                                <button class="btn btn-success" type="submit"><i class="fa-solid fa-floppy-disk"></i>
                                    Save</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.content -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>