<?= View::make('admin.header', array('title' => $title)) ?>
<div class="row">
    <div class="large-12 columns">
        <h3>Вопросы на <?=$typeTitle?> (<b> <?=$count?> </b>)</h3>
    </div>
</div>
<br />
<div class="row">
    <div class="large-8 columns">
        <table>
            <thead>
                <th>Описание</th>
                <th>Ответ</th>
                <th>Сложность</th>
                <th>Категория</th>
            </thead>
            <?php
            foreach ($questions as $q) {
                echo '<tr>';
                echo '<td><a href="/admin/'.$linkToQ.'/' . $q->id . '"> ' . $q->statement . ' </a></td>';
                echo '<td>' . $q->answer . ' </td>';
                echo '<td>' . $q->complexity . ' </td>';
                echo '<td>' . $catNamesById[ $q->category ] . ' </td>';
                echo '</tr>';
            }
            ?>
        </table>
        Страницы:&nbsp;&nbsp;
        <?php
        $pages = $questions->getLastPage();
        for ($i=1; $i <= $pages; $i++) {
            if($questions->getCurrentPage() === $i){
                echo $i.'</a>&nbsp;&nbsp;';
            } else {
                echo '<a href="?type='.$linkType.'&category='.$linkCategory.'&complexity='.$linkComplexity.'&page='.$i.'">'.$i.'</a>&nbsp;&nbsp;';
            }

        }
        ?>

    </div>
    <div class="large-4 columns">
        <h6>Сложность</h6>
        <a href="?type=<?=$linkType?>&category=<?=$linkCategory?>&complexity=">Любая</a>&nbsp;&nbsp;&nbsp;
        <?php for ($i=1; $i <= 10; $i++) {
            if( $i == $linkComplexity ) {
                echo $i.'&nbsp;&nbsp;&nbsp;';
            } else {
                echo '<a href="?type='.$linkType.'&category='.$linkCategory.'&complexity='.$i.'">'.$i.'</a>&nbsp;&nbsp;&nbsp;';
            }

        }
        ?>
        <br /><br />
        <h6>Просмотреть вопросы из категории:</h6>
        <ul>
            <li><a href="?type=<?=$linkType?>&category=&complexity=<?=$linkComplexity?>">Любая</a></li>
            <?php
            if(0 === $linkCategory){
                echo '<li>Без категории</li>';
            } else {
                echo '<li><a href="?type='.$linkType.'&category=0&complexity='.$linkComplexity.'">Без категории</a></li>';
            }
            foreach ($categories as $c) {
                if($c->id == $linkCategory){
                    echo '<li> ' . $c->name . ' </li>';
                } else {
                    echo '<li><a href="?type='.$linkType.'&category='.$c->id.'&complexity='.$linkComplexity.'"> ' . $c->name . ' </a></li>';
                }
            }
            ?>
        </ul>



    </div>

</div>

<?= View::make('admin.footer') ?>