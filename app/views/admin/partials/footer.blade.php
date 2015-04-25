{{-- /home/vagrant/Code/ajaxcrud4/app/views/admin/partials/footer.blade.php --}}
<div class="footer">
    <div class="container">
        <b class="copyright">&copy; 2014 Edmin - EGrappler.com </b>All rights reserved.
    </div>
</div>
<script src="{{ URL::asset('packages/scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/plugins/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/scripts/flot/jquery.flot.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/scripts/flot/jquery.flot.resize.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/scripts/datatables/jquery.dataTables.js')}}" type="text/javascript"></script>
<script src="{{ URL::asset('packages/scripts/common.js')}}" type="text/javascript"></script>

<script>
$('#category_form').submit(function(){
	$.post('{{ URL::route('category.create') }}', $(this).serialize(), function(response){
		// console.log(res);
		var info = $('.avatar_alert');
		 info.hide().find('ul').empty();
        if(!response.success)
        {
        	for(var k in response.msg){
        		if(response.msg.hasOwnProperty(k)){
        			response.msg[k].forEach(function(val){
        			    info.find('ul').append('<li>' + val + '</li>');	
        			});
        			
        		}
        	}

            info.slideDown();
        }
        else if(response.success){
          window.location = "{{ URL::route('category.index')}}";
        }

	});

	return false;
});

$('.category_edit').on('click', function(){
    var id = $('td:first', $(this).parents('tr')).text();
    $.get('/edit/'+id, function(response){
        for (var i in response) {
            $('input[name="'+i+'"]').val(response[i]);
        }
    },'json');
});

$('.category_show').click(function(){
    var id = $('td:first', $(this).parents('tr')).text();
    $('#views').empty();
    $.get('/show/'+id, function(response){
            $('#views').append($('<p>', {text: [response.name, response.id] })).find('p').addClass("text-success");
            $('#views').append($('<p>', {text: [response.slug] })).find('p').addClass("text-error");
    }, 'json');
});

// $('.category_delete').on('click', function(){
//     var id = $('td:first', $(this).parents('tr')).text();
//     $.get('/delete/'+id, function(response){
//         if(!response.success)
//         {
//             for(var k in response.msg){
//                 if(response.msg.hasOwnProperty(k)){
//                     response.msg[k].forEach(function(val){
//                         info.find('ul').append('<li>' + val + '</li>'); 
//                     });
                    
//                 }
//             }

//             info.slideDown();
//         }
//         else if(response.success){
//           window.location = "{{ URL::route('category.index')}}";
//         }
//     },'json');
// });

$('.delete-event').click(function(evnt) {
            var href = $(this).attr('href');
            var message = $(this).attr('data-content');
            var title = $(this).attr('data-title');
            var html = $('.deletemodal').html();

            if (!$('#dataConfirmModal').length) {
                $('body').append(html);
            } 

            $('#dataConfirmModal').find('.modal-body').text(message);
            $('#dataConfirmOK').attr('href', href);
            $('#dataConfirmModal').modal({show:true});
});
// 
// $('#confirm-delete').on('click', function(e) {
//     $(this).find('.btn-ok').attr('href', $(e.relatedTarget).data('href'));
// });
</script>