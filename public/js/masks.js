function verifyMask() { 
    if($('#tipo_doc').val() == "C"){
        $("#documento").mask('000.000.000-00');
    } else {
        $("#documento").mask('00000000000000000000');
    }
}
$(document).ready(function(){
    verifyMask();
});
$("#tipo_doc").change(function(){
    verifyMask();
});
