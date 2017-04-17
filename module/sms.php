<?php
include "../config/conn.php";
require_once __DIR__ . '/../vendor/autoload.php';

$client = new Nexmo\Client(new Nexmo\Client\Credentials\Basic('209b4199', '2dae19eb737b1d59'));


	// $sql=mysql_query("select * from siswa where ids='$_GET[ids]' ");
	// $rs=mysql_fetch_array($sql);
	// $sqla=mysql_query("select * from absen where ids='$rs[ids]'");
	// $rsa=mysql_fetch_array($sqla);
	$sql = $con->prepare('select * from siswa where ids= ?');
    $sql->execute(["$_GET[ids]"]);
    $rs = $sql->fetch();
    $sqla = $con->prepare('select * from absen where ids= ?');
    $sqla->execute(["$rs[ids]"]);
    $rsa = $sqla->fetch();

$noTujuan = "60$rs[tlp]";
$isi = "Kami Memberitahukan bahwa pada tanggal $rsa[tgl]. Nama : $rs[nama]. Alamat : $rs[alamat]. Tidak Masuk Sekolah Tanpa Keterangan";
 
$message = $client->message()->send([
    'to' => "$noTujuan",
    'from' => "NEXMO",
    'text' => "$isi"
]);

?>
