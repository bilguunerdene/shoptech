function minusval(id,quantity){
    $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())-quantity);
}
function addval(id,quantity){
    $("#inputbtn"+id).val(parseInt($("#inputbtn"+id).val())+quantity);
}