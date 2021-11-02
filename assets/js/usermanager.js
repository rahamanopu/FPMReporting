function isNumber(evt) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
// Check for duplicate userId
$('#userid').on('blur',function () {
    var userid = $(this).val();
    loadUserData(userid,this);
});
function loadUserData(userid,element){
    $.ajax({
        url: base_url + "usermanager/userdata",
        type: "post",
        data: "userid=" + userid,
        success: function (response) {
            data = JSON.parse(response);
            objSubmit = document.getElementById("submit");
            objErrormsg = document.getElementById("errormsg");
            if(data.length){
                objSubmit.disabled = true;
                objErrormsg.innerHTML = "User id already exists.";
                $(element).addClass('error');
            }else{
                objSubmit.disabled = false;
                objErrormsg.innerHTML = "";
                $(element).removeClass('error');
            }
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}