<?php

include("../config.php");

if (!isset($_GET['id'])) {
	// kalau tidak ada id di query string
	header('Location: list-guru.php');
}

//ambil id dari query string
$id = $_GET['id'];

// buat query untuk ambil data dari database
$sql = "SELECT * FROM guru WHERE id=$id";
$query = mysqli_query($db, $sql);
$siswa = mysqli_fetch_assoc($query);

// jika data yang di-edit tidak ditemukan
if (mysqli_num_rows($query) < 1) {
	die("data tidak ditemukan...");
}

?>


<!DOCTYPE html>
<html>

<head>
	<title>Formulir Edit Karyawan | SMK Coding</title>
</head>

<body>
	<header>
		<h3>Formulir Edit Karyawan</h3>
	</header>

	<form action="proses-edit.php" method="POST" enctype="multipart/form-data">

		<fieldset>

			<input type="hidden" name="id" value="<?php echo $siswa['id'] ?>" />

			<p>
				<label for="nama">Nama: </label>
				<input type="text" name="nama" placeholder="nama lengkap" value="<?php echo $siswa['nama'] ?>" />
			</p>
			<p>
				<label for="alamat">Alamat: </label>
				<textarea name="alamat"><?php echo $siswa['alamat'] ?></textarea>
			</p>
			<p>
				<label for="jenis_kelamin">Jenis Kelamin: </label>
				<?php $jk = $siswa['jenis_kelamin']; ?>
				<label><input type="radio" name="jenis_kelamin" value="laki-laki" <?php echo ($jk == 'laki-laki') ? "checked" : "" ?>> Laki-laki</label>
				<label><input type="radio" name="jenis_kelamin" value="perempuan" <?php echo ($jk == 'perempuan') ? "checked" : "" ?>> Perempuan</label>
			</p>
			<p>
				<label for="agama">Agama: </label>
				<?php $agama = $siswa['agama']; ?>
				<select name="agama">
					<option <?php echo ($agama == 'Islam') ? "selected" : "" ?>>Islam</option>
					<option <?php echo ($agama == 'Kristen') ? "selected" : "" ?>>Kristen</option>
					<option <?php echo ($agama == 'Hindu') ? "selected" : "" ?>>Hindu</option>
					<option <?php echo ($agama == 'Budha') ? "selected" : "" ?>>Budha</option>
					<option <?php echo ($agama == 'Atheis') ? "selected" : "" ?>>Atheis</option>
				</select>
			</p>
			<p>
				<label for="mata_pelajaran">Mata Pelajaran: </label>
				<input type="text" name="mata_pelajaran" placeholder="mata pelajaran" value="<?php echo $siswa['mata_pelajaran'] ?>" />
			</p>
			<p>
				<input type="submit" value="Simpan" name="simpan" />
			</p>

		</fieldset>


	</form>

</body>

</html>