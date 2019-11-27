$(document).ready(function(){

  IndexDAO.FechaCierre();

  var link = document.querySelector("link[rel*='icon']") || document.createElement('link');
  link.type = 'image/x-icon';
  link.rel = 'shortcut icon';
  link.href = 'http://191.98.186.82:8080/SFW/favicon.ico';
  document.getElementsByTagName('head')[0].appendChild(link);

  

  
  // $("#jMenu").jMenu({
  //     openClick : false,
  //     ulWidth :'200',
  //     TimeBeforeOpening : 100,
  //     TimeBeforeClosing : 11,
  //     animatedText : false,
  //     paddingLeft: 1,
  //     effects : {
  //         effectSpeedOpen : 150,
  //         effectSpeedClose : 150,
  //         effectTypeOpen : 'slide',
  //         effectTypeClose : 'slide',
  //         effectOpen : 'swing',
  //         effectClose : 'swing'
  //     }
  //   });

    // var body = document.body.offsetHeight;
    // var terciario =$("#terciario").css('height');
    // var principal = parseFloat(body) - parseFloat(terciario);
    // var secundario = parseFloat(body) - parseFloat(terciario);

    // $("#principal").css({'height':principal});
    // $("#secundario").css({'height':secundario});

});

function atumatic(){
  setInterval(function(){
      IndexDAO.FechaCierre(); // this will run after every 5 seconds
  }, 2000);

}

atumatic();