<!DOCTYPE html>
<html lang="zxx">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
    <title>Информация о книге</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/index.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.0/css/bootstrap-datepicker.min.css" />
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
</head>
<body id="index">
<nav id="menu" class="navbar navbar-expand-sm fixed-top navbar-index" style="background: #ECD0CD;">
    <ul class="navbar-nav container">
        <li class="nav-item">
            <a class="navbar-brand float-left" href="/" style="color: white;"><h4 class="logo">BS</h4></a>
        </li>
        <li class="nav-item">
            <?php echo form_open('searchcontroller/searchbooks') ?>
            <input name="book_data" type="search" class="search-form" placeholder="Поиск по книгам..."/>
            <button type="submit" class="search-btn"><i class="fa fa-search"></i></button>
            <?php echo form_close() ?>
        </li>
        <li class="nav-item">
            <a data-toggle="modal" data-target="#modal-basket">
                <i class="fa fa-shopping-basket index-nav-link" style="font-size: 16px;"></i>
                <span id="countText" class="badge" style="font-size: 12px;"><?php if (!empty($booksCount)) :?><?= $booksCount ?><?php endif ?></span>
            </a>
        </li>
    </ul>
</nav>

<div class="container" style="margin-top: 10%; margin-bottom: 5%;">
    <div class="card shadow-lg">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Информация о товаре</h6>
        </div>
        <div class="card-body">
            <?php if(!empty($books)) :?>
            <?php foreach ($books as $book) { ?>
            <div class="row" style="padding-bottom: 20px; padding-right: 10px;">
                <div class="col-lg-4">
                    <img alt="" src="<?='http://bookstore/resources/images/'.$book['img_name']?>" style="max-height: 500px;"/>
                    <p><button type="button" class="btn btn-link" data-toggle="modal" data-target="#modal-review">Добавить свой отзыв</button></p>
                </div>

                <div class="col-lg-4">
                    <table class="table table-active">
                        <tbody>
                        <tr><td>Автор</td><td><?= $book['author'] ?></td></tr>
                        <tr><td>Название</td><td><?= $book['book_name'] ?></td></tr>
                        </tbody>
                    </table>
                    <p class="text-success text-center">Есть в наличии</p>
                    <p><b>Описание</b></p>
                    <span>
                        <?= $book['description'] ?>
                    </span>
                </div>

                <div class="col-lg-4" style="border: 1px solid #DFDFDF;">
                    <h2><?= $book['cost'] ?> грн</h2>
                    <p></p>
                    <?php if(!empty($bookExistInCart)) :?>
                    <?php if($bookExistInCart == true) :?>
                    <button type="button" class="btn btn-lg btn-success" disabled>Товар уже в корзине</button>
                    <?php endif ?>
                    <?php else :?>
                        <p></p>
                        <?php echo form_open('bookcontroller') ?>
                        <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>" />
                        <input type="hidden" name="book_name" value="<?= $book['book_name'] ?>" />
                        <input type="hidden" name="book_author" value="<?= $book['author'] ?>" />
                        <input type="hidden" name="book_cost" value="<?= $book['cost'] ?>" />
                        <button type="submit" class="btn btn-lg btn-outline-danger" onclick="alert('Товар успешно добавлен в корзину')">Добавить в корзину</button>
                        <?php echo form_close() ?>
                    <?php endif ?>
                    <p><b>Дата отправки</b> завтра<br/>
                    <p>Отделение "Новая почта" - 40 грн (без комиссии)<br/>
                        Курьером "Новая почта" - 55 грн<br/>
                        Отделение Justin - 15 грн<br/>
                        Отделение "Укрпочта" (оплата за перевод средств)<br/>
                        Курьерская доставка "Укрпочта" - 35 грн<br/></p>
                    <p><b>Гарантия</b> Возвращение, обмен в течение 30 дней</p>
                    <p><b>Оплата</b> Наличными при получении</p>
                </div>
            </div>
                <?php } ?>
                <?php endif ?>

            <?php if(!empty($reviews)) :?>
            <div class="card-footer">
                <h1>Отзывы</h1>
                <?php foreach($reviews as $review) { ?>
                <div class="row" style="margin-bottom: 15px;">
                    <div class="col-lg-3">
                        <p><b><?= $review['customer_name'] ?></b></p>
                        <p class="text-black-50"><?= $review['date'] ?></p>
                        <p>
                            <span class="text-warning" style="font-size: 22px;"><?= $review['mark'] ?></span>
                            <span class="text-dark" style="font-size: 14px;"> / 5</span>
                        </p>
                    </div>

                    <div class="col-lg-9">
                        <div class="card shadow">
                            <div class="card-header">
                                <h6 class="m-0 font-weight-bold text-info"><?= $review['review_title'] ?></h6>
                            </div>
                            <div class="card-body">
                                <?= $review['review_text'] ?>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
            <?php else :?>
            <div class="card-footer">
                <h1>Отзывы</h1>
                <div class="card shadow card-body" style="margin-bottom: 15px; text-align: center;">
                    <div class="centered" style="padding: 50px;">
                        <div class="col-lg-6">
                            <img width="80%" height="80%" src="<?php echo base_url()?>/resources/images/books2.png" />
                        </div>
                        <div class="col-lg-6">
                            <p class="text-info"><b>У этого товара, к сожалению, ещё нет отзывов :(</b></p>
                            <p class="text-info"><b>Возможно, Ваш отзыв станет первым!</b></p>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif ?>
        </div>
    </div>
</div>

<div id="modal-basket" class="modal fade" tabindex="-1" data-backdrop="true">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div id="modal_content" class="modal-content">
            <?php if(!empty($booksInCart)) :?>
                <div class="modal-header">
                    <span class="text-info">Корзина</span>
                </div>
                <div id="modal_body" class="modal-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <p class="text-info center" style="text-align: center;">Чтобы редактировать содержимое корзины, <br>
                                перейдите на главную страницу</p>
                        </div>
                        <div class="col-lg-12">
                        <hr class="center-horizontal" style="width:50%; height: 2px;">
                        </div>
                    </div>
                    <?php foreach($booksInCart as $bk) { ?>
                        <div id="<?= 'row_'.$bk['product_id']?>" class="row" style="border-bottom: solid 1px #DEE2E6; padding-top: 5px; margin: 5px; position: relative;">
                            <div class="col-lg-1">
                                <button type="button" class="close" disabled>
                                    <span class="text-success" aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="col-lg-7">
                                <div id="<?= 'info_'.$bk['product_id']?>">
                                    <p><?= $bk['product_author'] ?></p>
                                    <p><?= $bk['product_name'] ?></p>
                                    <p><?= $bk['product_cost'] ?> грн</p></div>
                            </div>
                            <div class="col-lg-2">
                                <div id="<?= 'input_'.$bk['product_id']?>">
                                    <input type="number" style="width: 100px; text-align: center;" min="1" max="5" value="<?= $bk['product_count'] ?>" readonly />
                                </div>
                            </div>
                            <div class="col-lg-2">
                        <span id="<?= 'book_'.$bk['product_id']?>" class="badge badge-warning" style="font-size: 18px;">
                            <?= $bk['product_cost']*$bk['product_count'] ?> грн</span>
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <div id="not_empty_footer" class="modal-footer" style="border: 0;">
                    <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">Продолжить выбор товаров</button>
                    <button type="button" class="btn btn-danger float-right" data-dismiss="modal" onclick="window.open('/order');">Оформить заказ</button>
                </div>
            <?php else:?>
                <div class="modal-header">
                    <span class="text-info">Корзина</span>
                </div>
                <div id="modal_body_empty" class="modal-body">
                    <div id="empty_body"  class="centered" style="padding: 25px; text-align: center;">
                        <div class="col-lg-6"><img width="80%" height="80%" src="<?php echo base_url() ?>/resources/images/cart_books.png" /></div>
                        <div class="col-lg-6"><p>Ваша корзина пуста.</p><p class="text-info"><b>Сделайте свой заказ прямо сейчас!</b></p></div>
                    </div>
                </div>
                <div id="empty_footer" class="modal-footer" style="border: 0;">
                    <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">Продолжить выбор товаров</button>
                </div>
            <?php endif ?>
        </div>
    </div>
</div>

<?php if(!empty($books)) :?>
<?php foreach ($books as $book) { ?>
<div id="modal-review" class="modal fade" tabindex="-1" data-backdrop="true">
    <div class="modal-lg modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <span class="text-info">Добавить отзыв</span>
            </div>
            <?php echo form_open('reviewcontroller/checkuserdata') ?>
            <div class="modal-body">
                <input type="text" name="book_id" value="<?= $book['book_id']?>" hidden/>
                <input type="text" name="book_name" value="<?= $book['book_name']?>" hidden/>
                <input type="text" name="book_author" value="<?= $book['author']?>" hidden/>
                <p style="text-align: center;">Введите ваши данные постоянного клиента</p>
                <div class="row centered">
                    <input name="review_email" type="email" placeholder="Ваш e-mail" class="input-group-text" style="text-align: left; margin-bottom: 10px; width: 40%;"/>
                </div>
                <div class="row centered">
                    <input name="review_password" type="password" placeholder="Ваш пароль" class="input-group-text" style="text-align: left; margin-bottom: 10px; width: 40%;"/>
                </div>
                <div class="row centered" style="margin-top: 10px;">
                    <button type="button" class="btn btn-link" onclick="window.open('/customer')">Стать постоянным клиентом</button>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary float-left" data-dismiss="modal">Отмена</button>
                <button type="submit" class="btn btn-danger float-right">Перейти к добавлению отзыва</button>
            </div>
            <?php echo form_close() ?>
        </div>
    </div>
</div>
<?php } ?>
<?php endif ?>
</body>
</html>