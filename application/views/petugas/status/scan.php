        <!-- page content -->
        <div class="right_col" role="main">
            <div class="container">
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Manajemen Status </h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Manajemen Status Pengambilan Sampah</li>
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
                                            <div class="row justify-content-between">
                                                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                                    <h3 class="card-title">Scan QR Code</h3>

                                                </div>
                                                <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12 mt-2">
                                                    <div class="form-group">
                                                        <button id="btnStartScan" onclick="startScan()" class="btn btn-success btn-block rounded-sm shadow-sm"><b> <i class="fa fa-qrcode mr-2" aria-hidden="true"></i> Mulai Scan QR Code </b></button>
                                                        <button id="btnStopScan" onclick="stopScan()" class="btn btn-danger btn-block rounded-sm shadow-sm" style="display: none;"><b> <i class="fa fa-times mr-2" aria-hidden="true"></i> Tutup Scan QR Code </b></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                        <?php if ($this->session->flashdata('success')) : ?>
                                            <div class="ml-2 mr-2 mt-2 mb-0 alert alert-success alert-dismissible text-whitesmoke">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                        <div class="center-content">
                                            <div id="reader" class="mt-2">
                                                <video id="preview" playsinline></video>
                                                <canvas id="canvas"></canvas>
                                            </div>
                                            <p>*Nb: Silahkan scan qr code anda!</p>
                                            <form id="scanForm" method="post" action="<?php echo site_url('petugas_status/process_scan'); ?>" class="mb-1">
                                                <input type="hidden" name="idUser" id="idUser">
                                            </form>
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