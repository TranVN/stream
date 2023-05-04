@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                
                    <div class="card-body">
                        {{-- @include('works.dienlanh') --}}
                        <table id="table1" class="table table-hover table-bordered ">
                            <thead class="thead-light"></thead>
                            <tbody></tbody>
                        </table>
                    </div>
            </div>
        </div>
    </div>

</div>

<script>
    
    var url = window.location+'/users' ;
    console.log(url);
    var t1,users=[];
    fetch(url)
    .then(response => response.json())
    .then(json => {
          t1=FathGrid("table1",{
            size:50,
            filterable:false,
            search:false,
           
            onChange:function(data,col,old,value){

                console.log("onChange:",data);
                fixColumn(data);
                return value==''?false:true;},
            columns:[
                {editable:false, name:'id',header:"ID"},
                {
                  name:'name', header:'Tên Công Việc'
                },
                {name:'email',header:'Địa chỉ'},
                //{name:'body',header:'Text',type:'textarea'},
            ],
            data:json,
          });
      });
  

    function fixColumn(data)
    {
        $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
       
        $.ajax({
               type:'POST',
               url:url,
               data:data,
               
               success:function(response) {
                //   $("#msg").html(data.msg);
                console.log(response);
               }
            });
    }
</script>
@endsection
