<?php
include "connection.php";

	
//Menampilkan jumlah baris hasil query
//echo "Jumlah baris dalam data: " . $result -> num_rows;


//menyimpan isian formulir

//Jika ada tombol simpan maka melkukan penyimpanan, jika tidak ada lanjut ke secript berikutnya

if(isset($_GET['action']))
{
	if($_GET['action']=="hapus")
	{
		
		$sql = "delete from mahasiswa where id='".$_GET['id']."'";

			if(!$connection -> query($sql))
			{
				
				echo "Isian salah";
			}
		
	}
	
}


if(isset($_POST['simpan']))
{
	if(isset($_GET['id']))
		
		{
			
		$sql = "update mahasiswa set 
		nama='".$_POST['nama']."',
		jeniskelamin='".$_POST['jeniskelamin']."',
		rumah=geomfromtext('POINT(".$_POST['longitude']." ".$_POST['latitude'].")')
		
		where id='".$_GET['id']."'";
		
		}
	else 
		{
		
		$sql = "insert into mahasiswa(nama,jeniskelamin,rumah) 
		values('".$_POST['nama']."','".$_POST['jeniskelamin']."',
		
		geomfromtext('POINT(".$_POST['longitude']." ".$_POST['latitude'].")')
		
		)";
	
		}
	
	
	
	if(!$connection -> query($sql))
	{
		
		echo "Isian salah";
	}
	
	
}




// Jalankan Query, dll
$sql= "select id,nama,jeniskelamin,astext(rumah) from mahasiswa";//masukan perintah SQL
$mahasiswa = $connection -> query($sql) ;

$connection -> close();

//$mahasiswa = $result;
?>

<body>
<h3>Daftar Mahasiswa</h3>

<a href="tambah.php">Tambah Mahasiswa</a>

<table width="30%">
<tr>
	<td width="20%">No</td>
	<td width="40%">Nama</td>
	<td width="20%">Jenis Kelamin</td>
	<td width="10%">Rumah</td>
	<td width="5%">Edit</td>
	<td width="5%">Hapus</td>
</tr>


<?php

function setJenisKelamin($jeniskelamin)
{
	if($jeniskelamin==1)
		{ return "Laki-laki"; }
	elseif($jeniskelamin==2)
		{ return "Perempuan";}
}



foreach($mahasiswa as $mhsbaris)
{
	echo "<tr>";
	
	$i=0;
	
	foreach($mhsbaris as $mhs)
	{
		if ($i==0) {
			$id=$mhs;
		}
		
		if ($i==2) {
			
			echo "<td>".setJenisKelamin($mhs)."</td>";
			
		} else {
			
			
			echo "<td>$mhs</td>";
			
			
		}
		$i++;

	}
	
			
		echo "<td><a href='edit.php?id=$id'>Edit</a></td>";
		echo "<td><a href='index.php?action=hapus&id=$id'>Hapus</a></td>";
	
	echo "</tr>";
}


?>
</table>

</body>