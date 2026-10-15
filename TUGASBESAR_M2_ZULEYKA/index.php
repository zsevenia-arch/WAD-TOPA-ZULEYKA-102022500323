<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "db_masalahit"; 

$koneksi = mysqli_connect($host, $user, $pass, $db);

if (isset($_POST['simpan'])) {
    $jenis_gangguan    = $_POST['jenis_gangguan'];
    $kategori          = $_POST['kategori'];
    $tingkat_prioritas = $_POST['tingkat_prioritas'];

    $query = "INSERT INTO tabel_gangguan (jenis_gangguan, kategori, tingkat_prioritas) VALUES ('$jenis_gangguan', '$kategori', '$tingkat_prioritas')";
    mysqli_query($koneksi, $query);
    
    header("Location: index.php");
}
?>         

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul A - Kategori & Prioritas Gangguan IT</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
     <div class="container">
        <h1>Pengelolaan Master Jenis Gangguan & Prioritas IT</h1>
        <hr>

        <h3>Form Tambah Gangguan</h3>
        <form action="" method="POST">
            <label>Jenis Gangguan:</label>
            <input type="text" name="jenis_gangguan" placeholder="Contoh: Koneksi LAN Putus" required>
            
            <label>Kategori:</label>
            <select name="kategori" required>
                <option value="" disabled selected>Pilih Kategori Gangguan</option>
                <option value="Hardware">Hardware</option>
                <option value="Software">Software</option>
                <option value="Network">Network</option>
            </select>

            <label>Tingkat Prioritas:</label>
            <select name="tingkat_prioritas" required>
                <option value="" disabled selected>Pilih Tingkat Prioritas</option>
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>

            <button type="submit" name="simpan">Simpan</button>
        </form>

        <hr>

        <h3>Daftar Master Gangguan & Tingkat Prioritas</h3>
        <table>
            <tr>
                <th>No</th>
                <th>Jenis Gangguan</th>
                <th>Kategori</th>
                <th>Tingkat Prioritas</th>
                <th>Aksi</th>
            </tr>
            
            <?php
            $no = 1;
            $ambil_data = mysqli_query($koneksi, "SELECT * FROM tabel_gangguan");
            
            if($ambil_data) {
                while($tampil = mysqli_fetch_array($ambil_data)){
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $tampil['jenis_gangguan']; ?></td>
                <td><?php echo $tampil['kategori']; ?></td>
                <td><?php echo $tampil['tingkat_prioritas']; ?></td>
                <td>
                    
                    <a href="hapus.php?id=<?php echo $tampil['id']; ?>" style="background-color: #db2777; color: white; padding: 6px 12px; border-radius: 4px; text-decoration: none;" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                </td>
            </tr>
            <?php 
                }
            } 
            ?>
        </table> 
    </div>      
</body>
</html>