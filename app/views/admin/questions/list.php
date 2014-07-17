<?= View::make('admin.header', array('title' => $title)) ?>

    <div class="row">
        <div class="large-12 columns">
            <a href="/admin/q_numbers/" class="button">Назад</a>
        </div>
        <div class="large-8 columns">
            <h5>Вопросы на <?=$typeTitle?>: Категория <b><?=$catName?></b></h5>
            <table>
                <?php
                foreach ($questions as $q) {
                    echo '<tr>';
                    echo '<td><a href="/admin/q_numbers/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                    echo '<td>Ответ: ' . $q->answer . ' </td>';
                    echo '</tr>';
                }
                ?>
            </table>

        </div>
        <div class="large-4 columns">
            <h5>Просмотреть вопросы из категории:</h5>
            <ul>
                <?php
                if(0 == $cur_id){
                    echo '<li>Без категории</li>';
                } else {
                    echo ' <li><a href="/admin/q_numbers/cat/0">Без категории</a></li>';
                }
                foreach ($categories as $c) {
                    if($c->id == $cur_id){
                        echo '<li> ' . $c->name . ' </li>';
                    } else {
                        echo '<li><a href="/admin/q_numbers/cat/' . $c->id . '"> ' . $c->name . ' </a></li>';
                    }
                }
                ?>
            </ul>

        </div>

    </div>

<?= View::make('admin.footer') ?>