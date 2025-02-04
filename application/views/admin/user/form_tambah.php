<!-- page content -->

<div class="right_col" role="main">
    <div class="container">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manajemen User</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manajemen User</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Form Tambah User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="row px-xl-3 pt-3">
                                    <div class="col-lg-7 mb-5">
                                        <div class="contact-form">
                                            <form name="sentMessage" method="post" action="<?php echo site_url('admin_user/save'); ?>">
                                                <?php if ($this->session->flashdata('error_name')) : ?>
                                                    <div class="pb-0 pt-3 alert alert-danger alert-dismissible text-whitesmoke">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?php echo $this->session->flashdata('error_name'); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="name" class="font-weight-bold">Nama</label>
                                                    <input type="text" id="name" name="name" class="form-control" placeholder="Masukkan Nama">
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                                <?php if ($this->session->flashdata('error_userName')) : ?>
                                                    <div class="pb-0 pt-3 alert alert-danger alert-dismissible text-whitesmoke">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?php echo $this->session->flashdata('error_userName'); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="userName" class="font-weight-bold">Username</label>
                                                    <input type="email" id="userName" name="userName" class="form-control" placeholder="Masukkan Username">
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                                <?php if ($this->session->flashdata('error_password')) : ?>
                                                    <div class="pb-0 pt-3 alert alert-danger alert-dismissible text-whitesmoke">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?php echo $this->session->flashdata('error_password'); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="password" class="font-weight-bold">Password</label>
                                                    <input type="password" id="password" name="password" class="form-control" placeholder="Masukkan Password">
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                                <?php if ($this->session->flashdata('error_alamat')) : ?>
                                                    <div class="pb-0 pt-3 alert alert-danger alert-dismissible text-whitesmoke">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?php echo $this->session->flashdata('error_alamat'); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="alamat" class="font-weight-bold">Alamat</label>
                                                    <textarea id="alamat" name="alamat" class="form-control"></textarea>
                                                </div>
                                                <?php if ($this->session->flashdata('error_statusAktif')) : ?>
                                                    <div class="pb-0 pt-3 alert alert-danger alert-dismissible text-whitesmoke">
                                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                        <strong><?php echo $this->session->flashdata('error_statusAktif'); ?></strong>
                                                    </div>
                                                <?php endif; ?>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="statusAktif" class="font-weight-bold">Status Aktif</label>
                                                    <select class="form-control" name="statusAktif">
                                                        <option disabled selected>Pilih status aktif</option>
                                                        <option value="Y">Aktif</option>
                                                        <option value="N">Tidak Aktif</option>
                                                    </select>
                                                </div>
                                                
                                                <button class="btn btn-primary py-2 px-4 mx-1" type="submit" id="sendMessageButton">Simpan</button>
                                        </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
                <!-- /.row -->
        </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
</div>
<!-- /page content -->