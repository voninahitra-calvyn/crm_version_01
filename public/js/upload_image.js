//on change select logo image
$('#logo-centre').change(function(e){
    var fileName = e.target.files[0].name;
//alert('The file "' + fileName +  '" has been selected.');
    $('#is_logo').val('Oui');
    $('#hidden_logo').val('');
    $('#hidden_logo').val(fileName);
    $('#btnmodiflogo').click();


    if($('#hidden_logo').val()==''){
        $("#btnajouter").show();
        $("#btnremplacer").hide();
        $("#btnsupprimer").hide();
    }else{
        $("#btnajouter").hide();
        $("#btnremplacer").show();
        $("#btnsupprimer").show();
    }
    $('#logoInputfile').change(function(e){
        var fileName = e.target.files[0].name;
        // alert('The file "' + fileName +  '" has been selected.');
        $('#is_logo').val('Oui');
        $('#hidden_logo').val('');
        $('#hidden_logo').val(fileName);
        $('#btnmodiflogo').click();
    });
    
    $("#btnsupprimer").click(function(){
        $('#hidden_logo').val('');
    });
    
});
