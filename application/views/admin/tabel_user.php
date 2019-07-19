          <div class="table-responsive">
            <table class="table table-bordered table-hover" id="tabel">
              <thead>
                <tr>
                  <th class="text-center">No</th>
                  <th class="text-center">Nama User</th>
                  <th class="text-center">Username</th>
                  <th class="text-center">Hak Akses</th>
                  <th class="text-center"><i class="fas fa-cogs"></i></th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 0; foreach($data_user as $data) { $no++;?>
                  <tr>
                    <td class="text-center"><?php echo $no ?></td>
                    <td class="text-center"><?php echo $data->user_nama ?></td>
                    <td class="text-center"><?php echo $data->user_username ?></td>
                    <td class="text-center"><?php echo $data->user_hak_akses ?></td>
                    <td class="text-center">
                      <!-- Edit Data -->
                      <button data-id="<?php echo $data->user_id ?>" class="btn btn-primary" id="ubahData">
                        <i class="fas fa-user-edit"></i>
                      </button>
                      <!-- Ubah Password -->
                      <button data-id="<?php echo $data->user_id ?>" class="btn btn-dark" id="ubahPass">
                        <i class="fas fa-unlock-alt"></i>
                      </button>
                      <!-- Hapus data -->
                      <button data-id="<?php echo $data->user_id ?>" class="btn btn-danger" id="hapusTabel">
                        <i class="fas fa-trash-alt"></i>
                      </button>
                    </td>

                    <input type="hidden" class="namauser-value" value="<?php echo $data->user_nama ?>">
                    <input type="hidden" class="username-value" value="<?php echo $data->user_username ?>">
                    <input type="hidden" class="hakakses-value" value="<?php echo $data->user_hak_akses ?>">
                  </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
