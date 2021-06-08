<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
    <title>New Order</title>
</head>
<body>
<div class="container">
    <?php if(isset($error)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $error ?>
        </div>
    <?php endif; ?>
    <?php if(isset($success)): ?>
        <div class="alert alert-success" role="alert">
            <?= $success ?>
        </div>
    <?php endif; ?>
    <form action="/" method="post" id="form-new-order">
        <div class="row">
            <div class="col p-3">
                <?php if(isset($error_client)): ?>
                    <?php foreach ($error_client as $e): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $e ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="row d-flex p-3">
                    <div class="form-check">
                        <input class="form-check-input select-client-type" type="radio" name="type_client" id="type_client1" value="1"
                            <?= ((!isset($_POST['type_client'])) || (isset($_POST['type_client']) && $_POST['type_client'] == '1'))?'checked':'' ?>>
                        <label class="form-check-label" for="type_client1">
                            Физик
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input select-client-type" type="radio" name="type_client" id="type_client2" value="2"
                            <?= (isset($_POST['type_client']) && $_POST['type_client'] == '2')?'checked':'' ?>>
                        <label class="form-check-label" for="type_client2">
                            Юрик
                        </label>
                    </div>
                </div>
                <div class="client-select <?= ((!isset($_POST['type_client'])) || (isset($_POST['type_client']) && $_POST['type_client'] == '1'))?'active':'' ?>" data-select="1">
                    <div class="mb-3 row">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Фамилия</span>
                            <input type="text" name="1[surname]" class="form-control" value="<?= $_POST['1']['surname']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Имя</span>
                            <input type="text" name="1[name]" class="form-control" value="<?= $_POST['1']['name']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Отчество</span>
                            <input type="text" name="1[patronymic]" class="form-control" value="<?= $_POST['1']['patronymic']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">ИНН</span>
                            <input type="number" name="1[inn]" class="form-control" value="<?= $_POST['1']['inn']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата рождения</span>
                            <input type="date" name="1[date_birth]" class="form-control" value="<?= $_POST['1']['date_birth']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Серия паспорта</span>
                            <input type="number" name="1[passport_serial]" class="form-control" value="<?= $_POST['1']['passport_serial']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Номер паспорта</span>
                            <input type="number" name="1[passport_number]" class="form-control" value="<?= $_POST['1']['passport_number']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата выдачи</span>
                            <input type="date" name="1[passport_date]" class="form-control" value="<?= $_POST['1']['passport_date']??'' ?>">
                        </div>
                    </div>
                </div>
                <div class="client-select <?= (isset($_POST['type_client']) && $_POST['type_client'] == '2')?'active':'' ?>" data-select="2">
                    <div class="mb-3 row">
                        <p>Данные руководителя</p>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Фамилия</span>
                            <input type="text" name="2[surname]" class="form-control" value="<?= $_POST['2']['surname']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Имя</span>
                            <input type="text" name="2[name]" class="form-control" value="<?= $_POST['2']['name']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Отчество</span>
                            <input type="text" name="2[patronymic]" class="form-control" value="<?= $_POST['2']['patronymic']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">ИНН</span>
                            <input type="number" name="2[inn]" class="form-control" value="<?= $_POST['2']['inn']??'' ?>">
                        </div>
                        <p>Данные организации</p>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Название</span>
                            <input type="text" name="2[company_name]" class="form-control" value="<?= $_POST['2']['company_name']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Адрес</span>
                            <textarea class="form-control" name="2[company_address]"><?= $_POST['2']['company_address']??'' ?></textarea>
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Номер ОГРН</span>
                            <input type="number" name="2[company_ogrn]" class="form-control" value="<?= $_POST['2']['company_ogrn']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Номер ИНН</span>
                            <input type="number" name="2[company_inn]" class="form-control" value="<?= $_POST['2']['company_inn']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Номер КПП</span>
                            <input type="number" name="2[company_kpp]" class="form-control" value="<?= $_POST['2']['company_kpp']??'' ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col p-3">
                <?php if(isset($error_product)): ?>
                    <?php foreach ($error_product as $e): ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $e ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="row d-flex p-3">
                    <div class="form-check">
                        <input class="form-check-input select-product-type" type="radio" name="type_product" id="type_product1" value="1"
                            <?= ((!isset($_POST['type_product'])) || (isset($_POST['type_product']) && $_POST['type_product'] == '1'))?'checked':'' ?>>
                        <label class="form-check-label" for="type_product1">
                            Кредит
                        </label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input select-product-type" type="radio" name="type_product" id="type_product2" value="2"
                            <?= (isset($_POST['type_product']) && $_POST['type_product'] == '2')?'checked':'' ?>>
                        <label class="form-check-label" for="type_product2">
                            Вклад
                        </label>
                    </div>
                </div>
                <div class="product-select  <?= ((!isset($_POST['type_product'])) || (isset($_POST['type_product']) && $_POST['type_product'] == '1'))?'active':'' ?>" data-select="1">
                    <div class="mb-3 row">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата открытия</span>
                            <input type="date" name="product[1][date_open]" class="form-control" value="<?= $_POST['product']['1']['date_open']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата закрытия</span>
                            <input type="date" name="product[1][date_close]" class="form-control" value="<?= $_POST['product']['1']['date_close']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Сумма</span>
                            <input type="number" name="product[1][amount]" class="form-control" value="<?= $_POST['product']['1']['amount']??'' ?>">
                        </div>
                    </div>
                </div>
                <div class="product-select <?= (isset($_POST['type_product']) && $_POST['type_product'] == '2')?'active':'' ?>" data-select="2">
                    <div class="mb-3 row">
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата открытия</span>
                            <input type="date" name="product[2][date_open]" class="form-control" value="<?= $_POST['product']['2']['date_open']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Дата закрытия</span>
                            <input type="date" name="product[2][date_close]" class="form-control" value="<?= $_POST['product']['2']['date_close']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Ставка</span>
                            <input type="number" name="product[2][rate]" class="form-control" value="<?= $_POST['product']['2']['rate']??'' ?>">
                        </div>
                        <div class="input-group input-group-sm mb-3">
                            <span class="input-group-text">Периодичность капитализации</span>
                            <select class="form-select" name="product[2][capitalization]" aria-label="Default select example">
                                <option <?= (isset($_POST['product']['2']['capitalization']) && $_POST['product']['2']['capitalization'] == '1')?'selected':'' ?> value="1">В конце срока</option>
                                <option <?= (isset($_POST['product']['2']['capitalization']) && $_POST['product']['2']['capitalization'] == '2')?'selected':'' ?> value="2">Ежемесячно</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Отправить</button>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="/assets/main.js"></script>
</body>
</html>
<!--$this->fullname = $surname . ' ' . $name . ' ' . $patronymic;-->
<!--$this->inn = $inn;-->
<!--$this->date_birth = $date_birth;-->
<!--$this->passport_serial = $passport_serial;-->
<!--$this->passport_number = $passport_number;-->
<!--$this->passport_date = $passport_date;-->