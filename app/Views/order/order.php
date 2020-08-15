<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
    <title>Оформить заказ</title>
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
</head>
<body id="index">
<div class="container" style="margin-top: 5%; margin-bottom: 5%;">
    <div class="card shadow-lg">
        <div class="card-header py-lg-3">
            <a class="card-link border-right border-info" style="padding-right: 10px;" href="/">BS</a>
            <span class="m-0 font-weight-bold text-primary text-center" style="padding-left: 10px;">Оформление заказа</span>
        </div>

        <div class="card-body">
            <div class="row centered">
                <button type="button" class="btn btn-light btn-link" style="margin: 5px;" onclick="show(1);">Я новый покупатель</button>
                <button type="button" class="btn btn-light btn-link" style="margin: 5px;" onclick="show(0);">Я постоянный клиент</button>
            </div>

            <div class="row">
                <div class="col-lg-8" id="just_customer">
                    <form style="margin-left: 5%; margin-right: 5%;" method="post" action="ordercontroller/addOrder">
                        <div class="form-group">
                            <div class="row">
                                <label class="col-form-label" for="phone">Ваш телефон:</label>
                                <input name="order_phone"  class="form-control" type="tel" id="phone" placeholder="Введите номер мобильного телефона">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-form-label" for="fullname">Ваши ФИО:</label>
                                <input name="order_full_name" type="text" class="form-control" id="fullname" placeholder="Введите фамилию, имя и отчество">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-form-label" for="address">Ваш адрес:</label>
                                <input name="order_address" type="text" class="form-control" id="address" placeholder="Введите адрес для отправки посылки">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <label class="col-form-label" for="email">Ваш e-mail:</label>
                                <input name="order_email" type="email" class="form-control" id="email" placeholder="Введите e-mail">
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row centered">
                                <button type="submit" class="btn btn-lg btn-danger">Заказать</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="col-lg-8" id="regular_customer" style="display: none;">
                    <p style="text-align: center; margin-top: 5%;">Введите ваши данные постоянного клиента</p>
                    <form method="post" action="ordercontroller/addorderfromcustomer">
                    <div class="row centered">
                        <input name="regular_email" type="email" placeholder="Ваш e-mail" class="input-group-text" style="text-align:left; margin-bottom: 10px; width: 40%;"/>
                    </div>
                    <div class="row centered">
                        <input name="regular_password" type="password" placeholder="Ваш пароль" class="input-group-text" style="text-align:left; margin-bottom: 10px; width: 40%;"/>
                    </div>
                    <div class="row centered" style="margin-top: 10px;">
                        <button type="button" class="btn btn-link" onclick="window.open('/customer')">Стать постоянным клиентом</button>
                    </div>
                    <div class="card-body">
                        <div class="row centered">
                            <button type="submit" class="btn btn-lg btn-danger">Заказать</button>
                        </div>
                    </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="card shadow">
                        <div class="card-body">
                            <?php if (!empty($booksInCart)) :?>
                            <?php foreach ($booksInCart as $book) { ?>
                            <div class="row" style="border-bottom: 1px solid #E8E8E8; margin-bottom: 10px;">
                                <div class="col-lg-8 order">
                                    <h2><?= $book['product_author'] ?></h2>
                                    <h3><?= $book['product_name'] ?></h3>
                                    <p class="text-dark"><?= $book['product_count'] ?> шт.</p>
                                </div>
                                <div class="col-lg-4">
                                    <span class="badge badge-warning" style="margin-top: 25px; font-size: 18px;"><?= $book['product_cost']*$book['product_count']?> грн</span>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="row">
                                <div class="col-lg-8">
                                    <span>Сумма заказа</span>
                                </div>
                                <div class="col-lg-4">
                                    <?php if (!empty($totalSum)) :?>
                                    <span class="badge badge-success" style="font-size: 16px;"><?= $totalSum ?> грн</span>
                                    <?php endif ?>
                                </div>
                            </div>
                            <?php endif ?>
                        </div>
                        <?php if(!empty($file_name)) :?>
                        <div class="card-footer">
                            <div class="row centered">
                                <a href="<?php echo base_url(); ?>/files/<?= $file_name ?>.txt" class="btn btn-warning"
                                   data-tooltip="Скачать файл с содержимым Вашего заказа"
                                   data-tooltip-location="bottom" download>Скачать файл</a>
                            </div>
                        </div>
                        <?php endif ?>
                    </div>
                </div>
            </div>
        </div>

</div>
</div>

<script>
    $(document).ready(function() {
        show(1);
    });

    function show(tab) {
        if (tab === 1) {
            document.getElementById('regular_customer').hidden = true;
            document.getElementById('just_customer').hidden = false;
        } else {
            document.getElementById('regular_customer').hidden = false;
            $("#regular_customer").css('display', 'block');
            document.getElementById('just_customer').hidden = true;
        }
    }

    $(function () {
        $('#phone').mask("+38 (099) 99-99-999");
    });
</script>
</body>
</html>
