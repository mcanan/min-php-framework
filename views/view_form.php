<div class='page-header'>
    <h3><?= $titulo ?></h3>
</div>
<form class="form-horizontal" id='formData' role="form" action="<?= $formActionAceptar ?>" method="post">
    <?php foreach ($items as $i) { 
        switch ($i['type']) {
            case 'hidden': ?>
                <input type='hidden' name='<?= $i['id'] ?>' value='<?= $i['value'] ?>'>
                <?php break;
            case 'readonly': ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <input class="form-control" type="text" placeholder="<?=$i['value']?>" size="<?= strlen($i['value']) ?>" readonly>
                    </div>
                </div>
                <?php break;
            case 'date': ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <label for="<?= $i['id'] ?>" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                        <input class='form-control date' type="text" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" value="<?= (isset($i['value'])?$i['value']:'') ?>" size="10" maxlength="10">
                    </div>
                </div>
                <?php break;
            case 'select': ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <select id="<?= $i['id'] ?>" name="<?= $i['id'] ?>">
                            <?php foreach ($i['options'] as $o) { ?>
                            <option value='<?= $o['value'] ?>' <?= $i['value']==$o['value']?'selected':'' ?>><?= $o['label'] ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <?php break;
            case 'money': ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <?= (isset($i['addon'])?$i['addon']:'') ?>
                        <input class='form-control' type="text" style='text-align: right;' id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" placeholder="<?= (isset($i['placeholder'])?$i['placeholder']:'') ?>" value="<?= (isset($i['value'])?$i['value']:'') ?>" size="<?= (isset($i['size'])?$i['size']:'') ?>" maxlength="<?= (isset($i['maxlength'])?$i['maxlength']:'') ?>">
                    </div>
                </div>
                <?php break;
            case 'password':
            default: ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <input class='form-control' type="password" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" >
                    </div>
                </div>
                <?php break;
            case 'input':
            default: ?>
                <div class="form-group">
                    <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                    <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                        <?= (isset($i['addon'])?$i['addon']:'') ?>
                        <input class='form-control' type="text" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" placeholder="<?= (isset($i['placeholder'])?$i['placeholder']:'') ?>" value="<?= (isset($i['value'])?$i['value']:'') ?>" size="<?= (isset($i['size'])?$i['size']:'') ?>" maxlength="<?= (isset($i['maxlength'])?$i['maxlength']:'') ?>">
                    </div>
                </div>
                <?php break;
            }
        }
    ?>
    <div class="form-group">
        <div class="col-md-4 col-md-offset-2">
            <button type="submit" class="btn btn-success" id='btnAceptar'>Aceptar</button>
            <a href='<?= $formActionCancelar ?>' class="btn">Cancelar</a>
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
