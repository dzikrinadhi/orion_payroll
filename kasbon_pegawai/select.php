<?php 
	include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');
	$tgl_dari   = $_GET['tgl_dari'];
	$tgl_sampai = $_GET['tgl_sampai'];  
	$status     = $_GET['status'];
	$id_pegawai = $_GET['id_pegawai'];
	$order_by   = $_GET['order_by'];

	
	$filter = "";

	//Filter Periode
	$filter .= " AND tanggal BETWEEN & Format($tgl_dari, 'dd-MM-yyyy') AND Format($tgl_sampai, 'dd-MM-yyyy') ";

	//Filter sisa
	if($status <> 0){
		if ($status == 1) {
			$filter .= " AND sisa > 0  ";
		} else {
			$filter .= " AND sisa <= 0  ";
		}
	}

	if($id_pegawai <> 0){
		$filter .= " AND id_pegawai = '$id_pegawai' ";
	}

	$order ="";
	if($order_by <> "" ){
		$order .= " ORDER BY $order_by ";
	}
    
	$sql = "SELECT id, nomor, tanggal, id_pegawai, jumlah, cicilan, sisa, keterangan, user_id, tgl_input, user_edit, tgl_edit
			FROM kasbon_pegawai WHERE id <> 0 $filter $order ";
	$qry = mysqli_query($connect, $sql);

	$json = array();

	while($row = mysqli_fetch_assoc($qry)){
		$json[] = $row;
	}

	echo json_encode(array('data' =>$json));

	mysqli_close($connect);	
?>

