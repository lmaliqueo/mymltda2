$(function() {
	/*$(document).on('click','.fc-day',function(){
		var date = $(this).attr('data-date');
		var ot = document.getElementById("idOT").innerHTML;
		$.get('index.php?r=actividades/crear',{'date':date, 'ot':ot},function(data){
		     $('#modal').modal('show')
		     .find('#modalContent')
		     .html(data);
		});

	});*/
	
   $('#asignar').click(function() {
     $('#item').show();
   });

/*
	$(document).on('click','.fc-content',function(){
		var act = $(this).text();

		for (i = 1, len = act.length, text = ""; i < len; i++) { 
		    text += act[i];
		}

		$.get('index.php?r=actividades/view-modal',{'act':text},function(data){
		     $('#modalview').modal('show')
		     .find('#modalContent')
		     .html(data);
		});

	});
*/
   $('#modalButton').click(function() {
     $('#modal').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });
   $('.modalView').click(function() {
     $('#modal-view').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });
   $('.modalForm').click(function() {
     $('#modal').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });
   $('#transaccionModal').click(function() {
     $('#modalTran').modal('show')
     .find('.modalContent')
     .load($(this).attr('value'));
   });

    $('.modalViewTn').click(function() {
        $('#modal-view-tn').modal('show')
        .find('.modalContent')
        .load($(this).attr('value'));
    });

});

