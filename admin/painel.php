<?php 
   // controladora
   include'controler.php'; 

   // calculo de hora para o relogio
   $hora = date('H') * 6;
   $minuto = date('i') * 6;
   $segundo = date('s') * 6;
?>
<!DOCTYPE html>
<html lang="pt-br">
   <head>
      <meta charset="utf-8">
      <meta name="robots" content="noindex, nofollow">
      <title>Painel Administrativo</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
      <link rel="stylesheet" href="https://<?= $server ?>/admin/css/painel.css">
      <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-T8Gy5hrqNKT+hzMclPo118YTQO6cYprQmhrYwIiQ/3axmI1hQomh7Ud2hPOy8SP1" crossorigin="anonymous">
      <script type="text/javascript" src="https://<?= $server ?>/admin/_class/caminho_controler.js"></script>

   </head>
   <div style="display:block" class="loade"></div>
   <style>
      .loade {
      position: fixed;
      left: 0px;
      top: 0px;
      width: 100%;
      height: 100%;
      z-index: 9999;
      background: url(admin/img/pageLoader.gif) 50% 50% no-repeat #ffffff;
      background-size: 10%;
      }
      @font-face {
      font-family: 'roboto-bold';
      src: url(roboto/Roboto-Black.ttf);
      }
      @font-face {
      font-family: 'roboto-regular';
      src: url(roboto/Roboto-regular.ttf);
      }
      .table {
      border: none;
      }
      .table-definition thead th:first-child {
      pointer-events: none;
      background: white;
      border: none;
      }
      .table td {
      vertical-align: middle;
      }
      .page-item > * {
      border: none;
      }
      .custom-checkbox {
      min-height: 1rem;
      padding-left: 0;
      margin-right: 0;
      cursor: pointer; 
      }
      .custom-checkbox .custom-control-indicator {
      content: "";
      display: inline-block;
      position: relative;
      width: 30px;
      height: 10px;
      background-color: #818181;
      border-radius: 15px;
      margin-right: 10px;
      -webkit-transition: background .3s ease;
      transition: background .3s ease;
      vertical-align: middle;
      margin: 0 16px;
      box-shadow: none; 
      }
      .custom-checkbox .custom-control-indicator:after {
      content: "";
      position: absolute;
      display: inline-block;
      width: 18px;
      height: 18px;
      background-color: #f1f1f1;
      border-radius: 21px;
      box-shadow: 0 1px 3px 1px rgba(0, 0, 0, 0.4);
      left: -2px;
      top: -4px;
      -webkit-transition: left .3s ease, background .3s ease, box-shadow .1s ease;
      transition: left .3s ease, background .3s ease, box-shadow .1s ease; 
      }
      .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator {
      background-color: #84c7c1;
      background-image: none;
      box-shadow: none !important; 
      }
      .custom-checkbox .custom-control-input:checked ~ .custom-control-indicator:after {
      background-color: #84c7c1;
      left: 15px; 
      }
      .custom-checkbox .custom-control-input:focus ~ .custom-control-indicator {
      box-shadow: none !important; 
      }
      .sales {
      background: #f6f7fa none repeat scroll 0 0;
      border: 1px solid #f6f7fa;
      display: inline-block;
      padding: 15px;
      width: 100%;
      }
      .clock {
      z-index: -99;
      border-radius: 50%;
      background: #c5d7ff url(admin/img/ios_clock.svg) no-repeat center;
      background-size: 79%;
      height: 10em;
      padding-bottom: 8%;
      border: 7px solid #b5ccff;
      position: relative;
      width: 10em;
      margin-left: 7%;
      margin-top: 2%;
      box-shadow: 3px 4px #9dbbff;
      }
      .clock.simple:after {
      background: #000;
      border-radius: 50%;
      content: "";
      position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
      width: 5%;
      height: 5%;
      z-index: 10;
      }
      .hours-container {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      transform: rotate(150deg);
      }

      .minutes-container {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      transform: rotate(<?= $minuto ?>deg);
      }

      .seconds-container {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      transform: rotate(<?= $segundo ?>deg);
      }
      .hours {
      background: #1c3774;
      height: 20%;
      left: 48.75%;
      position: absolute;
      top: 30%;
      transform-origin: 50% 100%;
      width: 2.5%;
      }
      .minutes {
      background: #000;
      height: 40%;
      left: 49%;
      position: absolute;
      top: 10%;
      transform-origin: 50% 100%;
      width: 2%;
      }
      .seconds {
      background: #b43a3a;
      height: 45%;
      left: 49.5%;
      position: absolute;
      top: 14%;
      transform-origin: 50% 80%;
      width: 2%;
      z-index: 8;
      }
      .minutes-container {
      animation: rotate 3600s infinite steps(60);
      }
      .seconds-container {
      animation: rotate 60s infinite steps(60);
      }
      .sales {
    background: #ffffff none repeat scroll 0 0;
    border: 1px solid #d4d9e3;
    display: inline-block;
    padding: 4px;
    padding-top: 10px;
    width: 100%;
    min-height: 0vh;
    height: auto;
    margin-top: 2%;
}


      @keyframes rotate {
      100% {
      transform: rotateZ(360deg);
      }
      }
      .hours-container {
      animation: rotate 43200s infinite linear;
      }
      .minutes-container {
      animation: rotate 3600s infinite linear;
      }
      .seconds-container {
      animation: rotate 60s infinite linear;
      }

   </style>
   <body class="home">
      <div class="container-fluid display-table">
         <div class="row display-table-row">
            <?php include'includes/menu.php'; ?>
            <div style="padding: 0px;" class="col-md-10 col-sm-11 display-table-cell v-align">
               <div class="user-dashboard">
                  <div class="row">
                     <?php include'includes/compromisso.php'; ?>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <style type="text/css">
            .base {
    background: #f3f3f3;
    width: 100%;
    height: 89vh;
    position: absolute;
    top: 336px;
    z-index: -99;
}
.home {
    background: #ffffff!important;
}
</style>
      <!-- Modal -->
      <div id="add_project" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header login-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Add Project</h4>
               </div>
               <div class="modal-body">
                  <input type="text" placeholder="Project Title" name="name">
                  <input type="text" placeholder="Post of Post" name="mail">
                  <input type="text" placeholder="Author" name="passsword">
                  <textarea placeholder="Desicrption"></textarea>
               </div>
               <div class="modal-footer">
                  <button type="button" class="cancel" data-dismiss="modal">Close</button>
                  <button type="button" class="add-project" data-dismiss="modal">Save</button>
               </div>
            </div>
         </div>
      </div>
   </body>
   <script  src="//code.jquery.com/jquery-1.10.2.min.js" ></script>
   <script  src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js" ></script>
   
   <script type="text/javascript">
      $(window).load(function() {
          $(".loade").fadeOut("medium");
      });
   </script>

   <script type="text/javascript">
      $(document).ready(function(){
      $('[data-toggle="offcanvas"]').click(function(){
         $("#navigation").toggleClass("hidden-xs");
      });
      });
      
      /*
      * Starts any clocks using the user's local time
      * From: cssanimation.rocks/clocks
      */
      function initLocalClocks() {
      // Get the local time using JS
      var date = new Date;
      var seconds = date.getSeconds();
      var minutes = date.getMinutes();
      var hours = date.getHours();
      
      // Create an object with each hand and it's angle in degrees
      var hands = [
      {
      hand: 'hours',
      angle: (hours * 30) + (minutes / 2)
      },
      {
      hand: 'minutes',
      angle: (minutes * 126)
      },
      {
      hand: 'seconds',
      angle: (seconds * 6)
      }
      ];
      // Loop through each of these hands to set their angle
      for (var j = 0; j < hands.length; j++) {
      var elements = document.querySelectorAll('.' + hands[j].hand);
      for (var k = 0; k < elements.length; k++) {
        elements[k].style.webkitTransform = 'rotateZ('+ hands[j].angle +'deg)';
        elements[k].style.transform = 'rotateZ('+ hands[j].angle +'deg)';
        // If this is a minute hand, note the seconds position (to calculate minute position later)
        if (hands[j].hand === 'minutes') {
          elements[k].parentNode.setAttribute('data-second-angle', hands[j + 1].angle);
        }
      }
      }
      }
   </script>
   </body>
</html>