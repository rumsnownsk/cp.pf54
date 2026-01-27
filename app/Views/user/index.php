<div class="container">
    <h1><?= $title ?? ''; ?></h1>
    <table  class="table">
        <thead>
        <tr>
            <th scope="col">id</th>
            <th scope="col">имя</th>
            <th scope="col">email</th>
        </tr> <!--ряд с ячейками заголовков-->
        </thead>

        <tbody>
        <?php foreach ($users as $user): ?>
        <tr>
            <th scope="row"><?= $user['id'] ?></th>
            <td><?= $user['name'] ?></td>
            <td><?= $user['email'] ?></td>
        </tr> <!--ряд с ячейками тела таблицы-->
        <?php endforeach; ?>
        </tbody>
    </table>

    <?= $pagination ?? null ?>

</div>
