<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="UTF-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
	<title>BookStore</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/index.css" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"/>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css"/>
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet"/>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
</head>
<body>
<nav id="menu" class="navbar navbar-expand-sm fixed-top navbar-index">
    <ul class="navbar-nav container">
        <li class="nav-item">
            <a class="navbar-brand float-left" href="#" id="logo-href" style="color: white;"><h4 class="logo">BS</h4></a>
        <li class="nav-item">
        </li>
        </li>
        <li class="nav-item center-horizontal">
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

<div id="index">
    <div class="centered" style="margin-top: 50%;">
        <div class="center-absolute">
            <h3 style="text-align: center;">Добро пожаловать в книжный магазин</h3>
            <h1 style="color: #AB5950; text-align: center;" class="reveal">bookstore</h1>
        </div>
    </div>
</div>

<div id="main-block">
    <div class="container">
        <div class="row" style="margin-top: 10%; margin-bottom: 10%;">
        <div class="col-lg-3">
            <nav class="navbar bg-light nav-bar-line-left" style="padding: 0;">
                <ul class="navbar-nav" style="width: 100%; height: 100%;">
                    <?php if (!empty($genres)) {
                        foreach ($genres as $gnr) { ?>
                        <li class="nav-item" >
                            <a id="<?= $gnr['genre_id'] ?>" class="nav-link index-sidebar" style="padding: 10px 10px 10px 20px;"
                               onclick="showSomeGenre(<?= $gnr['genre_id'] ?>)" href="#books">
                                <?= $gnr['genre_name'] ?>
                            </a>
                        </li>
                        <?php }
                    } ?>
                </ul>
            </nav>
        </div>

        <div class="col-lg-9" id="#books">
            <div class="card shadow">
                <div class="card-header py-lg-3">
                    <h6 class="m-0 font-weight-bold text-primary" id="title">Все книги</h6>
                </div>
                <div class="card-body">
                    <div class="row centered" id="fiction">
                        <?php if (!empty($books1)) :?>
                        <?php foreach ($books1 as $book) { ?>
                        <div class="col-lg-3" style="margin: 2%;">
                                <input type="hidden" name="book_id" value="<?= $book['book_id']?>"/>
                            <div class="product-item">
                                <img alt="" src="<?php echo base_url() ?>/resources/images/<?= $book['img_name']?>"/>
                                <div class="product-list">
                                    <h2><?= $book['author'] ?></h2>
                                    <h3><?= $book['book_name'] ?></h3>
                                    <span class="price">₴ <?= $book['cost'] ?></span>
                                    <button type="button" class="button-basket" onclick="window.open('/book_info/<?= $book['book_id'] ?>')">Посмотреть</button>
                                    <button type="button" class="button-basket" onclick="addBookToCart(<?= $book['book_id'] ?>, '<?= $book['book_name']?>',
                                            '<?= $book['author'] ?>', <?= $book['cost'] ?>)">В корзину</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endif ?>
                    </div>

                    <div class="row centered" id="medicine">
                        <?php if (!empty($books2)) :?>
                        <?php foreach ($books2 as $book) { ?>
                        <div class="col-lg-3" style="margin: 2%;">
                            <input type="hidden" name="book_id" value="<?= $book['book_id']?>"/>
                            <div class="product-item">
                                <img alt="" src="<?php echo base_url() ?>/resources/images/<?= $book['img_name']?>"/>
                                <div class="product-list">
                                    <h2><?= $book['author'] ?></h2>
                                    <h3><?= $book['book_name'] ?></h3>
                                    <span class="price">₴ <?= $book['cost'] ?></span>
                                    <button type="button" class="button-basket" onclick="window.open('/book_info/<?= $book['book_id'] ?>.html')">Посмотреть</button>
                                    <button type="button" class="button-basket" onclick="addBookToCart(<?= $book['book_id'] ?>, '<?= $book['book_name']?>',
                                            '<?= $book['author'] ?>', <?= $book['cost'] ?>)">В корзину</button>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php endif ?>
                    </div>

                </div>
            </div>
        </div>
        </div>
    </div>
</div>

<div id="index-bottom">
    <div id="animation-bottom" class="container centered bottom-back" style="margin-bottom: 2%; margin-top: 2%;">
        <div>
            <div class="bottom-contacts">
                <div class="row align-items-center">
                    <div class="col-6">
                        <p style="font-size: 80px; padding-top: 10px; padding-left: 70px;">BS</p>
                    </div>
                    <div class="col-6 left-line" style="padding-top: 10px; padding-left: 15px;">
                        <p>ТЕЛЕФОН: +38 (086) 32-43-647</p>
                        <p>АДРЕС: г. Одесса, пр. Шевченко 1</p>
                        <p>EMAIL: bookstore@gmail.com</p>
                    </div>
                </div>
            </div>
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
                <?php foreach($booksInCart as $bk) { ?>
                <div id="<?= 'row_'.$bk['product_id']?>" class="row" style="border-bottom: solid 1px #DEE2E6; padding-top: 5px; margin: 5px; position: relative;">
                    <div class="col-lg-1">
                        <button id="<?= 'close_'.$bk['product_id']?>" type="button" class="close" onclick="deleteFromCart(<?= $bk['product_id']?>)">
                            <span class="text-danger" aria-hidden="true">&times;</span>
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
                        <input type="number" onchange="sendCartData(<?= $bk['product_id']?>, this.value);"
                               style="width: 100px; text-align: center;" min="1" max="5" value="<?= $bk['product_count'] ?>" />
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

<div id="modal-auth" class="modal fade" tabindex="-1" data-backdrop="true">
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

<script>
$(document).ready(function() {
    var menu = $("#menu");
    var el = $("#animation-bottom");

    $(window).scroll(function() {
        var top = $(this).scrollTop();
        if (top >= 100 ) {
            menu.css("background", "#ECD0CD");
            el.addClass('bottom-back');
        } else if (top <= 200 ) {
            menu.css("background", "rgba(0, 0, 0, 0)");
            el.removeClass('bottom-back');
        }
    });

    showSomeGenre(1);
});

function showSomeGenre(genre){
    if (genre === 1) {
        document.getElementById('fiction').hidden = false;
        document.getElementById('medicine').hidden = true;
        document.getElementById('title').innerText = "Художественная литература";
    } else {
        document.getElementById('fiction').hidden = true;
        document.getElementById('medicine').hidden = false;
        document.getElementById('title').innerText = "Медицина";
    }
}

function sendCartData(book_id, book_count) {
    var url = "<?php echo site_url() ?>/home/updateBooksCountInCart";
    var idElement = '#book_' + book_id;
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'bkCount': book_count,
            'bkCountId': book_id
        },
        dataType: "JSON",
        success: function() {
            $(idElement).css("padding", "0");
            $(idElement).load("index.php "+idElement);
        },
        error: function ()
        {
            alert('Error adding/update data');
        }
    });
}

function deleteFromCart(book_id) {
    var url = "<?php echo site_url() ?>/home/deleteBookFromCart";
    var idBook = '#book_' + book_id;
    var idInput = '#input_' + book_id;
    var idInfo = '#info_' + book_id;
    var idClose = '#close_' + book_id;
    var idRow = '#row_' + book_id;
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'bkDelete': book_id
        },
        dataType: "JSON",
        success: function() {
            $(idBook).load("index.php "+idBook);
            $(idInput).load("index.php "+idInput);
            $(idInfo).load("index.php "+idInfo);
            $(idClose).load("index.php "+idClose);
            $(idRow).css("border-bottom", "none");
            $(idRow).css("padding", "0");
            $(idRow).css("margin", "0");
            $(idRow).load("index.php "+idRow);
            getBooksCountInBasket();
            $('#countText').load("index.php #countText");
        },
        error: function ()
        {
            alert('Error adding/update data');
        }
    });
}

function getBooksCountInBasket() {
    var count = 0;
    var url = "<?php echo site_url() ?>/home/sendBooksCount/";

    <?php header('Content-type: application/json'); ?>
    $.ajax({
        url : url,
        type: "GET",
        dataType: "JSON",
        success: function(data) {
            count = data.booksCountInCart;
            if (count === 0) window.location.reload();
        }
    });
}

function addBookToCart(book_id, book_name, book_author, book_cost) {
    var url = "<?php echo site_url() ?>/home/addBookToCart";
    $.ajax({
        url: url,
        type: "POST",
        data: {
            'bookId': book_id,
            'bookName': book_name,
            'bookAuthor': book_author,
            'bookCost': book_cost
        },
        dataType: "JSON",
        success: function () {
            alert('Ваш товар успешно добавлен в корзину');
            $('#countText').css('font-size', '12px').load("index.php #countText");
            $('#modal_content').load("index.php #modal_content");
        },
        error: function () {
            alert('Error adding/update data');
        }
    });
}
</script>
</body>
</html>