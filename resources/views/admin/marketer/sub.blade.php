@extends('layouts.main')
@section('title','بازاریاب های زیردست')
@section('content')

<div>




        <div class="card-box shadow" style="overflow-x: auto;overflow-y:auto;height:100vh">


            {{-- <h4 class="header-title mt-0 mb-3">درخت ساده</h4> --}}

            <div id="basicTree">
               <?php echo $output; ?>

            </div>
        </div>
<script>
    $(document).ready(
    function(){
        $("#basicTree").jstree(
            {
                core:{themes:{responsive:!1}},
                types:{default:{icon:"mdi mdi-account-circle"},
                file:{icon:"mdi mdi-file"}},plugins:["types"]}),
                $("#checkTree").jstree({core:{themes:{responsive:!1}},
                    types:{default:{icon:"fa fa-folder"},
                    file:{icon:"fa fa-file"}},
                    plugins:["types","checkbox"]}),
                    $("#dragTree").jstree(
                        {
                        core:{check_callback:!0,
                            themes:{responsive:!1}},
                            types:{default:{icon:"fa fa-folder"},
                            file:{icon:"fa fa-file"}},plugins:["types","dnd"]})
                            ,$("#ajaxTree").jstree({core:{check_callback:!0,themes:{responsive:!1},
                                data:{
                                    url:function(e){return"#"===e.id?"assets/data/ajax_roots.json":"assets/data/ajax_children.json"},
                                    data:function(e){return{id:e.id}}}},types:{default:{icon:"fa fa-folder"},file:{icon:"fa fa-file"}},
                                    plugins:["contextmenu","dnd","search","state","types","wholerow"]})});
</script>
</div>
@endsection
