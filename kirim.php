<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama = $_POST['nama'];
    $email = $_POST['email'];

    $mail = new PHPMailer(true);
    $mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';

    try {

        // Konfigurasi SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'emailsaya@gmail.com'; //ini saya ganti biar aman
        $mail->Password = 'APP_PASSWORD'; //ini saya ganti biar aman 
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Pengirim
        $mail->setFrom('emailsaya@gmail.com', 'Admin');

        // Penerima
        $mail->addAddress($email, $nama);

        // Format email
        $mail->isHTML(true);
        $mail->Subject = 'Konfirmasi Pendaftaran';

        $mail->Body = "
            <h2>Halo, $nama</h2>
            <p>Terima kasih telah melakukan pendaftaran.</p>
            <p>Pendaftaran Anda berhasil.</p>
            <br>
            <p>Salam,<br><b>Admin</b></p>
        ";

        $mail->AltBody = "Halo $nama, Terima kasih telah melakukan pendaftaran.";

        $mail->send();

        echo "Email berhasil dikirim.";

    } catch (Exception $e) {

        echo "Email gagal dikirim.<br>";
        echo "Error: {$mail->ErrorInfo}";
    }

} else {

    echo "Akses tidak diizinkan.";

}

?>
