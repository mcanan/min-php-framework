<?php if (isset($breadcrumb)) {  ?>
<ol class="breadcrumb">
    <?php foreach ($breadcrumb as $k=>$a) { ?>
    <?php if ($k==(count($breadcrumb)-1)) {  ?>
    <li class='active'><?= $a['description'] ?></li>
    <?php } else { ?>
    <li><a href="<?= $a['href'] ?>"><?= $a['description'] ?></a></li>
    <?php } ?>
    <?php } ?>
</ol>
<?php } ?>
<div class='page-header'>
    <h3><?= $titulo ?></h3>
</div>
<form class="form-horizontal" id='formData' role="form" action="<?= $formActionAceptar ?>" method="post">
    <?php foreach ($items as $i) { 
        switch ($i['type']) {
            case 'hidden': ?>
            <input type='hidden' name='<?= $i['id'] ?>' value='<?= $i['value'] ?>'>
            <?php break;
            case 'boolean': ?>
            <div class="form-group">
                <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-1') ?>'>
                    <input class="form-control" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" type="checkbox" value="1" <?= ($i['value']==1?'checked':'') ?>>
                </div>
            </div>
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
                    <select id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" class='form-control'>
                        <?php foreach ($i['options'] as $o) { ?>
                        <option value='<?= $o['value'] ?>' <?= isset($i['value']) && $i['value']==$o['value']?'selected':'' ?>><?= $o['label'] ?></option>
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
            case 'password': ?>
            <div class="form-group">
                <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                <div class='input-group <?= (isset($i['class'])?$i['class']:'col-md-8') ?>'>
                    <input class='form-control' type="password" id="<?= $i['id'] ?>" name="<?= $i['id'] ?>" >
                </div>
            </div>
            <?php break;
            case 'detail': ?>
            <!-- TODO: terminar como seria un master detail. No esta implementado -->
            <div class="form-group">
                <label for="<?= $i['id'] ?>" class='control-label col-md-2'><?=$i['label']?></label>
                <table class='table table-condensed'>
                    <?php foreach ($i['lines'] as $o) { ?>
                    <tr><td><?= $o['line_value'] ?></td><td><a href='<?= $o['line_action_href'] ?>'><?= $o['line_action_description'] ?></a></td></tr>
                    <?php } ?>
                </table>
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
<?php if (isset($mensaje) && $mensaje!="") { ?>
<div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $mensaje ?></div>
<?php } ?>

<link href='/public/css/datepicker.css' rel='stylesheet' />
<script src='/public/js/bootstrap-datepicker.js'></script>
<script>
    function fillSelect(_url, _select, _texto, _noinfo){
            _texto = typeof _texto !== 'undefined' ? _texto : 'Ninguno';
            _noinfo = typeof _noinfo !== 'undefined' ? _noinfo : 'No existen datos';
            _select.prop( "disabled", true );
            _select.html('<option selected>...</option>');
            $.ajax({
                    url: _url,
                    type: 'POST',
                    dataType: 'json',
                    success: function( json ) {
                            var selected=false;
                            if (json.length==1) selected=true;
                            _select.html('');
                            $.each(json, function(i, v) {
                                    if (selected)
                                        _select.append($('<option selected>').text(this.label).attr('value', this.value));
                                    else 
                                        _select.append($('<option>').text(this.label).attr('value', this.value));
                            });
                            if (json.length==0) _texto=_noinfo;
                            if (!selected) _select.append($('<option selected>').text(_texto).attr('value', ''));
                            _select.prop( "disabled", false );
                    }
            });
    }

    $(function() {
            $(".date").datepicker({
                    format: 'dd/mm/yyyy',
                    language: 'es',
                    autoclose: true,
                    todayHighlight: true
            });
            
            <?php if (isset($jquery_code)) {
                echo $jquery_code;
            } ?>
    });
</script>
