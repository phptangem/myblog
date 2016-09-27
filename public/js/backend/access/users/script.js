$(function(){
    $("input[name='permission_user[]']").change(function(){
        checkDependencies($(this));
    });
    function checkDependencies(item){
        var dependencies = item.data('dependencies');
        console.log(dependencies);
        var count = 0;
        console.log(dependencies);
        for(var i = 0; i < dependencies.length; i++){
            if(item.is(":checked")){
                var permission = $("#permission-"+dependencies[i]);

                if(! permission.is(":checked"))
                    permission.prop('checked',true);

                count++;

                if(count == 1){
                    checkDependencies(permission);
                }
            }
        }
    }
});
