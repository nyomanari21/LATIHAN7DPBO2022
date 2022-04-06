<?php

include("conf.php");
include("DB.php");
include("Task.php");
include("Template.php");

// Membuat objek dari kelas task
$otask = new Task($db_host, $db_user, $db_password, $db_name);
$otask->open();

// Memanggil method addTask jika tombol Add di klik dan data masuk
if (isset($_POST['add'])) {
    $otask->addTask($_POST['tname'], $_POST['tdetails'], $_POST['tsubject'], $_POST['tpriority'], $_POST['tdeadline']);
}

// Memanggil method deleteTask untuk menghapus task yang diklik Hapus
if(isset($_GET['id_hapus'])){
	$otask->deleteTask($_GET['id_hapus']);
}

// Memanggil method selesaiTask untuk mengubah status task yang diklik Selesai menjadi selesai
if(isset($_GET['id_status'])){
	$otask->selesaiTask($_GET['id_status']);
}

// Memanggil fungsi sort sesuai pilihan user
if(isset($_GET['sort_subject'])){
	$otask->sortSubject();
}
else if(isset($_GET['sort_priority'])){
	$otask->sortPriority();
}
else if(isset($_GET['sort_deadline'])){
	$otask->sortDeadline();
}
else if(isset($_GET['sort_status'])){
	$otask->sortStatus();
}
else{
	$otask->getTask();
}

// Proses mengisi tabel dengan data
$data = null;
$no = 1;

while (list($id, $tname, $tdetails, $tsubject, $tpriority, $tdeadline, $tstatus) = $otask->getResult()) {
	// Tampilan jika status task nya sudah dikerjakan
	if($tstatus == "Sudah"){
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		</td>
		</tr>";
		$no++;
	}

	// Tampilan jika status task nya belum dikerjakan
	else{
		$data .= "<tr>
		<td>" . $no . "</td>
		<td>" . $tname . "</td>
		<td>" . $tdetails . "</td>
		<td>" . $tsubject . "</td>
		<td>" . $tpriority . "</td>
		<td>" . $tdeadline . "</td>
		<td>" . $tstatus . "</td>
		<td>
		<button class='btn btn-danger'><a href='index.php?id_hapus=" . $id . "' style='color: white; font-weight: bold;'>Hapus</a></button>
		<button class='btn btn-success' ><a href='index.php?id_status=" . $id .  "' style='color: white; font-weight: bold;'>Selesai</a></button>
		</td>
		</tr>";
		$no++;
	}
}

// Menutup koneksi database
$otask->close();

// Membaca template skin.html
$tpl = new Template("templates/skin.html");

// Mengganti kode Data_Tabel dengan data yang sudah diproses
$tpl->replace("DATA_TABEL", $data);

// Menampilkan ke layar
$tpl->write();
