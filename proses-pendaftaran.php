<?php

include("../config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if (isset($_POST['daftar'])) {

	// ambil data dari formulir
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jenis_kelamin'];
	$agama = $_POST['agama'];
	$pelajaran = $_POST['mata_pelajaran'];

	// buat query
	$sql = "INSERT INTO guru (nama, alamat, jenis_kelamin, agama, mata_pelajaran) VALUE ('$nama', '$alamat', '$jk', '$agama', '$pelajaran')";
	$query = mysqli_query($db, $sql);
	// apakah query simpan berhasil?
	if ($query) {
		// kalau berhasil alihkan ke halaman index.php dengan status=sukses
		header('Location: list-guru.php?status=sukses');
	} else {
		// kalau gagal alihkan ke halaman indek.ph dengan status=gagal
		header('Location: list-guru.php?status=gagal');
	}
} else {
	die("Akses dilarang...");
}
