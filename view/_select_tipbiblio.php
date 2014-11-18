<?php $semestres=$_GET["idbibliografia"];?>
<select name="<?php echo $name; ?>" id="<?php echo $id; ?>" class="form-control" >
    <?php foreach ($rows as $key => $value) { ?>
        <?php if ($code != $value[0] ) { ?>

    <option value="<?php echo $value[0]; ?>"> <?php echo strtoupper(utf8_encode($value[1])) ?> </option>
        <?php } else { ?>
            <option selected="selected" value="<?php echo $value[0]; ?>"> <?php echo utf8_encode($value[1]); ?> </option>
        <?php }  ?>
    <?php } ?>
</select>
<input type="hidden" id="idsemeestreacademicoescondido" name="idsemeestreacademicoescondido" />
