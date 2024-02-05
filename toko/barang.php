<?php
$host="127.0.0.1";
$user="root";
$password="";
$db="dbtoko";
$penyambung=new mysqli($host,$user,$password,$db);

$id=0;
$barang="";
$harga=0;
$stock=0;

if(isset($_GET["ubah"])){
    $id=$_GET["ubah"];
    $sql = "SELECT * FROM barang WHERE id=".$id;
    $hasil = mysqli_query($penyambung, $sql);

    if(mysqli_num_rows($hasil) > 0){
        $row=mysqli_fetch_array($hasil);
        $id = $row[0];
        $barang = $row[1];
        $harga = $row[2];
        $stock = $row[3];
    }
}


?>
<form action="" method="post">
    barang:
    <input type="text" name="barang" placeholder="nama barang" value = "<?php echo $barang  ?>" >
    <br>
    harga:
    <input type="number" name="harga" placeholder="harga barang" value = "<?php echo $harga?>">
    <br>
    stock:
    <input type="number" name="stock" placeholder="stock barang" value = "<?php echo $stock?>">
    
    <input type="submit" name="simpan" value="simpan">
    <input type="hidden" name="id" value ="<?php echo $id?>">
</form>

<?php


if(isset($_POST["simpan"])){
    $barang = $_POST["barang"];
    $harga =$_POST["harga"];
    $stock =$_POST["stock"];

    if(isset($_POST["id"])){
        if($id == 0){
            $sql = "INSERT INTO barang (barang,harga,stock) VALUES ('$barang',$harga,$stock)";
            $hasil = mysqli_query($penyambung, $sql);
        }
       else{
            $sql = "UPDATE barang SET barang='$barang', harga=$harga, stock=$stock WHERE id=".$id;
            $hasil = mysqli_query($penyambung, $sql);
            header ("location:http://localhost/toko/barang.php");
       }
    }

}

if(isset($_GET["hapus"])){
    $id = $_GET["hapus"];
    $sql = "DELETE FROM barang WHERE id=" . $id;
    $hasil = mysqli_query($penyambung, $sql);
}
// $barang = "Lamborghini";
// $harga = 50000000000000;
// $stock = 2;
// $sql = "INSERT INTO barang (barang,harga,stock) VALUES ('$barang',$harga,$stock)";
// $hasil = mysqli_query($koneksi, $sql);

// $pelanggan = "fian";
// $alamat = "kemiri";
// $telp = 573639192;
//  $sql="INSERT INTO pelanggan (pelanggan,alamat,telp) VALUES ('$pelanggan','$alamat',$telp)";
//  $hasil = mysqli_query($koneksi, $sql);



$sql="SELECT * FROM barang";

$hasil=mysqli_query($penyambung,$sql);
var_dump($hasil);
echo "<table border=2px>
    <thead>
            <tr>
                <th>
                    BARANG
                </th>
                <th>
                    HARGA
                </th>
                <th>
                    STOCK
                </th>
                <th>
                    Hapus
                </th>
                <th>
                    Ubah
                </th>
            </tr>
    </thead>
<tbody>";
while($row=mysqli_fetch_array($hasil)){
    echo "<tr>";
    echo "<td>" . $row[1]. "</td>";
    echo "<td>" . $row[2]. "</td>";
    echo "<td>" . $row[3]."</td>"; 
    echo "<td>" . "<a href = '?hapus=".$row[0]."'>hapus</a>" . "</td>";
    echo "<td>" . "<a href = '?ubah=".$row[0]."'>ubah</a>" . "</td>";
    echo "</tr>";
}
echo "</tbody>
</table>";
// //pelanggan
// $sql="SELECT * FROM pelanggan";
// $hasil =mysqli_query($koneksi,$sql);
// echo "<table border=2px>
//     <thead>
//     <tr></tr></tr>
//         <th>
//             PELANGGAN
//         </th>
//         <th>
//             ALAMAT
//         </th>
//         <th>
//             TELEPHONE
//         </th>
//         </tr>
//     </thead>
//     <tbody>";
//     while($row=mysqli_fetch_array($hasil)){
//         echo "<tr>";
//         echo "<td>". $row[1]."</td>";
//         echo "<td>".$row[2]."</td>";
//         echo "<td>" .$row[3]."</td>";
//         echo "</tr>";
//     };
//     echo "</tbody>
//     </table>";
?>