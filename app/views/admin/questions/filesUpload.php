<div class="large-5 columns">
    <?php
        for($i=1; $i<=5; $i++){
           echo Form::label('file'.$i, 'Файл '.$i.':');
           echo Form::text('file'.$i, $file[$i]);
        }

    ?>
</div>