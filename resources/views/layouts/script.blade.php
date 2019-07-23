<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    
    $(() => {
      $('#table').DataTable();
  } );
  function deleteprod(id){
    $.ajax({
        "url":"{{ url('/product/') }}" + '/' + id,
        "data":{
            "_token": "{{ csrf_token() }}"
        },
        "type": "DELETE",
        "success": (html)=>{
            console.log(html);
        }
    })
  }
   </script>