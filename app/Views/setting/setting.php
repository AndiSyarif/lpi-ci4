<?= $this->extend('template/main') ?>
<?= $this->section('title') ?>
Setting User
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
                        <li class="breadcrumb-item active">Setting User</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12 box-col-12">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true"><i class="fa-solid fa-user"></i> Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false"><i class="fa-solid fa-lock"></i> Security</a>
                            </li>
                        </ul>

                    </div>
                </div>
            </div>

            <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form class="needs-validation" novalidate action="/setting/<?= $user['id_user'] ?>" method="POST" enctype="multipart/form-data">
                                        <!-- Form -->
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="col-form-label pt-0" for="name">Name</label>
                                                    <input class="form-control <?= isset($validation) && $validation->hasError('name') ? 'is-invalid' : '' ?>" id="name" name="name" type="text" placeholder="Full Name" value="<?= old('name', $user['name']) ?>" required>
                                                    <?php if (isset($validation) && $validation->hasError('name')) : ?>
                                                        <div class="invalid-feedback"><?= esc($validation->getError('name')) ?></div>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="col-form-label pt-0" for="email">Email</label>
                                                    <input class="form-control" id="email" name="email" type="email" placeholder="Email" value="<?= old('email', $user['email']) ?>" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="image" class="col-form-label pt-0">Avatar</label>
                                                    <input type="hidden" name="oldImage" value="<?= $user['image'] ?>">
                                                    <?php if ($user['image']) : ?>
                                                        <div id="img-prev">
                                                            <img src="<?= base_url('img/user/' . $user['image']) ?>" class="img-preview img-fluid rounded" width="200px" height="200px">
                                                        </div>
                                                    <?php else : ?>
                                                        <div id="img-prev">
                                                            <img src="assets/img/logo.png" class="img-preview img-fluid rounded" width="200px" height="200px">
                                                        </div>
                                                    <?php endif; ?>
                                                    <input type="file" class="form-control <?= isset($validation) && $validation->hasError('image') ? 'is-invalid' : '' ?> mt-2" name="image" id="image" aria-label="Section 3" onchange="previewImage()">
                                                    <?php if (isset($validation) && $validation->hasError('image')) : ?>
                                                        <div class="invalid-feedback"><?= esc($validation->getError('image')) ?></div>
                                                    <?php else : ?>
                                                        <span class="invalid-feedback text-danger">Please upload a valid image</span>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <form id="changePasswordForm" class="theme-form needs-validation" novalidate action="/setting/security/<?= $user['id_user'] ?>" method="POST">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="PUT">
                                        <div class="row mb-4">
                                            <label for="oldpassword" class="col-sm-3 col-form-label form-label">Current password <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="Current password"></i></label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control <?= session('errors.oldpassword') ? 'is-invalid' : '' ?>" name="oldpassword" id="oldpassword" placeholder="Current password" aria-label="Current password" minlength="6" required>
                                                <?php if (session('errors.oldpassword')) : ?>
                                                    <span class="invalid-feedback text-danger"><?= session('errors.oldpassword') ?></span>
                                                <?php else : ?>
                                                    <span class="invalid-feedback text-danger">Please input a valid password</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="password" class="col-sm-3 col-form-label form-label">New password <i class="bi-question-circle text-body ms-1" data-bs-toggle="tooltip" data-bs-placement="top" title="New password"></i></label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control <?= session('errors.password') ? 'is-invalid' : '' ?>" name="password" id="password" placeholder="New password" aria-label="New password" minlength="6" required>
                                                <?php if (session('errors.password')) : ?>
                                                    <span class="invalid-feedback text-danger"><?= session('errors.password') ?></span>
                                                <?php else : ?>
                                                    <span class="invalid-feedback text-danger">Please input a valid password</span>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <label for="password_confirmation" class="col-sm-3 col-form-label form-label">Confirm new password <i class="bi-question-circle text-body" data-bs-toggle="tooltip" data-bs-placement="top" title="Confirm new password"></i></label>
                                            <div class="col-sm-9">
                                                <div class="mb-3">
                                                    <input type="password" class="form-control <?= session('errors.password_confirmation') ? 'is-invalid' : '' ?>" name="password_confirmation" id="password_confirmation" placeholder="Confirm new password" aria-label="Konfirmasi password terbaru" minlength="6" required>
                                                    <?php if (session('errors.password_confirmation')) : ?>
                                                        <span class="invalid-feedback text-danger"><?= session('errors.password_confirmation') ?></span>
                                                    <?php else : ?>
                                                        <span class="invalid-feedback text-danger">Please input a valid password</span>
                                                    <?php endif; ?>
                                                </div>
                                                <h6>Password Requirements:</h6>
                                                <p>Ensure that the following requirements are met:</p>
                                                <br>
                                                <ul>
                                                    <li>Minimum of 6 characters - the more, the better</li>
                                                    <li>At least one lowercase letter</li>
                                                    <li>At least one uppercase letter</li>
                                                    <li>At least one digit, symbol, or space character</li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="/assets/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        // Activate the desired tab based on the URL parameter
        var urlParams = new URLSearchParams(window.location.search);
        var tabName = urlParams.get('tab');

        if (tabName) {
            $('#custom-content-below-tab a[data-toggle="pill"][href="#custom-content-below-' + tabName + '"]').tab('show');
        }

        // Adjust the DataTable columns and responsiveness when a tab is shown
        $('a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
            // Adjust DataTable columns and responsiveness here
        });
    });
</script>



<?= $this->endSection() ?>