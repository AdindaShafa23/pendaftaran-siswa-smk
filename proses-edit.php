<?php

include("../config.php");

// cek apakah tombol daftar sudah diklik atau blum?
if (isset($_POST['simpan'])) {

	// ambil data dari formulir
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jenis_kelamin'];
	$agama = $_POST['agama'];
	$pelajaran = $_POST['mata_pelajaran'];

	// buat query update
	$sql = "UPDATE guru SET nama='$nama', alamat='$alamat', jenis_kelamin='$jk', agama='$agama', mata_pelajaran='$pelajaran' WHERE id=$id";
	$query = mysqli_query($db, $sql);

	// apakah query update berhasil?
	if ($query) {
		// kalau berhasil alihkan ke halaman list-siswa.php
		header('Location: list-guru.php');
	} else {
		// kalau gagal tampilkan pesan
		die("Gagal menyimpan perubahan...");
	}
} else {
	die("Akses dilarang...");
}
