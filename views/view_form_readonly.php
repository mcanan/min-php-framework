<h3><?= $titulo ?></h3>
<br />
<form class="form-horizontal" id='formData' role="form">
    <?php foreach ($items as $i) { 
        switch ($i['type']) {
            case 'hidden': ?>
                <input type='hidden' name='<?= $i['id'] ?>' value='<?= $i['value'] ?>'>
                <?php break;
            case 'readonly': 
            default: ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <input class="form-control" type="text" placeholder="<?=$i['value']?>" size="<?= strlen($i['value']) ?>" readonly>
                    </div>
                </div>
                <?php break;
            }
        }
    ?>
    <div class="form-group">
        <div class="col-md-8 col-md-offset-2">
    <?php if (isset($buttons)) { ?>
    <?php foreach ($buttons as $b) { ?>
        <a href='<?= $b['action'] ?>' class="<?= (isset($b['class'])?$b['class']:'btn btn-primary') ?>"><?= $b['label'] ?></a>
    <?php } ?>
    <?php } ?>
        </div>
    </div>
</form>
<?php if ($mensaje!="") { ?>
<div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $mensaje ?></div>
<?php } ?>

<script>
    $(function() {
            $( ".date" ).datepicker({
                    dateFormat: 'dd/mm/yy'
            });

    });
</script>
