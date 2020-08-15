<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, initial-scale=1"/>
    <meta name="referrer" content="origin"/>
    <title>Оставить отзыв</title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/index.css" />
    <link rel="stylesheet" href="<?php echo base_url(); ?>/resources/css/review.css" />
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
<div class="container" style="margin-top: 5%; margin-bottom: 5%;">
    <div class="card shadow-lg">
        <div class="card-header py-lg-3">
            <a class="card-link border-right border-info" style="padding-right: 10px;" href="/">BS</a>
            <span class="m-0 font-weight-bold text-primary text-center" style="padding-left: 10px;">Ваш отзыв</span>
        </div>
        <form method="post" action="addreview">
        <div class="card-body">
            <?php if(!empty($book_name) && !empty($book_id) && !empty($book_author) && !empty($user_id) && !empty($user_name)):?>
            <h2 class="text-center text-break"><?= $book_author ?> "<?= $book_name ?>"</h2>
            <div class="row centered">
                <button type="button" class="btn btn-link" onclick="window.open('/book_info/<?= $book_id ?>')">
                    Ссылка на товар <i class="fa fa-external-link"></i>
                </button>
            </div>

            <p class="bg-info" style="text-align: center; color: whitesmoke; font-family: 'Open Sans Light', serif;">Добрый день, <b><?= $user_name ?></b></p>
            <p class="text-muted" style="font-size: 12px;">Поля, помеченные звёдочкой, обязательны для заполнения</p>
                <p><span class="text-danger"><b>*</b></span> Выберите оценку: </p>
            <div class="rating_block">
                <input type="text" name="book_id" value="<?= $book_id ?>" hidden />
                <input type="text" name="user_id" value="<?= $user_id ?>" hidden />
                <input type="text" name="user_name" value="<?= $user_name ?>" hidden />
                <input name="rating" value="5" id="rating_5" type="radio" />
                <label for="rating_5" class="label_rating"></label>

                <input name="rating" value="4" id="rating_4" type="radio" />
                <label for="rating_4" class="label_rating"></label>

                <input name="rating" value="3" id="rating_3" type="radio" />
                <label for="rating_3" class="label_rating"></label>

                <input name="rating" value="2" id="rating_2" type="radio" />
                <label for="rating_2" class="label_rating"></label>

                <input name="rating" value="1" id="rating_1" type="radio" />
                <label for="rating_1" class="label_rating"></label>
            </div>
            <?php endif ?>
            <br/>
            <div class="form-group">
                <label for="review_title"><span class="text-danger"><b>*</b></span> Введите заголовок отзыва:</label>
                <input name="review_title" id="review_title" type="text" class="form-control" />
            </div>
            <div class="form-group">
                <label for="review"><span class="text-danger"><b>*</b></span> Оставьте отзыв:</label>
                <textarea name="review_text" class="form-control" rows="5" id="review" placeholder="Ваш отзыв..." style="resize: none;"></textarea>
            </div>
        </div>
        <div class="card-footer">
            <div class="row centered">
                <button type="submit" class="btn btn-lg btn-danger">Добавить отзыв</button>
            </div>
        </div>
        </form>
    </div>
</div>
</body>
</html>
