<div class="large-5 columns">
    <?php
    for ($i = 1; $i <= 5; $i++) {
        echo Form::label('file' . $i, 'Файл ' . $i . ':');
        if (${'file' . $i} != '') {
            echo '<img src="'.${'file' . $i}.'" class="admin_uploaded_img" />';
        }
        echo Form::file('file' . $i);
    }

    ?>
</div>