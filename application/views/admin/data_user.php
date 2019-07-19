<?php $this->load->view("template/header") ?>
<div class="container">
  <div class="row">
    <div class="col-lg-12 mt-3">
      <div class="card border-primary mb-3">
        <div class="card-header bg-primary text-white text-uppercase font-weight-bold">
          <i class="fas fa-user"></i> Data User
          <a href="#" class="float-right">
            <button class="btn btn-success"  data-toggle="modal" data-target="#modal">
              <i class="fas fa-user-plus"></i>
            </button>
          </a>
        </div>

        <!-- Load Tabel -->
        <div class="card-body text-dark" id="view">
          <?php $this->load->view("admin/tabel_user",$this->data) ?>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modal" tabindex="-1" role="dialog"  aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="modal-title"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="col-lg-12">
                <form method="post">
                  <!-- nama user -->
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                         <i class="fas fa-address-book"></i>
                        </span>
                      </div>
                      <input type="text" name="namauser" class="form-control" placeholder="nama lengkap" id="namaInput">
                    </div>
                    <div id="namauserError"></div>
                  </div>

                  <!-- username -->
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-user"></i>
                        </span>
                      </div>
                      <input type="text" name="username" class="form-control" placeholder="username" id="usernameInput">
                    </div>
                    <div id="usernameError"></div>
                  </div>

                  <!-- password -->
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <span class="input-group-text">
                          <i class="fas fa-lock"></i>
                        </span>
                      </div>
                      <input type="password" name="password" class="form-control" placeholder="password" id="passwordInput">
                      <div class="input-group-append" id="viewPass">
                        <span class="input-group-text">
                          <i class="fas fa-eye-slash"></i>
                        </span>
                      </div>
                    </div>
                    <div id="passwordError"></div>
                  </div>

                  <!-- hak akses -->
                  <div class="form-group">
                    <div class="input-group mb-3">
                      <select name="hak_akses" class="form-control">
                        <option value="">-- Hak Akses --</option>
                        <option value="Admin">Admin</option>
                        <option value="User">User</option>
                      </select>
                    </div>
                    <div id="hakaksesError"></div>
                  </div>
                </form>
              </div>
              </div>
              <div class="modal-footer">
                <!-- Loading Simpan -->
                <div id="loading-simpan">
                  <img src="<?php echo base_url() ?>assets/loading.gif">
                  <strong>Simpan Data.....</strong>
                </div>
                <!-- Loading hapus -->
                <div id="loading-hapus">
                  <img src="<?php echo base_url() ?>assets/loading.gif">
                  <strong>Hapus Data.....</strong>
                </div>
                <!-- Ubah hapus -->
                <div id="loading-hapus">
                  <img src="<?php echo base_url() ?>assets/loading.gif">
                  <strong>Ubah Data.....</strong>
                </div>
                <!-- Tombol simpan data -->
                <button type="button" class="btn btn-primary" id="simpan">Simpan</button>
                <!-- Tombol Ubah data -->
                <button type="button" class="btn btn-primary" id="ubah">Ubah</button>

                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php $this->load->view("template/footer") ?>
