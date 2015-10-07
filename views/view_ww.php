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
<?php	if (isset($top_section)) {  ?>
<div class="row">
    <?= $top_section ?>
</div>
<?php } ?>

<?php	if (isset($filters)) {  ?>
<div class="row">
    <div class="col-md-10">
        <form class="form-inline" method='post'>
            <?php foreach ($filters as $f) { 
                switch ($f['type']) {
                    case 'select': ?>
                    <div class="form-group">
                        <label for="<?= $f['id'] ?>" class='control-label'><?=$f['label']?></label>
                        <div class='input-group <?= (isset($f['class'])?$f['class']:'') ?>'>
                            <select id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" class='form-control'>
                                <?php foreach ($f['options'] as $o) { ?>
                                <option value='<?= $o['value'] ?>' <?= isset($f['value']) && $f['value']==$o['value']?'selected':'' ?>><?= $o['label'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php break;
                    case 'date': ?>
                    <div class="form-group">
                        <label for="<?= $f['id'] ?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <div class='input-group <?= (isset($f['class'])?$f['class']:'col-md-8') ?>'>
                            <label for="<?= $f['id'] ?>" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                            <input class='form-control date' type="text" id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" value="<?= (isset($f['value'])?$f['value']:'') ?>" size="10" maxlength="10">
                        </div>
                    </div>
                    <?php break;
                    case 'boolean': ?>
                    <div class="form-group">
                        <label for="<?= $f['id'] ?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <div class='input-group <?= (isset($f['class'])?$f['class']:'col-md-1') ?>'>
                            <input class="form-control" id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" type="checkbox" value="1" <?= ($f['value']==1?'checked':'') ?>>
                        </div>
                    </div>
                    <?php break;
                    case 'input': 
                    case 'default': ?>
                    <div class="form-group">
                        <label for="<?=$f['id']?>"><?=$f['label']?></label>
                        <input type="text" class="form-control" id="<?=$f['id']?>" placeholder="<?=$f['label']?>">
                    </div>
                    <?php break;
                    }
                } ?>
                <button type="submit" class="btn btn-default">Filtrar</button>
                </form>
            </div>
        </div>
        <br/>
        <?php } ?>

        <?php	if (isset($form_action) || isset($actions)) {  ?>
        <div class="row">
            <?php	if (isset($form_action)) {
                if (!isset($busqueda)) { $busqueda='';}
            ?>
            <div class="col-md-6">
                <form class="form-inline" role="form" action="<?= $form_action ?>" method="get">
                    <input type="text" class="form-control" id="b" name="b" placeholder="Buscar..." value="<?=$busqueda?>">
                    <button type="submit" id="btnBuscar" class="btn btn-primary">Buscar</button>
                </form>
            </div>
            <?php } else { ?>
            <div class="col-md-6"></div>
            <?php } ?>
            <?php if (isset($actions)) {?>
            <div class="col-md-6 text-right">
                <?php foreach ($actions as $a) { ?>
                <a href='<?= $a['href'] ?>' class="<?= (isset($a['class'])?$a['class']:"") ?>"><?= $a['description'] ?></a>&nbsp;
                <?php } ?>
            </div>
            <?php } ?>
        </div>
        <br/>
        <?php } ?>
        <table class="table table-striped table-condensed">
            <?php foreach ($items as $i) { ?>
            <tr>
                <?php foreach ($item_attributes as $a) { 
                    if (!isset($a['type'])) $a['type']='text';
                    switch ($a['type']) {
                        case 'money': ?>
                        <td class='text-right <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?= number_format($i[$a['attribute']],2,'.',',') ?></td>
                        <?php   break;
                        case 'date_from_mysqldate': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php $date = DateTime::createFromFormat('Y-m-d', $i[$a['attribute']]); echo $date->format('d/m/Y'); ?></td>
                        <?php   break;
                        case 'date_from_mysqldatetime': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $i[$a['attribute']]); echo $date->format('d/m/Y'); ?></td>
                        <?php   break;
                        default: ?>
                        <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?= $i[$a['attribute']] ?></td>
                        <?php   break;
                    } 
                ?>
                <?php } ?>
                <?php if (isset($item_actions)) {?>
                <?php foreach ($item_actions as $a) { ?>
                <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><a 	href="<?php eval("echo '".str_replace("}",'\'].\'',str_replace("{", '\'.$i[\'', $a['href'])."';")); ?>"
                        <?php if (isset($a['onclick'])) { ?>
                        onclick="<?php eval("echo '".str_replace("}",'\'].\'\\\'',str_replace("{", '\\\'\'.$i[\'', $a['onclick'])."';")); ?>"
                        <?php } ?> 
                        <?php if (isset($a['class'])) { ?>
                        class="<?= $a['class'] ?>">
                        <?php } ?>
                    ><?= $a['description'] ?></a></td>    
        </td>
        <?php } ?>
        <?php } ?>
    </tr>
    <?php } ?>
</table>
<?php if (isset($Pagination)) {?>
    <div>Total: <strong><?= $Pagination->getTotalAmountOfItems() ?></strong></div>
    <div><?php echo $Pagination->render(); ?></div>
<?php } ?>

<?php if (isset($mensaje) && $mensaje!="") { ?>
<div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $mensaje ?></div>
<?php } ?>
