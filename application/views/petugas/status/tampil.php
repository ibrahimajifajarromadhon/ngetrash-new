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
                                            <h3 class="card-title">Data Status Pengambilan Sampah</h3>
                                        </div>
                                        <?php if ($this->session->flashdata('success')) : ?>
                                            <div class="ml-2 mr-2 mt-2 mb-0 alert alert-success alert-dismissible text-whitesmoke">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?php echo $this->session->flashdata('success'); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                        <?php if ($this->session->flashdata('error')) : ?>
                                            <div class="ml-2 mr-2 mt-2 mb-0 alert alert-danger alert-dismissible text-whitesmoke">
                                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                                <strong><?php echo $this->session->flashdata('error'); ?></strong>
                                            </div>
                                        <?php endif; ?>
                                        <div class="pl-2 pt-2">
                                            <a href="<?php echo site_url('petugas_status/scan'); ?>" class="btn btn-sm btn-info float-left p-2 pl-5 pr-5"><b> Scan QR Code </b></a>
                                        </div>
                                        <!-- /.card-header -->
                                        <div class="table-responsive p-2">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th style="width: 10px">No</th>
                                                        <th>Nama User</th>
                                                        <th>Tanggal</th>
                                                        <th>Keterangan</th>
                                                        <th>Nama Petugas</th>
                                                        <th style="width: 230px">Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <?php $no = 1;
                                                        foreach ($status as $s) { ?>
                                                    <tr>
                                                        <th style="text-align: center;"><?php echo $no; ?></th>
                                                        <td>
                                                            <?php
                                                            $user_id = $s->idUser;
                                                            $user = $this->db->get_where('tbl_user', array('idUser' => $user_id))->row();
                                                            echo $user->name;
                                                            ?>
                                                        </td>
                                                        <td><?php
                                                            $date = new DateTime($s->tanggal);
                                                            $hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                                                            $bulan = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

                                                            echo $hari[$date->format('w')] . ', ' . $date->format('j') . ' ' . $bulan[$date->format('n') - 1] . ' ' . $date->format('Y');
                                                            ?></td>
                                                        <td><b style="background-color: <?php echo ($s->keterangan == 'Sudah Diambil') ? 'green' : 'red'; ?>; padding: 4px; color: white; border-radius: 10px; display: inline-block;"><?php echo $s->keterangan; ?></b></td>
                                                        <td>
                                                            <?php
                                                            $petugas_id = $s->idPetugas;
                                                            $petugas = $this->db->get_where('tbl_petugas', array('idPetugas' => $petugas_id))->row();
                                                            echo $petugas->name;
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <a href="<?php echo site_url('petugas_status/get_by_id/' . $s->idStatus); ?>" class="btn btn-warning">Ubah Status</a>
                                                                <a href="<?php echo site_url('petugas_status/delete/' . $s->idStatus); ?>" onclick="return confirm('Anda yakin menghapus data ini?')" class="btn btn-danger">Hapus</a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php $no++;
                                                        } ?>
                                                </tbody>
                                            </table>
                                            <p>*Nb: 1 user hanya dapat di scan 1 kali dalam sehari oleh 1 petugas!</p>
                                        </div>

                                        <!-- /.card-body -->
                                        <div class="card-footer clearfix">
                                            <ul class="pagination pagination-sm m-0 justify-content-end">
                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo site_url('petugas_status/page/' . $links['prev_page']); ?>" aria-label="Previous">
                                                        <span aria-hidden="true">&laquo;</span>
                                                    </a>
                                                </li>

                                                <?php for ($i = 1; $i <= $links['num_pages']; $i++) : ?>
                                                    <li class="page-item <?php echo ($i == $links['current_page']) ? 'active' : ''; ?>">
                                                        <a class="page-link" href="<?php echo site_url('petugas_status/page/' . $i); ?>"><?php echo $i; ?></a>
                                                    </li>
                                                <?php endfor; ?>

                                                <li class="page-item">
                                                    <a class="page-link" href="<?php echo site_url('petugas_status/page/' . $links['next_page']); ?>" aria-label="Next">
                                                        <span aria-hidden="true">&raquo;</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
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