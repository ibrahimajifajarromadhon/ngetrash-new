        <!-- page content -->
        <div class="right_col" role="main">
            <div class="container">
                <div class="content-wrapper">
                    <!-- Content Header (Page header) -->
                    <section class="content-header">
                        <div class="container-fluid">
                            <div class="row mb-2">
                                <div class="col-sm-6">
                                    <h1>Manajemen QR Code Data User</h1>
                                </div>
                                <div class="col-sm-6">
                                    <ol class="breadcrumb float-sm-right">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                        <li class="breadcrumb-item active">Manajemen QR Code Data User</li>
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
                                            <h3 class="card-title">QR Code Data User</h3>
                                        </div>

                                        <?php if ($this->session->flashdata('success')) : ?>
                                            <div class="ml-2 mr-2 mt-2 mb-0 alert alert-success alert-dismissible text-whitesmoke">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                                            </div>
                                        <?php endif; ?>

                                        <div class="table-responsive p-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>Nama User</th>
                                                        <th>Alamat User</th>
                                                        <th style="width: 230px">QR Code</th>
                                                        <th style="width: 200px">Download QR Code</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $no = 1;
                                                        foreach ($users as $u) { ?>
                                                    <tr>
                                                        <th style="text-align: center;"><?php echo $no; ?></th>
                                                        <td><?php echo $u->name; ?></td>
                                                        <td><?php echo $u->alamat; ?></td>
                                                        <td>
                                                            <?php
                                                            $qr_code_path = 'assets/qrcodes/' . $u->idUser . '.png';
                                                            if (file_exists(FCPATH . $qr_code_path)) : ?>
                                                                <img src="<?php echo base_url($qr_code_path); ?>" alt="QR Code" width="100">
                                                            <?php else : ?>
                                                                <b><a href="<?php echo base_url('admin_user_qrcode/generate_qr_code/' . $u->idUser); ?>" class="btn btn-primary">Generate QR Code</a></b>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                        <?php if (file_exists(FCPATH . $qr_code_path)) : ?>
                                                            <a href="<?php echo base_url('admin_user_qrcode/download_qr_code/' . $u->idUser); ?>" class="btn btn-success">Download</a>
                                                        <?php endif; ?>
                                                    </td>
                                                    </tr>
                                                <?php $no++;
                                                        } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <ul class="pagination pagination-sm m-0 justify-content-end">
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo site_url('admin_user_qrcode/page/' . $links['prev_page']); ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>

                                                <?php for ($i = 1; $i <= $links['num_pages']; $i++) : ?>
                                                    <li class="page-item <?php echo ($i == $links['current_page']) ? 'active' : ''; ?>">
                                                        <a class="page-link" href="<?php echo site_url('admin_user_qrcode/page/' . $i); ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo site_url('admin_user_qrcode/page/' . $links['next_page']); ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
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