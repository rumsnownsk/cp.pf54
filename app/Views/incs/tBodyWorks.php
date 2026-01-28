<?php if (!empty($works)) : ?>
    <?php foreach ($works as $work) : ?>
        <tr>
            <td><?= $work['id'] ?></td>
            <td class="image_td">
                <a href="/build/<?= $work['id'] ?>">
                    <img src='/images/works<?= $work['photoName'] ?>'
                         alt="паспорт фасадов"
                         loading="lazy"
                    >
                </a>

            </td>
            <td><?= $work['title'] ?></td>
            <td><?= $work['publish'] ?></td>
            <td><?= $work['category'] ?></td>
            <td><?= $work['timeCreate'] ?></td>
            <td class="actions" style="width: 40px;">
                <div class="act_remove">
                    <a href="/build/<?= $work['id'] ?>/remove"
                       onclick="return confirm('Вы уверены, что хотите удалить?')">
                        <i class="fas fa-trash"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach;
    else: ?>
<p>no data</p>
<?php    endif; ?>
