<?php if (!empty($works)) : ?>
    <?php foreach ($works as $work) : ?>
        <tr>
            <th scope="row"><?= $work['id'] ?></th>
            <td class="image_td"><img src="/images/works<?= $work['photoName'] ?>" alt="паспорт фасадов"></td>
            <td><a href="/build/<?= $work['id'] ?>"><?= $work['title'] ?></a></td>
            <td><?= $work['publish'] ?></td>
            <td><?= $work['category'] ?></td>
            <td><?= $work['timeCreate'] ?></td>
            <td><a href="/build/<?= $work['id'] ?>/remove">удалить</a></td>
        </tr>
    <?php endforeach;
    else: ?>
<p>no data</p>
<?php    endif; ?>
