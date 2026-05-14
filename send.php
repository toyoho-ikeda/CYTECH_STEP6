<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

    header('Location: contact.php');

    exit;
}

$name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');

$companyName = htmlspecialchars($_POST['companyName'], ENT_QUOTES, 'UTF-8');

$email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');

$age = htmlspecialchars($_POST['age'], ENT_QUOTES, 'UTF-8');

$message = htmlspecialchars($_POST['message'], ENT_QUOTES, 'UTF-8');


$mailMessage = "名前：" . $name . "\n";

$mailMessage .= "会社名：" . $companyName . "\n";

$mailMessage .= "メールアドレス：" . $email . "\n";

$mailMessage .= "年齢：" . $age . "\n";

$mailMessage .= "お問い合わせ内容：" . $message . "\n";


$result = mail(
    $email,
    'お問い合わせ内容',
    $mailMessage
);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">

    <title>お問い合わせフォーム - 送信完了画面</title>

    <link rel="stylesheet" href="style.css">
</head>

<body>

<h1>
    お問い合わせフォーム - 送信完了画面
</h1>

<?php if ($result): ?>

    <p>
        お問い合わせが送信されました。ありがとうございます！
    </p>

<?php else: ?>

    <p>
        メール送信に失敗しました。
    </p>

<?php endif; ?>


<a href="contact.php">
    お問い合わせフォームに戻る
</a>

</body>
</html>