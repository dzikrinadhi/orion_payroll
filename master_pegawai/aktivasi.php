<?php
    include($_SERVER['DOCUMENT_ROOT'].'/orion_payroll/konfig/koneksi.php');        
    $id   = $_POST['id'];        
    class emp{}
    
    $sql    = "SELECT status FROM master_pegawai WHERE id = '$id'";
    $qry    = mysqli_query($connect, $sql);
    $status = mysqli_fetch_array($qry);
    $statusOld = $status['status'];
    $statusOld;
    
    if ($statusOld == 'T'){
        $statusNew = 'F';
    }else{
        $statusNew = 'T';
    }

    $sql = "UPDATE master_pegawai SET                    
                   status = '$statusNew' 
            WHERE id = '$id' ";    
    $qry = mysqli_query($connect, $sql); 

    if($qry){
        $response = new emp();
		$response->success = 1;
		$response->message = "Berhasil di aktivasi";
		die(json_encode($response));
    }else{
        $response = new emp();
		$response->success = 0;
		$response->message = "Error aktivasi Data";
		die(json_encode($response)); 
    }
?>

