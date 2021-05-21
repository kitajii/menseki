<?php
session_start();
//エラーチェック

if (!empty($_POST)) {

    $_POST['edge-a'] = mb_convert_kana($_POST['edge-a'], 'n', 'UTF-8');
    $_POST['edge-b'] = mb_convert_kana($_POST['edge-b'], 'n', 'UTF-8');
    $_POST['edge-c'] = mb_convert_kana($_POST['edge-c'], 'n', 'UTF-8');

    /////////////////////////////////////input-unit

    if (!isset($_POST['input-unit'])) {
        $error['input-unit'] = 'blank';
    }

    /////////////////////////////////////辺a
    if ($_POST['edge-a'] === '') {
        $error['edge-a'] = 'blank';
    }

    if ($_POST['edge-a'] < 1) {
        $error['edge-a'] = 'minus';
    }

    if (!is_numeric($_POST['edge-a'])) {
        $error['edge-a'] = 'letter';
    }

    /////////////////////////////////////辺b
    if ($_POST['edge-b'] === '') {
        $error['edge-b'] = 'blank';
    }

    if ($_POST['edge-b'] < 1) {
        $error['edge-b'] = 'minus';
    }

    if (!is_numeric($_POST['edge-b'])) {
        $error['edge-b'] = 'letter';
    }

    /////////////////////////////////////辺c
    if ($_POST['edge-c'] === '') {
        $error['edge-c'] = 'blank';
    }

    if ($_POST['edge-c'] < 1) {
        $error['edge-c'] = 'minus';
    }

    if (!is_numeric($_POST['edge-c'])) {
        $error['edge-c'] = 'letter';
    }

    /////////////////////////////////////面A

    if ($_POST['face-a'] === '') {
        $error['face-a'] = 'blank';
    }

    /////////////////////////////////////面B

    if ($_POST['face-b'] === '') {
        $error['face-b'] = 'blank';
    }
    /////////////////////////////////////面C

    if ($_POST['face-c'] === '') {
        $error['face-c'] = 'blank';
    }

    /////////////////////////////////////output-unit

    if (!isset($_POST['output-unit'])) {
        $error['output-unit'] = 'blank';
    }

    if (empty($error)) {
        $_SESSION['element'] = $_POST;
        header('Location:result.php');
        exit();
    }
}

if ($_REQUEST['action'] == 'rewrite' && isset($_SESSION['element'])) {
    $_POST = $_SESSION['element'];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menseki!【箱モノ面積計算アプリ】</title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/stylesheet.css" />
</head>

<body>

    <h1>Menseki!</h1>
    <h2>各値を入力して箱の面積を計算しよう！</h2>
    <!-- 単位選択 -->
    <form action="" method="post">
        <div class="input-unit">
            <p>入力する単位：
                <input type="radio" name="input-unit" value="mm" <?php if (isset($_POST['input-unit']) && $_POST['input-unit'] == "mm") echo 'checked'; ?>>㎜ ／
                <input type="radio" name="input-unit" value="cm" <?php if (isset($_POST['input-unit']) && $_POST['input-unit'] == "cm") echo 'checked'; ?>>㎝ ／
                <input type="radio" name="input-unit" value="m" <?php if (isset($_POST['input-unit']) && $_POST['input-unit'] == "m") echo 'checked'; ?>>m
            </p>
            <?php if ($error['input-unit'] === 'blank') : ?>
                <p class="error">&nbsp;※ 単位を選択してください</p>
            <?php endif; ?>
        </div>

        <!-- boxイラスト内 -->
        <div class="box">
            <img src="./image/cube.png" alt="box">
            <!-- 長さ -->
            <div class="edges">
                <div class="edge-a">
                    <label for="edge-a">辺 a</label><br>
                    <input class="input-edge" size="9" type="number" min="1" name="edge-a" placeholder="数字を入力" value="<?php echo htmlspecialchars($_POST['edge-a'], ENT_QUOTES); ?>">
                </div>
                <div class="edge-b">
                    <label for="edge-b">辺 b</label><br>
                    <input class="input-edge" size="9" type="number" min="1" name="edge-b" placeholder="数字を入力" value="<?php echo htmlspecialchars($_POST['edge-b'], ENT_QUOTES); ?>">


                </div>

                <div class="edge-c">
                    <label for="edge-c">辺 c</label><br>
                    <input class="input-edge" size="9" type="number" min="1" name="edge-c" placeholder="数字を入力" value="<?php echo htmlspecialchars($_POST['edge-c'], ENT_QUOTES); ?>">
                </div>
            </div>

            <!-- 面の数 -->
            <div class="faces">
                <div class="face-a">
                    <p class="face-name">A</p>
                    <select class="input-face" name="face-a" ?>">
                        <option value="1" <?php echo array_key_exists('face-a', $_POST) && $_POST['face-a'] == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo array_key_exists('face-a', $_POST) && $_POST['face-a'] == '2' ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo array_key_exists('face-a', $_POST) && $_POST['face-a'] == '3' ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo array_key_exists('face-a', $_POST) && $_POST['face-a'] == '4' ? 'selected' : ''; ?>>4</option>
                    </select>
                    <span>面</span>
                </div>

                <div class="face-b">
                    <p class="face-name">B</p>
                    <select class="input-face" name="face-b" value="<?php echo $_POST['face-b']; ?>">
                        <option value="1" <?php echo array_key_exists('face-b', $_POST) && $_POST['face-b'] == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo array_key_exists('face-b', $_POST) && $_POST['face-b'] == '2' ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo array_key_exists('face-b', $_POST) && $_POST['face-b'] == '3' ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo array_key_exists('face-b', $_POST) && $_POST['face-b'] == '4' ? 'selected' : ''; ?>>4</option>
                    </select>
                    <span>面</span>
                </div>

                <div class="face-c">
                    <p class="face-name">C</p>
                    <select class="input-face" name="face-c" value="<?php echo $_POST['face-c']; ?>">
                        <option value="1" <?php echo array_key_exists('face-c', $_POST) && $_POST['face-c'] == '1' ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo array_key_exists('face-c', $_POST) && $_POST['face-c'] == '2' ? 'selected' : ''; ?>>2</option>
                        <option value="3" <?php echo array_key_exists('face-c', $_POST) && $_POST['face-c'] == '3' ? 'selected' : ''; ?>>3</option>
                        <option value="4" <?php echo array_key_exists('face-c', $_POST) && $_POST['face-c'] == '4' ? 'selected' : ''; ?>>4</option>
                    </select>
                    <span>面</span>
                </div>
            </div>

            <?php
            if ($error['edge-a'] === 'blank' or $error['edge-a'] === 'minus' or $error['edge-a'] === 'letter') {
                echo '<p class="error">※ 辺aに0以上の整数を入力してください</p>';
            }
            if ($error['edge-b'] === 'blank' or $error['edge-b'] === 'minus' or $error['edge-b'] === 'letter') {
                echo '<p class="error">※ 辺bに0以上の整数を入力してください</p>';
            }
            if ($error['edge-c'] === 'blank' or $error['edge-c'] === 'minus' or $error['edge-c'] === 'letter') {
                echo '<p class="error">※ 辺cに0以上の整数を入力してください</p>';
            }
            ?>


        </div>
        <div class="output-unit">
            <p>結果を
                <input type="radio" name="output-unit" value="mm" <?php if (isset($_POST['output-unit']) && $_POST['output-unit'] == "mm") echo 'checked'; ?>>㎟ ／
                <input type="radio" name="output-unit" value="cm" <?php if (isset($_POST['output-unit']) && $_POST['output-unit'] == "cm") echo 'checked'; ?>>㎠ ／
                <input type="radio" name="output-unit" value="m" <?php if (isset($_POST['output-unit']) && $_POST['output-unit'] == "m") echo 'checked'; ?>>㎡
                で表示する
            </p>
            <?php if ($error['output-unit'] === 'blank') : ?>
                <p class="error">&nbsp;※ 単位を選択してください</p>
            <?php endif; ?>
        </div>


        <input class="btn" type="submit" value="面積を表示">
    </form>
</body>

</html>