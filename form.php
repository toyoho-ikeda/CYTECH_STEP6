<?php
session_start();

$errors = [];
$values = [
    'name'    => '',
    'age'     => '',
    'phone'   => '',
    'email'   => '',
    'address' => '',
    'gender'  => ''
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($values as $k => $_) {
        $values[$k] = isset($_POST[$k]) ? trim((string)$_POST[$k]) : '';
    }

    $alnumHyphenRule = '/^[a-zA-Z0-9_-]+$/';

    if ($values['name'] === '') {
        $errors['name'] = '名前を入力してください。';
    } elseif (!preg_match($alnumHyphenRule, $values['name'])) {
        $errors['name'] = '名前は半角英字・数字・アンダースコア・ハイフンのみ使用できます。';
    }

    if ($values['age'] === '') {
        $errors['age'] = '年齢を入力してください。';
    } elseif (!ctype_digit($values['age'])) {
        $errors['age'] = '年齢は半角数字で入力してください。';
    } else {
        $age = (int)$values['age'];
        if ($age < 0 || $age > 150) {
            $errors['age'] = '年齢は0から150の間で入力してください。';
        }
    }

    if ($values['phone'] === '') {
        $errors['phone'] = '電話番号を入力してください。';
    } elseif (!preg_match('/^[0-9-]+$/', $values['phone'])) {
        $errors['phone'] = '電話番号は半角数字とハイフンのみ使用できます。';
    }

    if ($values['email'] === '') {
        $errors['email'] = 'メールアドレスを入力してください。';
    } elseif (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'メールアドレスの形式が正しくありません。';
    }

    if ($values['address'] === '') {
        $errors['address'] = '住所を入力してください。';
    } elseif (!preg_match($alnumHyphenRule, $values['address'])) {
        $errors['address'] = '住所は半角英字・数字・アンダースコア・ハイフンのみ使用できます。';
    }

    $genders = ['男性', '女性', 'その他'];
    if ($values['gender'] === '' || !in_array($values['gender'], $genders, true)) {
        $errors['gender'] = '性別を選択してください。';
    }

    if (empty($errors)) {
        $_SESSION['form_values'] = $values;
        header('Location: conform.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>フォーム入力</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="page-title">
        <h1>フォーム入力</h1>
    </header>

    <main>
        <div class="form-wrapper">
            <form action="form.php" method="post" novalidate>
                <div class="form-row">
                    <label for="name">名前:</label>
                    <input type="text" id="name" name="name"
                    value="<?= htmlspecialchars($values['name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (!empty($errors['name'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['name'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="age">年齢:</label>
                    <input type="number" id="age" name="age" min="0" max="150"
                    value="<?= htmlspecialchars($values['age'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (!empty($errors['age'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['age'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="phone">電話番号:</label>
                    <input type="text" id="phone" name="phone" placeholder="例: 090-1234-5678"
                    value="<?= htmlspecialchars($values['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (!empty($errors['phone'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['phone'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="email">メールアドレス:</label>
                    <input type="email" id="email" name="email"
                        value="<?= htmlspecialchars($values['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (!empty($errors['email'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['email'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="address">住所:</label>
                    <input type="text" id="address" name="address"
                        value="<?= htmlspecialchars($values['address'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
                    <?php if (!empty($errors['address'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['address'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-row">
                    <label for="gender">性別:</label>
                    <select id="gender" name="gender" required>
                        <option value="" <?= ($values['gender'] === '' ? 'selected' : '') ?>>選択してください</option>
                        <option value="男性" <?= ($values['gender'] === '男性' ? 'selected' : '') ?>>男性</option>
                        <option value="女性" <?= ($values['gender'] === '女性' ? 'selected' : '') ?>>女性</option>
                        <option value="その他" <?= ($values['gender'] === 'その他' ? 'selected' : '') ?>>その他</option>
                    </select>
                    <?php if (!empty($errors['gender'])): ?>
                        <p class="error"><?= htmlspecialchars($errors['gender'], ENT_QUOTES, 'UTF-8') ?></p>
                    <?php endif; ?>
                </div>

                <div class="form-actions">
                    <button type="submit" id="submit" name="submit">送信</button>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
