<?php

include("config.php");

// cek apakah tombol daftar sudah diklik atau belum?
if (isset($_POST['daftar'])) {

	// ambil data dari formulir
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jenis_kelamin'];
	$agama = $_POST['agama'];
	$sekolah = $_POST['sekolah_asal'];

	// cek apakah ada file yang diunggah
	if (isset($_FILES['foto']) && $_FILES['foto']['error'] == UPLOAD_ERR_OK) {
		// ambil informasi file
		$foto = $_FILES['foto'];
		$namaFile = $foto['name'];
		$tmpName = $foto['tmp_name'];
		$error = $foto['error'];
		$ukuran = $foto['size'];
		$tipeFile = $foto['type'];

		// buat folder tujuan jika belum ada
		$folderTujuan = "uploads/";
		if (!is_dir($folderTujuan)) {
			mkdir($folderTujuan, 0777, true);
		}

		// buat nama file unik
		$ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
		$namaFileBaru = uniqid("foto_", true) . "." . $ekstensi;

		// pindahkan file ke folder tujuan
		if (move_uploaded_file($tmpName, $folderTujuan . $namaFileBaru)) {
			// jika berhasil pindahkan, simpan informasi file ke database
			$sql = "INSERT INTO calon_siswa (nama, alamat, jenis_kelamin, agama, sekolah_asal, foto) 
					VALUE ('$nama', '$alamat', '$jk', '$agama', '$sekolah', '$namaFileBaru')";
			$query = mysqli_query($db, $sql);

			// apakah query simpan berhasil?
			if ($query) {
				// kalau berhasil alihkan ke halaman index.php dengan status=sukses
				header('Location: index.php?status=sukses');
			} else {
				// kalau gagal alihkan ke halaman index.php dengan status=gagal
				header('Location: index.php?status=gagal');
			}
		} else {
			die("Gagal mengunggah file.");
		}
	} else {
		die("File tidak diunggah atau terjadi kesalahan.");
	}
} else {
	die("Akses dilarang...");
}
