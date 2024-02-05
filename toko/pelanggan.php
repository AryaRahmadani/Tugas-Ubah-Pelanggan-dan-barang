<?php
    $host="127.0.0.1";
    $user="root";
    $password="";
    $db="dbtoko";
    $sambungan=new mysqli($host,$user,$password,$db);

    $id=0;
    $pelanggan="";
    $alamat="";
    $telp=0;

    if(isset($_GET["ubah"])){
        $id = $_GET["ubah"];
        $sql = "SELECT * FROM pelanggan WHERE id=". $id;
        $hasil = mysqli_query($sambungan, $sql);

        if(mysqli_num_rows($hasil) > 0){
            $row = mysqli_fetch_array($hasil);
            $id = $row[0];
            $pelanggan = $row[1];
            $alamat = $row[2];
            $telp = $row[3];
        }
    }
?>


<form action="" method="post">
    pelanggan:
    <input type="text" name="pelanggan" placeholder="nama pelanggan" value="<?php echo $pelanggan ?>" >
    alamat:
    <input type="text" name="alamat" placeholder="masukkan alamat"  value="<?php echo $alamat?>">
    telp:
    <input type="number" name="telp" placeholder="masukkan teml"  value="<?php echo $telp ?>">

    <input type="submit" name="simpan" value="simpan">
    
    <input type="hidden" name="id" value = "<?php echo $id ?>">
</form>

<?php
if(isset($_POST["simpan"])){
    $pelanggan =$_POST["pelanggan"];
    $alamat =$_POST["alamat"] ;
    $telp =$_POST["telp"] ;


  
        if(isset($_POST["id"])){
            
                $id = $_POST["id"];
                if($id == 0){
                    $sql = "INSERT INTO pelanggan (pelanggan,alamat,telp) VALUES ('$pelanggan', '$alamat', $telp)";
                    $hasil = mysqli_query($sambungan, $sql);
                }
                

            else{
                 $sql = "UPDATE pelanggan SET pelanggan='$pelanggan', alamat='$alamat', telp=$telp WHERE  id=" . $id;
                 $hasil = mysqli_query($sambungan, $sql);
                 header("location:http://localhost/toko/pelanggan.php");
            }
            
        }
}




if(isset($_GET["hapus"])){
    $id = $_GET["hapus"];
    $sql = "DELETE FROM pelanggan WHERE id=" . $id;
    $hasil = mysqli_query($sambungan, $sql);
}


//pelanggan
$sql="SELECT * FROM pelanggan";
$hasil =mysqli_query($sambungan,$sql);


echo "<table border=2px>
    <thead>
    <tr></tr></tr>
        <th>
            PELANGGAN
        </th>
        <th>
            ALAMAT
        </th>
        <th>
            TELEPHONE
        </th>
        <th>
            Hapus
        </th>
        <th>
            ubah
        </th>
        </tr>
    </thead>
    <tbody>";
    while($row=mysqli_fetch_array($hasil)){
        echo "<tr>";
        echo "<td>". $row[1]."</td>";
        echo "<td>".$row[2]."</td>";
        echo "<td>" .$row[3]."</td>";
        echo "<td>" . "<a href = '?hapus=".$row[0]."'>hapus</a>" . "</td>";
        echo "<td>" . "<a href = '?ubah=" . $row[0] ."'>ubah</a>" . "</td>";
        echo "</tr>";
    };
    echo "</tbody>
    </table>";
?>