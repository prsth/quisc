<? echo '<?xml version ="1.0" encoding="utf-8"?>'?>
<rows>
    <page>1</page>
    <total>2</total>
    <records>16</records>

    <?php foreach($rows as $row) {?>
    <row id = "<?php echo $row->getPrimaryKey()?>">
        <?php foreach($row->getAttributes() as $attribute) {?>
        <cell><?php echo $attribute ?></cell>
        <?php } ?>
    </row>
    <?php } ?>

</rows>