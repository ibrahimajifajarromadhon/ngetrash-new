        <!-- footer content -->
        <footer>
          <div class="pull-right">
            NgeTrash</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
        </div>
        </div>

        <!-- jQuery -->
        <script src="<?php echo base_url('assets/admin/vendors/jquery/dist/jquery.min.js'); ?>"></script>
        <!-- Bootstrap -->
        <script src="<?php echo base_url('assets/admin/vendors/bootstrap/dist/js/bootstrap.bundle.min.js'); ?>"></script>
        <!-- FastClick -->
        <script src="<?php echo base_url('assets/admin/vendors/fastclick/lib/fastclick.js'); ?>"></script>
        <!-- NProgress -->
        <script src="<?php echo base_url('assets/admin/vendors/nprogress/nprogress.js'); ?>"></script>
        <!-- Chart.js -->
        <script src="<?php echo base_url('assets/admin/vendors/Chart.js/dist/Chart.min.js'); ?>"></script>
        <!-- gauge.js -->
        <script src="<?php echo base_url('assets/admin/vendors/gauge.js/dist/gauge.min.js'); ?>"></script>
        <!-- bootstrap-progressbar -->
        <script src="<?php echo base_url('assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js'); ?>"></script>
        <!-- iCheck -->
        <script src="<?php echo base_url('assets/admin/vendors/iCheck/icheck.min.js'); ?>"></script>
        <!-- Skycons -->
        <script src="<?php echo base_url('assets/admin/vendors/skycons/skycons.js'); ?>"></script>
        <!-- Flot -->
        <script src="<?php echo base_url('assets/admin/vendors/Flot/jquery.flot.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/Flot/jquery.flot.pie.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/Flot/jquery.flot.time.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/Flot/jquery.flot.stack.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/Flot/jquery.flot.resize.js'); ?>"></script>
        <!-- Flot plugins -->
        <script src="<?php echo base_url('assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/flot.curvedlines/curvedLines.js'); ?>"></script>
        <!-- DateJS -->
        <script src="<?php echo base_url('assets/admin/vendors/DateJS/build/date.js'); ?>"></script>
        <!-- JQVMap -->
        <script src="<?php echo base_url('assets/admin/vendors/jqvmap/dist/jquery.vmap.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js'); ?>"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="<?php echo base_url('assets/admin/vendors/moment/min/moment.min.js'); ?>"></script>
        <script src="<?php echo base_url('assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js'); ?>"></script>

        <!-- Custom Theme Scripts -->
        <script src="<?php echo base_url('assets/admin/build/js/custom.min.js'); ?>"></script>
        <script>
          let video = document.getElementById('preview');
          let canvasElement = document.getElementById('canvas');
          let canvas = canvasElement.getContext('2d');
          let scanForm = document.getElementById('scanForm');
          let idUserInput = document.getElementById('idUser');
          let scanning = false;

          function startScan() {
            navigator.mediaDevices.getUserMedia({
              video: {
                facingMode: 'environment'
              }
            }).then(function(stream) {
              video.srcObject = stream;
              video.setAttribute('playsinline', true);
              video.play();
              scanning = true; // Set status scanning menjadi true
              document.getElementById('btnStartScan').style.display = 'none'; // Sembunyikan tombol Mulai Scan
              document.getElementById('btnStopScan').style.display = 'block'; // Tampilkan tombol Tutup Scan
              requestAnimationFrame(tick);
            }).catch(function(err) {
              console.error("Error accessing the camera: ", err);
              alert("Could not access the camera. Please check your camera permissions.");
            });
          }

          function stopScan() {
            scanning = false; // Set status scanning menjadi false
            if (video.srcObject) {
              let stream = video.srcObject;
              let tracks = stream.getTracks();

              tracks.forEach(function(track) {
                track.stop(); // Hentikan setiap track yang terhubung ke stream
              });

              video.srcObject = null; // Set objek video menjadi null untuk menghentikan tampilan video
            }

            document.getElementById('btnStartScan').style.display = 'block'; // Tampilkan tombol Mulai Scan
            document.getElementById('btnStopScan').style.display = 'none'; // Sembunyikan tombol Tutup Scan
            canvas.clearRect(0, 0, canvasElement.width, canvasElement.height); // Bersihkan canvas
          }

          function tick() {
            if (!scanning) return; // Hentikan pemindaian jika scanning false
            if (video.readyState === video.HAVE_ENOUGH_DATA) {
              canvasElement.height = video.videoHeight;
              canvasElement.width = video.videoWidth;
              canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
              let imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
              let code = jsQR(imageData.data, imageData.width, imageData.height, {
                inversionAttempts: 'dontInvert',
              });
              if (code) {
                idUserInput.value = code.data;
                scanForm.submit();
                return; // Hentikan pemindaian setelah mendapatkan QR code
              }
            }
            requestAnimationFrame(tick);
          }
        </script>
        </body>

        </html>