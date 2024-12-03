<?php

include("config.php");

// cek apakah tombol simpan sudah diklik
if (isset($_POST['simpan'])) {

	// ambil data dari formulir
	$id = $_POST['id'];
	$nama = $_POST['nama'];
	$alamat = $_POST['alamat'];
	$jk = $_POST['jenis_kelamin'];
	$agama = $_POST['agama'];
	$sekolah = $_POST['sekolah_asal'];

	$fotoBaru = null;

	// Periksa apakah ada file baru yang diunggah
	if (isset($_FILES['foto_baru']) && $_FILES['foto_baru']['error'] == UPLOAD_ERR_OK) {
		$foto = $_FILES['foto_baru'];
		$namaFile = $foto['name'];
		$tmpName = $foto['tmp_name'];
		$ekstensi = pathinfo($namaFile, PATHINFO_EXTENSION);
		$namaFileBaru = uniqid("foto_", true) . "." . $ekstensi;
		$folderTujuan = "uploads/";

		// Pindahkan foto baru ke folder uploads
		if (move_uploaded_file($tmpName, $folderTujuan . $namaFileBaru)) {
			$fotoBaru = $namaFileBaru;

			// Hapus foto lama jika ada
			$sqlFotoLama = "SELECT foto FROM calon_siswa WHERE id=$id";
			$queryFotoLama = mysqli_query($db, $sqlFotoLama);
			$dataFotoLama = mysqli_fetch_assoc($queryFotoLama);
			if ($dataFotoLama && $dataFotoLama['foto'] && file_exists($folderTujuan . $dataFotoLama['foto'])) {
				unlink($folderTujuan . $dataFotoLama['foto']);
			}
		}
	}

	// Buat query update
	$sql = "UPDATE calon_siswa SET 
				nama='$nama', 
				alamat='$alamat', 
				jenis_kelamin='$jk', 
				agama='$agama', 
				sekolah_asal='$sekolah'";

	// Tambahkan kolom foto jika ada foto baru
	if ($fotoBaru) {
		$sql .= ", foto='$fotoBaru'";
	}

	$sql .= " WHERE id=$id";

	$query = mysqli_query($db, $sql);

	// Redirect
	if ($query) {
		header('Location: list-siswa.php?status=sukses');
	} else {
		die("Gagal menyimpan perubahan...");
	}
} else {
	die("Akses dilarang...");
}
