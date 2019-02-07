<?php
    if (!isset($_SESSION)){
        session_start();
    }
    $message = (isset($_SESSION['message'])?$_SESSION['message']:'');
    $error = (isset($_SESSION['error'])?$_SESSION['error']:false);
    $_SESSION['message']='';
    $_SESSION['error']=false;
?>
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

<?php if ($message!="") { ?>
<div class='row'>
    <div class="alert alert-<?= ($error==true ? "danger" : "success") ?>" role="alert"><?= $message ?></div>
</div>
<?php } ?>

<?php	if (isset($filters)) {  ?>
<div class="row">
    <div class="col-md-12">
        <form class="form-inline" method='post'>
            <?php foreach ($filters as $f) { 
                switch ($f['type']) {
                    case 'select': ?>
                    <div class="form-group <?= (isset($f['class'])?$f['class']:'') ?>">
                        <label for="<?= $f['id'] ?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <div class='input-group'>
                            <select id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" class='form-control'>
                                <?php foreach ($f['options'] as $o) { ?>
                                <option value='<?= $o['value'] ?>' <?= isset($f['value']) && $f['value']==$o['value']?'selected':'' ?>><?= $o['label'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <?php break;
                    case 'date': ?>
                    <div class="form-group <?= (isset($f['class'])?$f['class']:'') ?>">
                        <label for="<?= $f['id'] ?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <div class='input-group') ?>'>
                            <label for="<?= $f['id'] ?>" class="input-group-addon btn"><span class="glyphicon glyphicon-calendar"></span></label>
                            <input class='form-control date' type="text" id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" value="<?= (isset($f['value'])?$f['value']:'') ?>" size="10" maxlength="10">
                        </div>
                    </div>
                    <?php break;
                    case 'boolean': ?>
                    <div class="form-group <?= (isset($f['class'])?$f['class']:'') ?>">
                        <label for="<?= $f['id'] ?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <div class='input-group col-md-1') ?>'>
                            <input class="form-control" id="<?= $f['id'] ?>" name="<?= $f['id'] ?>" type="checkbox" value="1" <?= ($f['value']==1?'checked':'') ?>>
                        </div>
                    </div>
                    <?php break;
                    case 'input': 
                    case 'default': ?>
                    <div class="form-group <?= (isset($f['class'])?$f['class']:'') ?>">
                        <label for="<?=$f['id']?>" class='control-label col-md-2'><?=$f['label']?></label>
                        <input type="text" class="form-control" id="<?=$f['id']?>" name="<?= $f['id'] ?>" placeholder="<?=$f['label']?>" value="<?= (isset($f['value'])?$f['value']:'') ?>">
                    </div>
                    <?php break;
                    }
                } ?>
                <div class='col-md-12'>
                <button type="submit" class="btn btn-default">Filtrar</button>
                </div>
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
            <thead><tr>
            <?php foreach ($item_attributes as $a) { 
                echo '<th class="text-center">'.(isset($a['header'])?$a['header']:'').'</th>';
            }
            ?>
            </tr></thead>
            <tbody>
            <?php foreach ($items as $i) { ?>
            <?php
                    if (isset($active_item)) {
                        $ans=str_replace("}",'\']',str_replace("{", '$i[\'', $active_item));
                        $active = eval("return (".$ans.");");
                    } else {
                        $active = false;
                    }
            ?>
            <tr <?= ($active?'class="info"':'') ?>>
                <?php foreach ($item_attributes as $a) { 
                    if (isset($a['condition'])) {
                        $ans=str_replace("}",'\']',str_replace("{", '$i[\'', $a['condition']));
                        $condition = eval("return (".$ans.");");
                    } else {
                        $condition = true;
                    }

                    if ($condition) { 
                     if (!isset($a['type'])) $a['type']='text';
                     switch ($a['type']) {
                        case 'money': ?>
                        <td class='text-right <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'>
                        <?php if (isset($a['href'])) { ?>
                        <a href="<?php eval("echo '".str_replace("}",'\'].\'',str_replace("{", '\'.$i[\'', $a['href'])."';")); ?>"><?= number_format($i[$a['attribute']],2,'.',',') ?></a>
                        <?php } else { ?>
                        <?= number_format($i[$a['attribute']],2,'.',',') ?>
                        <?php } ?>
                        </td>
                        <?php   break;
                        case 'date_from_mysqldate': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php $date = DateTime::createFromFormat('Y-m-d', $i[$a['attribute']]); echo $date->format('d/m/Y'); ?></td>
                        <?php   break;
                        case 'date_from_mysqldatetime': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $i[$a['attribute']]); echo $date->format('d/m/Y'); ?></td>
                        <?php   break;
                        case 'datetime_from_mysqldatetime': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php $date = DateTime::createFromFormat('Y-m-d H:i:s', $i[$a['attribute']]); echo $date->format('d/m/Y H:i:s'); ?></td>
                        <?php   break;
                        case 'html': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?= $a['html'] ?></td>
                        <?php   break;
                        case 'expression': ?>
                        <td class='text-center <?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php eval("echo ".str_replace("}",'\']',str_replace("{", '$i[\'', $a['expression']).";")); ?></td>
                        <?php   break;
                        default: ?>
                            <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'><?php if (isset($a['href'])) { ?><a href="<?php eval("echo '".str_replace("}",'\'].\'',str_replace("{", '\'.$i[\'', $a['href'])."';")); ?>"><?= $i[$a['attribute']] ?></a><?php } else { ?><?= $i[$a['attribute']] ?><?php } ?>
</td>
                        <?php   break;
                     } 
                 } else {
                 ?>
                 <td class='text-center'>&nbsp;</td>
                 <?php
                 } ?>
                <?php } ?>
                <?php if (isset($item_actions)) {?>
                <?php foreach ($item_actions as $a) { ?>
                <td class='<?= (isset($a['tdclass'])?$a['tdclass']:"") ?>'>
                    <?php if (isset($a['condition'])) {
                        $ans=str_replace("}",'\']',str_replace("{", '$i[\'', $a['condition']));
                        $condition = eval("return (".$ans.");");
                    } else {
                        $condition = true;
                    }
                        ?>
                    <?php if ($condition) { ?>
                        <a href="<?php eval("echo '".str_replace("}",'\'].\'',str_replace("{", '\'.$i[\'', $a['href'])."';")); ?>"
                        <?php if (isset($a['onclick'])) { ?>
                        onclick="<?php eval("echo '".str_replace("}",'\'].\'\\\'',str_replace("{", '\\\'\'.$i[\'', $a['onclick'])."';")); ?>"
                        <?php } ?> 
                        <?php if (isset($a['class'])) { ?>
                        class="<?= $a['class'] ?>">
                        <?php } ?>
                        ><?= $a['description'] ?></a></td>    
                    <?php } ?>
        </td>
        <?php } ?>
        <?php } ?>
    </tr>
    <?php } ?>
    </tbody>
</table>
<?php if (isset($pagination)) {?>
    <div>Total: <strong><?= $pagination->getTotalAmountOfItems() ?></strong></div>
    <div><ul class='pagination'>
    <?php if ($pagination->getCurrentPage() > 3) { ?>
        <li><a href='<?= $pagination->getLink() ?>&p=1'>1</a></li>
        <li class='disabled'><a href=''>...</a></li>
    <?php } 
    for ($i=($pagination->getCurrentPage() > 2 ? $pagination->getCurrentPage() - 2 : 1);$i<=($pagination->getCurrentPage() < $pagination->getTotalAmountOfPages() - 2 ? $pagination->getCurrentPage() + 2 : $pagination->getTotalAmountOfPages());$i++) {
    ?>
        <li <?= ($pagination->getCurrentPage()==$i ? "class='active'" : "")?>><a href='<?= $pagination->getLink() ?>&p=<?=$i?>'><?=$i?></a></li>
    
    <?php 
    }
    if ($pagination->getCurrentPage()<$pagination->getTotalAmountOfPages()-2) {
    ?>
        <li class='disabled'><a href=''>...</a></li>
        <li><a href='<?= $pagination->getLink() ?>&p=<?=$pagination->getTotalAmountOfPages()?>'><?=$pagination->getTotalAmountOfPages()?></a></li>
    <?php 
    } ?>
    </ul>
    </div>
<?php } ?>
