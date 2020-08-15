<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
    <title>Результаты поиска</title>
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
        <a data-toggle="modal" data-target="#modal-basket">
            <i class="fa fa-shopping-basket index-nav-link" style="font-size: 16px;"></i>
            <span id="countText" class="badge" style="font-size: 12px;"><?php if (!empty($booksCount)) :?><?= $booksCount ?><?php endif ?></span>
        </a>
    </ul>
</nav>

<div class="container" style="margin-top: 10%; margin-bottom: 5%;">
    <div class="card shadow">
        <div class="card-header py-lg-3">
            <h6 class="m-0 font-weight-bold text-primary">Результаты поиска</h6>
        </div>
        <div class="card-body">
            <?php if(!empty($books)) :?>
            <?php foreach($books as $book) { ?>
            <div class="row centered">
                <div class="col-lg-3" style="margin: 2%;">
                    <div class="product-item">
                        <img alt="" src="<?='http://bookstore/resources/images/'.$book['img_name']?>" />
                        <div class="product-list">
                            <h2><?= $book['author'] ?></h2>
                            <h3><?= $book['book_name'] ?></h3>
                            <span class="price">₴ <?= $book['cost'] ?></span>
                            <button type="button" class="button-basket" onclick="window.open('/book_info/<?= $book['book_id'] ?>')">Посмотреть</button>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            <?php else: ?>
                <div class="centered" style="padding: 50px; text-align: center;">
                    <div class="col-lg-6">
                        <img width="80%" height="80%" src="<?php echo base_url()?>/resources/images/books2.png" />
                    </div>
                    <div class="col-lg-6">
                        <p class="text-info"><b>К сожалению, по Вашему запросу ничего не найдено</b></p>
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
</body>
</html>