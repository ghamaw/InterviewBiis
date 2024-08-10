<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">


    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.3/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/3.1.1/css/buttons.dataTables.css">

    <!-- Select2 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- DateRangePicker CDN -->
    <link href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" rel="stylesheet" />

    <!-- Krajee File Input CDN -->
    <link href="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/css/fileinput.min.css" media="all"
        rel="stylesheet" type="text/css" />

    <!-- Dropzone CDN -->
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    <style>
        #my-dropzone {
            border: 2px dashed #007bff;
            border-radius: 5px;
            background: #f9f9f9;
            padding: 20px;
        }
    </style>

    <title>Manajemen User | Biis Corp</title>
</head>

<body style="padding-bottom: 5rem">
    <nav class="navbar bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="/">
                <img src="<?php echo e(asset('logo.png')); ?>" alt="Biis Corp" width="200" height="40">
            </a>
        </div>
    </nav>

    <main>
        <section class="container px-3">
            <div class="row align-items-center g-5 py-5 ">
                <div class="col-lg-6">
                    <h1 class="display-5 fw-bold lh-1 mb-3">Manajemen User</h1>
                    <p class="lead">Halaman ini memungkinkan Anda untuk mengedit informasi pengguna dalam sistem Biis
                        Corp. Gunakan form di bawah ini untuk memperbarui data pengguna, termasuk nama, email, dan
                        detail lainnya. Pastikan semua informasi yang dimasukkan akurat dan lengkap untuk menjaga
                        integritas data perusahaan.</p>
                </div>
                <div class="col-12 col-sm-8 col-lg-6">
                    <div class="card shadow p-3 p-sm-5">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs fw-bold mb-1">
                                        Total Karyawan</div>
                                    <div class="h1 mb-0 fw-bold text-gray-800"><?php echo e($dataPegawai->count()); ?></div>
                                </div>
                                <div class="col-auto">
                                    <i class="bi bi-people-fill text-gray-300" style="font-size: 4rem"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container px-3">
            <div class="card shadow table-responsive px-3">
                <table class="table" id="myTable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Mulai Bekerja</th>
                            <th scope="col">Dokumen</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $dataPegawai; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pegawai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><?php echo e($index + 1); ?></th>
                                <?php
                                    // {{-- Cek jika img berasal dari faker --}}
                                    $photoFileName = basename($pegawai->photo);
                                    $photoPath = 'public/photos/' . $photoFileName;
                                    $photoUrl = Storage::exists($photoPath)
                                        ? asset('storage/photos/' . $photoFileName)
                                        : asset($pegawai->photo);

                                    // Dokumen URL
                                    // Generate URL for document
                                    $documentUrl = $pegawai->documents ? url('storage/' . $pegawai->documents) : null;
                                ?>
                                <td><img src="<?php echo e($photoUrl); ?>" alt="<?php echo e($pegawai->name); ?>" width="50"
                                        height="50"></td>
                                <td><?php echo e($pegawai->name); ?></td>
                                <td><?php echo e($pegawai->email); ?></td>
                                <td><?php echo e($pegawai->roles); ?></td>
                                <td><?php echo e($pegawai->start_date); ?></td>
                                <td>
                                    <?php if($documentUrl): ?>
                                        <a href="<?php echo e($documentUrl); ?>" target="_blank" class="btn">
                                            <i class="bi bi-file-earmark-text text-primary"></i>
                                        </a>
                                    <?php else: ?>
                                        <span>
                                            <i class="bi bi-file-earmark-x text-danger"></i>
                                        </span>
                                    <?php endif; ?>

                                </td>
                                <td>
                                    <button type="button" class="btn deleteButton text-danger"
                                        data-id="<?php echo e($pegawai->id); ?>">
                                        <i class="bi bi-trash2"></i>
                                    </button>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>
        </section>
    </main>

    <?php echo $__env->make('components.modal-tambah-pegawai', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    
    <script src="https://cdn.datatables.net/2.1.3/js/dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/dataTables.buttons.js"></script>
    <script src="https://cdn.datatables.net/buttons/3.1.1/js/buttons.colVis.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- DateRangePicker JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <!-- Krajee File Input JS -->
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/buffer.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/plugins/filetype.min.js"
        type="text/javascript"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/gh/kartik-v/bootstrap-fileinput@5.5.0/js/fileinput.min.js"></script>

    <!-- Dropzone JS -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    
    <script>
        Dropzone.autoDiscover = false;

        let table = new DataTable('#myTable', {
            columnDefs: [{
                targets: 1,
                className: 'noVis'
            }],
            layout: {
                topStart: {
                    buttons: [{
                            text: '<i class="bi bi-person-plus-fill"></i>',
                            action: function(e, dt, node, config) {
                                $('#tambahPegawaiModal').modal('show');
                            }
                        },
                        {
                            extend: 'colvis',
                            text: '<i class="bi bi-table"></i>',
                            columns: ':not(.noVis)',
                            popoverTitle: 'Pilih Kolom'
                        }
                    ]
                }
            }
        });

        $(document).ready(function() {

            const myDropzone = new Dropzone("#drop-area", {
                clickable: true,
                url: "<?php echo e(route('pegawai.store')); ?>",
                method: "post",
                paramName: "documents",
                maxFiles: 1,
                maxFilesize: 2, // in MB
                acceptedFiles: '.pdf, .doc, .docx',
                uploadMultiple: false,
                addRemoveLinks: true,
                autoProcessQueue: false,
                previewsContainer: ".dz-previews",
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                        'content')
                },
                init: function() {
                    var submitButton = document.querySelector("#simpanBtn");
                    var myDropzone = this;

                    submitButton.addEventListener("click", function(e) {
                        e.preventDefault();
                        e.stopPropagation();
                        myDropzone.processQueue();
                    });

                    // Mengganti event menjadi 'sending' karena uploadMultiple adalah false
                    this.on("sending", function(data, xhr, formData) {
                        formData.append("name", jQuery("#name").val());
                        formData.append("email", jQuery("#email").val());
                        formData.append("start_date", jQuery("#start_date").val());
                        formData.append("roles", jQuery("#roles").val());

                        // Ambil file dari input 'photo' dan tambahkan ke FormData
                        var photoInput = document.getElementById('photo');
                        if (photoInput.files.length > 0) {
                            formData.append("photo", photoInput.files[0]);
                        }

                        // Logging data yang akan dikirim
                        console.log("Data yang dikirim:");
                        for (let pair of formData.entries()) {
                            console.log(pair[0] + ': ' + pair[1]);
                        }
                    });

                    this.on("success", function(file, response) {
                        console.log("File uploaded successfully", response);

                        // Tampilkan SweetAlert sukses ✔
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Data pegawai telah berhasil ditambahkan.',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            // Reset form
                            resetForm();

                            // Tutup modal ✔
                            $('#tambahDataPegawaiForm').closest('.modal').modal('hide');

                            // Reload tampilan ✔
                            location.reload(); // Jika ingin me-reload seluruh halaman
                        });
                    });

                    this.on("error", function(file, response) {
                        if (response.errors) {
                            // Hapus semua pesan error yang mungkin sudah ada sebelumnya
                            clearErrors();

                            // Tampilkan pesan error
                            showErrors(response.errors);
                        }
                        console.log("File upload error", response);
                    });
                }
            });

            // Fungsi untuk mereset form dan Dropzone
            function resetForm() {
                // Reset Dropzone
                myDropzone.removeAllFiles(true);

                // Reset input form
                document.getElementById('tambahDataPegawaiForm').reset();

                // Menghapus kelas is-invalid dari input
                document.querySelectorAll('.is-invalid').forEach(function(element) {
                    element.classList.remove('is-invalid');
                });

                // Menghapus pesan error yang tampil
                document.querySelectorAll('.invalid-feedback').forEach(function(element) {
                    element.textContent = '';
                });
            }


            // hapus pesan error yang ada
            function clearErrors() {
                document.querySelectorAll('.invalid-feedback').forEach(function(element) {
                    element.textContent = '';
                });
                document.querySelectorAll('.is-invalid').forEach(function(element) {
                    element.classList.remove('is-invalid');
                });
            }

            // tampilkan pesan error dari JSON 
            function showErrors(errors) {
                for (const [field, messages] of Object.entries(errors)) {
                    const inputElement = document.getElementById(field);
                    const errorElement = document.getElementById(`${field}-error`);

                    if (inputElement && errorElement) {
                        inputElement.classList.add('is-invalid');
                        errorElement.textContent = messages.join(', ');
                    }
                }
            }

            function resetForm() {
                // Reset Dropzone
                myDropzone.removeAllFiles(true); // Menghapus semua file yang diunggah di Dropzone

                // Reset input form
                document.getElementById('tambahDataPegawaiForm').reset();

                // Menghapus kelas is-invalid dari input
                document.querySelectorAll('.is-invalid').forEach(function(element) {
                    element.classList.remove('is-invalid');
                });

                // Menghapus pesan error yang tampil
                document.querySelectorAll('.invalid-feedback').forEach(function(element) {
                    element.textContent = '';
                });
            }

            // $('#simpanBtn').on('click', function(e) {
            //     e.preventDefault();

            //     let formData = new FormData($('#tambahDataPegawaiForm')[0]);

            //     $.ajax({
            //         url: $('#tambahDataPegawaiForm').attr('action'),
            //         method: 'POST',
            //         data: formData,
            //         contentType: false,
            //         processData: false,
            //         success: function(response) {
            //             // Reset Form
            //             $('.invalid-feedback').empty();
            //             $('.form-control').removeClass('is-invalid');
            //             $('#tambahDataPegawaiForm')[0].reset();
            //             $('#tambahPegawaiModal').modal('hide');

            //             Swal.fire("Saved!", "", "success").then(() => {
            //                 setTimeout(function() {
            //                     location.reload();
            //                 }, 2000);
            //             });
            //         },
            //         error: function(xhr) {
            //             let errors = xhr.responseJSON.errors;
            //             console.log(errors);

            //             // Menghapus pesan error sebelumnya
            //             $('.invalid-feedback').empty();
            //             $('.form-control').removeClass('is-invalid');
            //             $('.form-select').removeClass('is-invalid');

            //             // Menampilkan pesan error baru
            //             if (errors) {
            //                 $.each(errors, function(key, value) {
            //                     // Menggunakan ID yang sesuai untuk setiap field
            //                     let errorElementId = '#' + key + '-error';
            //                     let errorMessage = value[
            //                         0]; // Ambil pesan error pertama

            //                     // Menampilkan pesan error di elemen dengan ID yang sesuai
            //                     $(errorElementId).text(errorMessage);
            //                     $('#' + key).addClass('is-invalid');
            //                 });
            //             }
            //         }
            //     });
            // });

            // Delete
            $(document).on('click', '.deleteButton', function() {
                var dataId = $(this).data('id');
                console.log(dataId);

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Data ini akan dihapus secara permanen!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '/pegawai/' + dataId,
                            type: 'DELETE',
                            data: {
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(response) {
                                if (response.success) {
                                    Swal.fire(
                                        'Dihapus!',
                                        'Data Anda telah dihapus.',
                                        'success'
                                    ).then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire(
                                        'Error!',
                                        'Terjadi kesalahan saat menghapus data.',
                                        'error'
                                    );
                                }
                            },
                            error: function(xhr) {
                                console.error(xhr.responseText);
                                Swal.fire(
                                    'Error!',
                                    'Tidak dapat menghapus data.',
                                    'error'
                                );
                            }
                        });
                    }
                });
            });

            // Krajee File Input
            $("#photo").fileinput({
                'showUpload': false,
                'previewFileType': 'any'
            });

            // Select2
            $('#roles').select2({
                dropdownParent: $('.modal-body')
            });

            // Datepicker
            $('input[name="start_date"]').daterangepicker({
                singleDatePicker: true,
                showDropdowns: true,
                drops: 'up',
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\BiisCorpPegawai\resources\views/index.blade.php ENDPATH**/ ?>