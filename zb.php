<!DOCTYPE html>
<html>
<head>
    <title>老张的玄学实验室</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .coin-container {
          
            flex-wrap: wrap;
            justify-content: center;
            min-width: 340px;
        }

        .coin {
            display: inline-block;
            width: 100px;
            height: 100px;
            cursor: pointer;
            margin: 10px;
            background-color: #fff;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s;
        }

        .coin.front {
            background-image: url('coin1.png');
            background-size: cover;
        }

        .coin.back {
            background-image: url('coin0.png');
            background-size: cover;
        }

        .row {
            clear: both;
            border-top: 1px solid #000;
            padding-top: 10px;
            margin-top: 10px;
        }

        .result-container {
            margin-top: 20px;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px;
            background-color: #f1f1f1;
            text-align: center;
        }

        .summary {
            margin-top: 20px;
            font-weight: bold;
            border-radius: 10px;
            padding: 10px;
            background-color: #fff;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            white-space: pre-wrap;
            text-align: left;
            position: relative;
        }



        .summary::before {
            content: "";
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
            top: 50%;
            width: 100%;
            height: 1px;
            background-color: red;
            z-index: 1;
        }

        .summary .first-lines,
        .summary .last-lines {
            position: relative;
            z-index: 2;
        }

        .query-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
        }

        .dialog-container {
            position: relative;
            text-align: center;
            margin-top: 20px;
        }

        .dialog-bubble {
            display: inline-block;
            background-color: #4CAF50;
            color: #fff;
            padding: 10px;
            border-radius: 5px;
            position: absolute;
            top: -40px;
            left: 50%;
            transform: translateX(-50%);
        }

        .dialog-bubble img {
            max-width: 100%;
            height: auto;
        }
    </style>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.coin').click(function() {
                $(this).toggleClass('front back');
                updateResults();
            });

            function updateResults() {
                $('.row').each(function() {
                    var frontCount = $(this).find('.coin.front').length;
                    var backCount = $(this).find('.coin.back').length;
                    var result = '';

                    if (frontCount === 2) {
                        result = '阳 —  ';
                    } else if (backCount === 2) {
                        result = '阴 - -  ';
                    } else if (frontCount === 3) {
                        result = '阴 - - 变爻';
                    } else if (backCount === 3) {
                        result = '阳 — 变爻';
                    }

                    $(this).find('.result').text(result);
                });

                updateSummary();
            }

            function updateSummary() {
                var summary = '';
                $('.row').each(function() {
                    var rowResult = $(this).find('.result').text();
                    summary += rowResult + '\n';
                });

                $('.summary').text(summary);
            }

            function showImageDialog() {
                var dialogContainer = $('.dialog-container');
                var dialogBubble = $('<div class="dialog-bubble"><img src="R.png" alt="R"></div>');
                dialogContainer.append(dialogBubble);
            }

            $('.query-button').click(function() {
                showImageDialog();
            });
        });
    </script>
</head>
<body>
    <h1>掷币占卜</h1>
    <h5>方法：取三枚钱币，一齐投掷 把结果记录在本网页中，一共六次 可以得到卦象。为什么不用随机数？那都是伪随机！ 你没有硬币就裁三个纸片啥的也行，主打一个心诚则灵。</h5>
    <div class="coin-container">
        <?php
            $numCoins = 18; // 总共的硬币数量
            $coinsPerRow = 3; // 每行的硬币数量
            $numRows = ceil($numCoins / $coinsPerRow); // 计算总行数
            $coinsRemaining = $numCoins;

            for ($row = 0; $row < $numRows; $row++) {
                echo '<div class="row">';
                for ($col = 0; $col < $coinsPerRow; $col++) {
                    $coinClass = ($coinsRemaining > 0) ? 'coin front' : 'coin hidden';
                    echo '<div class="' . $coinClass . '"></div>';
                    $coinsRemaining--;
                }
                echo '<div class="result-container"><div class="result"></div></div>'; // 显示结果的元素
                echo '</div>';
            }
        ?>
    </div>
    <h3>下面是结果：</h3>
    <div class="summary">
        <div class="first-lines"></div>
        <!-- 前三行的内容 -->
        <div class="last-lines"></div>
        <!-- 后三行的内容 -->
    </div>
    <div class="query-button">卦象查询</div>
    <div class="dialog-container"></div>
</body>
</html>
