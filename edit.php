<?php
include "connection.php";


$sql = "select id,nama,jeniskelamin,x(rumah) longitude,y(rumah) latitude 
from mahasiswa where id='".$_GET['id']."'";

$mhs = $connection -> query($sql);
$mahasiswa=mysqli_fetch_assoc($mhs);

function isSelected($v1,$v2)
{
	if($v1==$v2)
	{ return "selected";}
}



?>



<h3>Form Edit Mahasiswa</h3>

<form method="post" action="index.php?id=<?php  echo $_GET['id'];     ?>">

Nama: <input  name="nama" type="text" value="<?php  echo $mahasiswa['nama'];  ?>"> 
<br>
Jenis Kelamin: <select name="jeniskelamin">
					<option <?php echo isSelected(1,$mahasiswa['jeniskelamin']);?> value=1>Laki-laki</option>
					<option <?php echo isSelected(2,$mahasiswa['jeniskelamin']);?> value=2>Perempuan</option>
				</select>
<br>
Longitude:<input  name="longitude" type="text" value="<?php  echo $mahasiswa['longitude'];  ?>"> 
<br>
Latitude:<input  name="latitude" type="text" value="<?php  echo $mahasiswa['latitude'];  ?>"> 
<br>

<button href="index.php">Batal</button>
<input name="simpan" type="submit" value="Simpan">

</form>