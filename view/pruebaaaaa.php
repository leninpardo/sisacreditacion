<style>
    .codunidad:hover{
        background: #eaf8fc;
    }
</style>
<div class="panel-group" id="accordion" style="width: 820px; margin-left:-60px;" >
        <?php  $conta = 11;
            foreach ($rows as $key => $value) {
        ?>  

<div class="panel panel-default col-md-12  "  >
    
    <div class="panel-heading codunidad tamañodeuni" id="<?php echo $conta+20; ?>">
    <input type="hidden" class="idunidad<?php echo $conta; ?>" value="<?php echo $value[1]; ?>">
                <h5 class="panel-title" id="hola" style="text-align: center; " >
                    <a data-toggle="collapse" data-parent="#accordion" style="text-decoration: none; font-size: 14px"
                     href="#<?php echo $conta; ?>" >
                        UNIDAD <?php echo $conta-10; ?> : <?php echo utf8_encode($value[0]); ?>
                    </a>
                </h5>
    </div>

    <div id="<?php echo $conta; ?>" class="tema panel-collapse collapse " name="<?php echo $value[1]; ?>">
       <div class="container-fluid" style="height: 100%">
        <div class="panel-body temas"></div>           
       </div>
    </div>

</div>

<?php $conta = $conta + 1;}?>


 
<script>

$(document).ready(function(){

var tamañodeuni= $(".tamañodeuni").length;
$('.codunidad').live("click",function(){
        tip= $(this).attr('id');
        for (var y = 11; y <= (parseInt(tamañodeuni)+10); y++) {
        if (y == parseInt(tip-20)) {
            var unidad= $('.idunidad'+y).val();
            var opt='C';
            $.post('index.php', 'controller=cursosemestre&action=getTema&Codigo=' +unidad+'&option='+opt, function(data) {
                $(".temas").empty().append(data);
            });
        }
      }
    });

})
</script>