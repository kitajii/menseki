<?php
session_start();

//直接result.phpを開いた場合、index.phpにページ遷移
if (!isset($_SESSION['element'])) {
	header('Location: index.php');
	exit();
}

//各面の面積定義
$areaA = $_SESSION['element']['edge-a'] * $_SESSION['element']['edge-c'];
$areaB = $_SESSION['element']['edge-b'] * $_SESSION['element']['edge-c'];
$areaC = $_SESSION['element']['edge-a'] * $_SESSION['element']['edge-b'];

//各面の面積 * 面の枚数を定義
$totalAreaA = $areaA * $_SESSION['element']['face-a'];
$totalAreaB = $areaB * $_SESSION['element']['face-b'];
$totalAreaC = $areaC * $_SESSION['element']['face-c'];

//総面積の定義
$totalArea = $totalAreaA + $totalAreaB + $totalAreaC;

//入力と出力の単位が同じ場合
if ($_SESSION['element']['input-unit'] === $_SESSION['element']['output-unit']) {
    $ans = $totalArea;
    if ($_SESSION['element']['output-unit'] === 'mm') {
        $unit = '㎟';
    } elseif ($_SESSION['element']['output-unit'] === 'cm') {
        $unit = '㎠';
    } elseif ($_SESSION['element']['output-unit'] === 'm') {
        $unit = '㎡';
    }
}

//単位変換による計算結果数値合わせ＋単位表記変更

if ($_SESSION['element']['output-unit'] === 'mm') {
    if ($_SESSION['element']['input-unit'] === 'cm') {
        $ans = $totalArea * 100;
    } elseif ($_SESSION['element']['input-unit'] === 'm') {
        $ans = $totalArea * 1000000;
    }

    $unit = '㎟';
}

if ($_SESSION['element']['output-unit'] === 'cm') {
    if ($_SESSION['element']['input-unit'] === 'mm') {
        $ans = $totalArea / 100;
    } elseif ($_SESSION['element']['input-unit'] === 'm') {
        $ans = $totalArea * 10000;
    }

    $unit = '㎠';
}

if ($_SESSION['element']['output-unit'] === 'm') {
    if ($_SESSION['element']['input-unit'] === 'mm') {
        $ans = $totalArea / 1000000;
    } elseif ($_SESSION['element']['input-unit'] === 'cm') {
        $ans = $totalArea / 10000;
    }

    $unit = '㎡';
}

//小数の表記を指数表記から整数表記へ
$result = round(sprintf("%f", $ans), 4);

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menseki!【箱モノ面積計算アプリ】</title>
    <link rel="stylesheet" href="./css/reset.css" />
    <link rel="stylesheet" href="./css/result.css" />
</head>

<body>
    <h1>Menseki!</h1>
    <h2>計算結果</h2>
    <!-- boxイラスト内 -->
    <div class="box-wrapper">
        <img src="./image/cube.png" alt="box">
        <!-- 長さ -->
        <div class="edges">
            <div class="edge-a">
                <label for="edge-a">辺 a</label>
                <div class="edge-a-input">
                    <span class=""><?php echo $_SESSION['element']['edge-a'] . $_SESSION['element']['input-unit'] ?></span>
                </div>
            </div>

            <div class="edge-b">
                <label for="edge-b">辺 b</label>
                <div class="edge-a-input">
                    <span class=""><?php echo $_SESSION['element']['edge-b'] . $_SESSION['element']['input-unit'] ?></span>
                </div>
            </div>

            <div class="edge-c">
                <label for="edge-a">辺 c</label>
                <div class="edge-a-input">
                    <span class=""><?php echo $_SESSION['element']['edge-c'] . $_SESSION['element']['input-unit'] ?></span>
                </div>
            </div>
        </div>

        <!-- 面の数 -->
        <div class="faces">
            <div class="face-a">
                <p class="face-name">A</p>
                <span class=""><?php echo $_SESSION['element']['face-a'] . '面' ?></span>
            </div>

            <div class="face-b">
                <p class="face-name">B</p>
                <span class=""><?php echo $_SESSION['element']['face-b'] . '面' ?></span>
            </div>

            <div class="face-c">
                <p class="face-name">C</p>
                <span class=""><?php echo $_SESSION['element']['face-c'] . '面' ?></span>
            </div>
        </div>
    </div>

    <div class="result-wrapper">
        <h3>計算結果</h3>
        <p class="result"><b><?php echo $result . $unit; ?></b></p>
    </div>
    <p class="sup">※小数点第5位は四捨五入されます。（例：3.14159→3.1416）</p>

    <a class="btn" href="index.php?action=rewrite">値を変更する</a>

</body>

</html>