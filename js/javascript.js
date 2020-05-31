function validateEmail(){
    var patt = /^.+@.+[.].{2,}$/i;
    if(patt.test($("input[name=email]").val())){
        $("#btn_save").prop("disabled", false);
        $("#form_row").empty();
    }else{
        $("#btn_save").prop("disabled", true);
        $("#form_row").empty();
        $("#form_row").append("<div class='alert alert-danger'>Email not valid!</div>")
    }
}