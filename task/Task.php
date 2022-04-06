<?php 

class Task extends DB{
	
	// Mengambil data
	function getTask(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menginput data
	function addTask($tname, $tdetails, $tsubject, $tpriority, $tdeadline){
		// Query mysql insert data ke tb_to_do
		$query = "INSERT INTO tb_to_do (name_td, details_td, subject_td, priority_td, deadline_td, status_td)
		VALUES ('$tname', '$tdetails', '$tsubject', '$tpriority', '$tdeadline', 'Belum')";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Menghapus data
	function deleteTask($id){
		// Query mysql delete data dari tb_to_do
		$query = "DELETE FROM tb_to_do WHERE id = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengubah status data menjadi Selesai
	function selesaiTask($id){
		// Query mysql update data dari tb_to_do
		$query = "UPDATE tb_to_do SET status_td = 'Sudah' WHERE id = $id";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengubah urutan tampilan data sesuai subject secara ascending.
	function sortSubject(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY subject_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengubah urutan tampilan data sesuai priority secara ascending.
	function sortPriority(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY priority_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengubah urutan tampilan data sesuai deadline secara ascending.
	function sortDeadline(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY deadline_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}

	// Mengubah urutan tampilan data sesuai deadline secara ascending.
	function sortStatus(){
		// Query mysql select data ke tb_to_do
		$query = "SELECT * FROM tb_to_do ORDER BY status_td ASC";

		// Mengeksekusi query
		return $this->execute($query);
	}
	
}

?>