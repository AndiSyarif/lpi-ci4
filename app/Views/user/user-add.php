<?= $this->extend('template/main') ?>
<?= $this->section('title') ?>
Add User
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
                        <li class="breadcrumb-item"><a href="/user">Users</a></li>
                        <li class="breadcrumb-item active">Add User</li>
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
                                <a href="/user" class="btn btn-warning btn-sm"><i class="fa-solid fa-arrow-rotate-left"></i>
                                    Back
                                </a>
                            </div>
                        </div>
                        <form class="needs-validation" novalidate action="/user" method="POST" enctype="multipart/form-data">
                            <?= csrf_field() ?>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="name">Full Name</label>
                                            <input type="text" name="name" class="form-control <?= session('errors.name') ? 'is-invalid' : '' ?>" id="name" placeholder="Full Name" value="<?= old('name') ?>" required>
                                            <?php if (session('errors.name')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.name') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" name="email" class="form-control <?= session('errors.email') ? 'is-invalid' : '' ?>" id="email" placeholder="Email" value="<?= old('email') ?>" required>
                                            <?php if (session('errors.email')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.email') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Password</label>
                                            <input type="password" name="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" id="password" placeholder="Password" value="<?= old('password') ?>" required>
                                            <?php if (session('errors.password')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.password') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="level">Level</label>
                                            <select class="form-control <?= session('errors.level') ? 'is-invalid' : '' ?>" name="level" id="level" required>
                                                <option value="">Select Level</option>
                                                <option value="1" <?= old('level') == '1' ? 'selected' : '' ?>>Admin</option>
                                                <option value="2" <?= old('level') == '2' ? 'selected' : '' ?>>User</option>
                                            </select>
                                            <?php if (session('errors.level')) : ?>
                                                <span class="invalid-feedback text-danger"><?= session('errors.level') ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="image" class="text-label">Image</label>
                                            <div id="img-prev">
                                                <img class="img-preview img-fluid" width="200px" height="200px">
                                            </div>
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