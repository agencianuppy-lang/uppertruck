<!-- Modal -->
<?php
   $modalPC = $class->Select("id, banner", "banner", "WHERE tipo = '1'", "ORDER BY pos ASC LIMIT 3");
   while($modPC = $modalPC->fetch(PDO::FETCH_OBJ)){
?>  
<div style="z-index: 999999;" class="modal fade" id="myModalPc<?= $modPC->id ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            <h3 style="text-align: center;">
               <img width="40px" class="foto-galeriax"  src="https://<?= $server ?>/admin/_banners/<?= $modPC->banner ?>" alt="">
            </h3>
         </div>
         <div style="text-align: center;" class="modal-body">
            <img style="width: 20%;" src="img/excluir-foto.svg" alt=""> <br>
            <h4>DESEJA EXCLUIR ESSE BANNER? <br><br></h4>
            <button type="button" style="width: 40%;" class="btn btn-default">Cancelar</button>
            <button type="button" onClick="deletaFotoB(<?= $modPC->id ?>)" style="width: 50%;" class="btn btn-primary">SIM</button>
         </div>
      </div>
   </div>
</div>
<?php
   }
?>
<!--END MODAL-->