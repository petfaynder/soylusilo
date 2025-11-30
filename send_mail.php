<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = strip_tags(trim($_POST["name"]));
    $name = str_replace(array("\r","\n"),array(" "," "),$name);
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $subject = trim($_POST["subject"]);
    $message = trim($_POST["message"]);

    // E-posta adresinizi buraya yazın
    $recipient = "info@soylusilo.com";

    // E-posta konusu
    $email_subject = "İletişim Formu: $subject";

    // E-posta içeriği
    $email_content = "Ad Soyad: $name\n";
    $email_content .= "E-posta: $email\n\n";
    $email_content .= "Konu: $subject\n";
    $email_content .= "Mesaj:\n$message\n";

    // E-posta başlıkları
    $email_headers = "From: $name <$email>\r\n";
    $email_headers .= "Reply-To: $email\r\n";
    $email_headers .= "MIME-Version: 1.0\r\n";
    $email_headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // E-postayı gönder
    if (mail($recipient, $email_subject, $email_content, $email_headers)) {
        // Başarılı olursa kullanıcıyı bilgilendir
        http_response_code(200);
        echo "Teşekkürler! Mesajınız gönderildi.";
    } else {
        // Başarısız olursa kullanıcıyı bilgilendir
        http_response_code(500);
        echo "Üzgünüz, mesajınız gönderilemedi.";
    }

} else {
    // POST isteği değilse, hata döndür
    http_response_code(403);
    echo "Hata: Bir POST isteği bekleniyor.";
}
?>
