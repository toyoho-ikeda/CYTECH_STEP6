<?php
session_start();
$values = $_SESSION['form_values'] ?? null;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <title>入力内容確認</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<h1>入力内容確認</h1>
    <?php if (!$values): ?>
        <p>セッション情報がありません。<a href="form.php">戻る</a></p>
    <?php else: ?>
        <div class="confirm-wrapper">
            <p>名前：<?= htmlspecialchars($values['name']) ?></p>
            <p>年齢：<?= htmlspecialchars($values['age']) ?></p>
            <p>電話番号：<?= htmlspecialchars($values['phone']) ?></p>
            <p>メール：<?= htmlspecialchars($values['email']) ?></p>
            <p>住所：<?= htmlspecialchars($values['address']) ?></p>
            <p>性別：<?= htmlspecialchars($values['gender']) ?></p>
        </div>
        <p><a href="form.php">戻る</a></p>
    <?php endif; ?>
</body>
</html>