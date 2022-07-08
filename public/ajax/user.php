<?php
session_start();
include '../../controller/config.php';

$keyword = strtolower($_GET['keyword']);
$kode = $_SESSION['id'];

// usleep(5000);

// echo $keyword;
// die;

// $sql = "SELECT a.Kode_petugas, a.Username, a.Email, a.Password, a.Old_password, a.Last_login, a.Status, a.Created_at, a.Updated_at, b.Nama, b.NIK, b.Alamat, b.Foto, b.NoHP, b.Tanggal_lahir, b.Tempat_lahir, c.Jabatan, c.Id_jabatan FROM auth a, petugas b, jabatan c WHERE a.Username LIKE '%$keyword%' AND a.Kode_petugas=b.Kode_petugas AND b.Jabatan=c.Id_jabatan AND b.Nama LIKE '%$keyword%' OR a.Kode_petugas LIKE '%$keyword%' ORDER BY c.Id_jabatan";

$sql = "SELECT petugas.NIK, petugas.Nama, petugas.Foto, petugas.Tempat_lahir, petugas.Tanggal_lahir, petugas.Alamat, petugas.NoHP, auth.Kode_petugas, auth.Username, auth.Email, auth.Password, auth.Old_password, auth.Status,auth.Last_login, auth.Created_at, auth.Updated_at, jabatan.Jabatan FROM petugas LEFT JOIN auth ON auth.Kode_petugas=petugas.Kode_petugas LEFT JOIN jabatan ON jabatan.Id_jabatan=petugas.Jabatan WHERE petugas.Nama LIKE '%$keyword%' OR auth.Username LIKE '%$keyword%' ORDER BY jabatan.Id_jabatan ASC";

$query = mysqli_query($conn, $sql);

$jumData = mysqli_num_rows($query);
?>

<table class="table table-hover align-middle text-nowrap">
    <thead class="table-dark">
        <tr class="fw-semibold text-center">
            <td>No</td>
            <td>Action</td>
            <td>Kode Petugas</td>
            <td>Nama</td>
            <td>Username</td>
            <td>Jabatan</td>
            <td>Terakhir Login</td>
            <td>Status</td>
        </tr>
    </thead>
    <?php $no = 0; ?>
    <tbody>
        <?php if (!$jumData == 0) : ?>
            <?php while ($row = mysqli_fetch_assoc($query)) : ?>
                <tr class="text-start">
                    <td scope="row">
                        <p class="text-dark"><?= $no = $no + 1; ?></p>
                    </td>
                    <td class="p-1" style="width: 5%;">
                        <div class="row">
                            <button type="button" class="btn btn-success mt-1 text-center  text-white" data-bs-toggle="modal" data-bs-target="#Detail<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-information"></i> Detail</button>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-primary mt-1 text-center" data-bs-toggle="modal" data-bs-target="#Edit<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-grease-pencil"></i> Edit</button>
                        </div>
                        <div class="row">
                            <button type="button" class="btn btn-danger mt-1 text-white text-center" data-bs-toggle="modal" data-bs-target="#Delete<?= $row['Kode_petugas']; ?>"><i class="mdi mdi-delete"></i> Hapus</button>
                        </div>
                    </td>
                    <td class="text-center text-dark">
                        <?= $row['Kode_petugas']; ?>
                    </td>
                    <td class="text-center text-dark">
                        <?php if (isset($row['Nama'])) { ?>
                        <?= $row['Nama'];
                        } else { ?>
                            <i>NULL</i>
                        <?php } ?>
                    </td>
                    <td class="text-center text-dark">
                        <?= $row['Username']; ?>
                    </td>
                    <td class="text-center text-dark">
                        <?php if (isset($row['Jabatan'])) { ?>
                        <?= $row['Jabatan'];
                        } else { ?>
                            <i>NULL</i>
                        <?php } ?>
                    </td>
                    <td class="text-center text-dark text-opacity-0">
                        <?= $row['Last_login']; ?>
                    </td>
                    <td class="text-center text-dark ">
                        <?= ($row['Status'] == 1) ? "<p class='text-success'>Online</p>" : "Oflline"; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
        <?php else : ?>
            <tr class="text-center fw-bold">
                <td colspan="7">
                    DATA TIDAK DITEMUKAN
                </td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>