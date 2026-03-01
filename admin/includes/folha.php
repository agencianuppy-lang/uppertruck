
<style>
.home {
    background: linear-gradient(to bottom, #9dbbff, #ffffff);
}
.base {
    background: #c5d7ff;
    width: 100%;
    height: 89vh;
    position: absolute;
    top: 336px;
    z-index: -99;
}
.loader {
    width: 325px;
    position: absolute;
    left: 126px;
    -webkit-animation: mymove 10s infinite;
    animation: mymove 10s infinite;
}

.sales {
    background: #f6f7fa00 none repeat scroll 0 0;
    border: 1px solid #f6f7fa00;
    display: inline-block;
    padding: 15px;
    width: 100%;
}
.plane2 {
  animation: mymove 15s linear infinite;
  position: absolute;
  left: 0;
  bottom: 0;
}

/* Safari 4.0 - 8.0 */
@-webkit-keyframes mymove {
  0% {
    left: 20%;
    transform: rotateY(0deg);
  }
  49% {
    transform: rotateY(0deg);
  }
  50% {
    left: 70%;
    transform: rotateY(180deg);
  }
  99% {
    transform: rotateY(180deg);
  }
  100% {
    left: 20%;
    transform: rotateY(0deg);
  }

}

</style>

<div class="loader">
  
<?php include'includes/robozin.html' ?>

</div>