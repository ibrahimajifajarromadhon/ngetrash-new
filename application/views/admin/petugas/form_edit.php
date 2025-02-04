<!-- page content -->

<div class="right_col" role="main">
    <div class="container">
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Manajemen Petugas</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Manajemen Petugas</li>
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
                                    <h3 class="card-title">Form Edit Petugas</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="row px-xl-3 pt-3">
                                    <div class="col-lg-7 mb-5">
                                        <div class="contact-form">
                                            <form name="sentMessage" method="post" action="<?php echo site_url('admin_petugas/edit'); ?>">
                                                <input type="hidden" name="id" value="<?php echo $petugas->idPetugas; ?>">
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="name" class="font-weight-bold">Nama</label>
                                                    <input id="name" name="name" class="form-control" value="<?php echo $petugas->name; ?>">
                                                    <p class="help-block text-danger"></p>
                                                </div>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="userName" class="font-weight-bold">Username</label>
                                                    <input type="email" name="userName" class="form-control" value="<?php echo $petugas->userName; ?>">
                                                </div>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="password" class="font-weight-bold">Password</label>
                                                    <input type="password" name="password" class="form-control" placeholder="********">
                                                </div>
                                                <div class="control-group mb-3 mx-1">
                                                    <label id="statusAktif" class="font-weight-bold">Status Aktif</label>
                                                    <select class="form-control" name="statusAktif">
                                                        <option disabled selected>Pilih status aktif</option>
                                                        <option value="Y" <?= ($petugas->statusAktif == 'Y') ? 'selected' : '' ?>>Aktif</option>
                                                        <option value="N" <?= ($petugas->statusAktif == 'N') ? 'selected' : '' ?>>Tidak Aktif</option>
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