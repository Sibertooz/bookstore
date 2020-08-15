function sendCartData(book_id, book_count) {
    var url = "http://bookstore/index.php/home/updateBooksCountInCart";
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
    var url = "http://bookstore/index.php/home/deleteBookFromCart";
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
    var url = "http://bookstore/index.php/home/sendBooksCount/";

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
    var url = "http://bookstore/index.php/home/addBookToCart";
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