<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
    <title>Заказ принят</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/index.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/order.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>
    <script src="<?php echo base_url(); ?>/resources/js/bubble.js"></script>
</head>
<body id="index">
<div class="container" style="margin-top: 5%; margin-bottom: 5%;">
    <div class="card shadow-lg">
        <div class="card-header py-lg-3">
            <a class="card-link border-right border-info" style="padding-right: 10px;" href="/">BS</a>
            <span class="m-0 font-weight-bold text-primary text-center" style="padding-left: 10px;">Ваш заказ принят</span>
        </div>

        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <div style="font-size: 36px;" class="center-absolute" id="bubble"></div>
                </div>
                <div class="col-lg-4">
                    <img src="<?php echo base_url();?>/resources/images/stars.png" />
                </div>
            </div>

        </div>
</div>
</body>
<script>
    $(document).ready(function() {
        var $element = $('#bubble');
        var phrases = [
            'Спасибо за покупку!',
            'И хорошоего дня!',
            'Надеюсь, мы ещё увидемся :)',
            'С любовью, ',
            'магазин BookStore.',
        ];
        var index = -1;
        (function loopAnimation() {
            index = (index + 1) % phrases.length;
            bubbleText({
                element: $element,
                newText: phrases[index],
                letterSpeed: 70,
                callback: function() {
                    setTimeout(loopAnimation, 1000);
                },
            });
        })();
    });
</script>
</html>

