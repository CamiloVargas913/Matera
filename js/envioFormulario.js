$(document).ready(function () {

  $('.planta').submit(function(e){
    e.preventDefault();
    var data = $(this).serializeArray();
    data.push({name:'tag',value:'planta'});
    $.ajax({
      url:'guardarPlanta.php',
      type:'post',
      dataType:'json',
      data:data,
      beforeSend:function(){
        $('.cargas').css('display','inline');
      }
    })
    .done(function(){
      $('.men').html('<div class="alert bg-success" role="alert"><em class="fa fa-check-circle mr-2"></em> Datos Guardados  <a href="cards.php" class="float-right"><em class="fa fa-remove"></em></a></div>');
    })
    .fail(function(){
      $('.men').html('<div class="alert bg-danger" role="alert"><em class="fa fa-minus-circle mr-2"></em>Error Al Guardar  <a href="cards.php" class="float-right"><em class="fa fa-remove"></em></a></div>');
    })
    .always(function(){
      $('.cargas').hide();
    })
  })
})