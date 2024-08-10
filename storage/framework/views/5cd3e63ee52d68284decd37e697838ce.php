<div class="modal" id="tambahPegawaiModal" tabindex="-1" aria-labelledby="tambahPegawaiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" style="overflow: visible !important;">
        <div class="modal-content" style="overflow: visible !important;">
            <div class="modal-header">
                <h1 class="modal-title fs-5 fw-bold" id="tambahPegawaiModalLabel">Tambah Data Pegawai</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="tambahDataPegawaiForm" action="<?php echo e(route('pegawai.store')); ?>" method="POST"
                enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="photo" class="form-label">Foto</label>
                        <input id="photo" type="file" class="form-control <?php $__errorArgs = ['photo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            id="photo" name="photo" accept="image/png, image/jpg, image/jpeg">
                        <div id="photo-error" class="invalid-feedback"></div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Nama</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="name" name="name">
                                <div id="name-error" class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="email" name="email">
                                <div id="email-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="start_date" class="form-label">Mulai Bekerja</label>
                                <input type="text" class="form-control <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    id="start_date" name="start_date">
                                <div id="start_date-error" class="invalid-feedback"></div>
                            </div>
                            <div class="col-md-6">
                                <label for="roles" class="form-label">Role</label>
                                <select name="roles" id="roles" class="form-select" required>
                                    <option value="" selected>Pilih Role</option>
                                    <option value="manajer">Manajer</option>
                                    <option value="developer">Developer</option>
                                    <option value="desainer">Desainer</option>
                                </select>
                                <div id="roles-error" class="invalid-feedback"></div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="documents" class="form-label">Dokumen</label>
                        <div id="drop-area"
                            class="dropzone border rounded d-flex justify-content-center align-items-center"
                            style="height: 200px; cursor: pointer;">
                        </div>
                        <div class="dz-previews"></div>
                        <div id="documents-error" class="invalid-feedback"></div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" id="simpanBtn" class="btn btn-primary fw-bold">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\BiisCorpPegawai\resources\views/components/modal-tambah-pegawai.blade.php ENDPATH**/ ?>