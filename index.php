<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Aplikasi Harvard</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="logo">
            <img src="harvard_logo.png" alt="Harvard Logo">
        </div>
        <nav>
            <ul>
                <li><a href="#">Beranda</a></li>
                <li><a href="#application-form">Aplikasi</a></li>
                <li><a href="#information">Informasi</a></li>
                <li><a href="#contact">Kontak</a></li>
                <li><a href="#support">Bantuan dan Dukungan</a></li>
                <li><a href="#application-management">Manajemen Aplikasi</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <!-- Halaman Utama -->
        <section class="hero">
            <div class="hero-content">
                <h1>Selamat Datang di Portal Aplikasi Harvard</h1>
                <p>Pengumuman penting tentang tenggat waktu aplikasi atau informasi terbaru.</p>
                <a href="#application-form" class="btn-action">Mulai Aplikasi</a>
            </div>
        </section>

        <section id="information" class="about">
            <div class="about-content">
                <h2>Tentang Harvard</h2>
                <p>Informasi singkat tentang universitas, misi, dan nilai-nilai inti Harvard.</p>
                <a href="#" class="btn-learn-more">Pelajari Lebih Lanjut</a>
            </div>
        </section>

        <!-- Formulir Aplikasi -->
        <section id="application-form" class="application-form">
            <h2>Formulir Aplikasi Harvard</h2>
            <form action="index.php#application-form" method="POST">
                <label for="fullname">Nama Lengkap:</label>
                <input type="text" id="fullname" name="fullname" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="phone">Nomor Telepon:</label>
                <input type="tel" id="phone" name="phone" required>

                <label for="birthdate">Tanggal Lahir:</label>
                <input type="date" id="birthdate" name="birthdate" required>

                <label for="gender">Jenis Kelamin:</label>
                <select id="gender" name="gender" required>
                    <option value="male">Laki-laki</option>
                    <option value="female">Perempuan</option>
                    <option value="other">Lainnya</option>
                </select>

                <label for="program">Program Pilihan:</label>
                <select id="program" name="program" required>
                    <option value="undergraduate">Sarjana (Undergraduate)</option>
                    <option value="graduate">Pascasarjana (Graduate)</option>
                    <option value="phd">Doktoral (PhD)</option>
                </select>

                <label for="essay">Esai Motivasi:</label>
                <textarea id="essay" name="essay" rows="4" required></textarea>

                <button type="submit" class="btn-submit">Kirim Aplikasi</button>
            </form>
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "harvard_applications";

                // Buat koneksi
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Periksa koneksi
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Ambil data dari formulir
                $fullname = $_POST['fullname'];
                $email = $_POST['email'];
                $phone = $_POST['phone'];
                $birthdate = $_POST['birthdate'];
                $gender = $_POST['gender'];
                $program = $_POST['program'];
                $essay = $_POST['essay'];

                // Buat kueri untuk menyimpan data
                $sql = "INSERT INTO applications (fullname, email, phone, birthdate, gender, program, essay)
                        VALUES ('$fullname', '$email', '$phone', '$birthdate', '$gender', '$program', '$essay')";

                if ($conn->query($sql) === TRUE) {
                    echo "<p>Aplikasi berhasil dikirim.</p>";
                } else {
                    echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                }

                $conn->close();
            }
            ?>
        </section>

        <!-- Bantuan dan Dukungan -->
        <section id="support" class="support">
            <h2>Bantuan dan Dukungan</h2>
            <p>Jika Anda memiliki pertanyaan atau memerlukan bantuan, silakan hubungi tim dukungan kami:</p>
            <ul>
                <li>Email: support@harvard.edu</li>
                <li>Telepon: +1-617-495-2000</li>
                <li>Jam Dukungan: Senin-Jumat, 9:00 - 17:00 (ET)</li>
            </ul>
            <p>Atau kunjungi <a href="#">Pusat Bantuan</a> kami untuk informasi lebih lanjut.</p>
        </section>

        <!-- Manajemen Aplikasi -->
        <section id="application-management" class="application-management">
            <h2>Manajemen Aplikasi</h2>
            <table>
                <thead>
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Email</th>
                        <th>Program</th>
                        <th>Status Aplikasi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "root";
                    $password = "";
                    $dbname = "harvard_applications";

                    // Buat koneksi ke basis data
                    $conn = new mysqli($servername, $username, $password, $dbname);

                    // Periksa koneksi
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Ambil data aplikasi
                    $sql = "SELECT fullname, email, program, status FROM applications";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        // Tampilkan data dalam tabel
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row['fullname'] . "</td>";
                            echo "<td>" . $row['email'] . "</td>";
                            echo "<td>" . $row['program'] . "</td>";
                            echo "<td>" . $row['status'] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>Tidak ada aplikasi.</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </section>
    </main>

    <footer>
        <nav>
            <ul>
                <li><a href="#">Kebijakan Privasi</a></li>
                <li><a href="#">Syarat dan Ketentuan</a></li>
                <li><a href="#">FAQ</a></li>
                <li><a href="#">Kontak</a></li>
            </ul>
        </nav>
        <div class="contact-info">
            <p>Hubungi kami: Universitas Harvard, 123 Harvard Yard, Cambridge, MA 02138, USA</p>
            <p>Email: info@harvard.edu | Telepon: +1-617-495-1000</p>
        </div>
    </footer>
</body>
</html>
