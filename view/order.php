<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="/assets/style.css">
</head>
<body>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mb-5">Данные клиента</h3>
            <p>Фамилия: <?= $order['surname'] ?></p>
            <p>Имя: <?= $order['name'] ?></p>
            <p>Отчество: <?= $order['patronymic'] ?></p>
            <p>ИНН: <?= $order['inn'] ?></p>
            <?php if ($order['client_type'] == 1) : ?>
                <p>Дата рождения: <?= $order['date_birth'] ?></p>
                <p>Паспорт: <?= $order['passport_serial'] ?> <?= $order['passport_number'] ?></p>
                <p>Дата выдачи: <?= $order['passport_date'] ?></p>
            <?php elseif ($order['client_type'] == 2) :  ?>
                <p>Название компании: <?= $order['company_name'] ?></p>
                <p>Адрес компании: <?= $order['company_address'] ?></p>
                <p>ОГРН: <?= $order['company_ogrn'] ?></p>
                <p>ИНН: <?= $order['company_inn'] ?></p>
                <p>КПП: <?= $order['company_kpp'] ?></p>
            <?php endif; ?>
        </div>
        <div class="col">
            <h3 class="mb-5">Данные по продукту</h3>
            <p>Дата открытия: <?= $order['date_open'] ?></p>
            <p>Дата закрытия: <?= $order['date_close'] ?></p>
            <p>Срок: <?= $order['term'] ?></p>
            <?php if ($order['product_type'] == 1) : ?>
                <p>Сумма: <?= $order['amount'] ?></p>
            <?php elseif ($order['product_type'] == 2) :  ?>
                <p>Ставка: <?= $order['rate'] ?></p>
                <?php if ($order['capitalization'] == 1): ?>
                    <p>Периодичность капитализации: В конце срока</p>
                <?php elseif ($order['capitalization'] == 2): ?>
                    <p>Периодичность капитализации: Ежемесячно</p>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    </div>

</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
<script src="/assets/main.js"></script>
</body>
</html>
