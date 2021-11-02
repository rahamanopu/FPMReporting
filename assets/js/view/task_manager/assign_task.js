$(document).ready(function () {
    $("#user_list").on('change', function () {
        var userId = $(this).val();
        if(userId==='') {
            $("#task_list_container").html("");
            return false;
        }
        $.ajax({
            url: base_url+"TaskManagement/getUserTask",
            type: 'get',
            data: {
                user_id: userId
            },
            beforeSend : function(){
                $("#task_list").html("");
            },
            success: function(data){
                $("#task_list_container").html("");
                $("#already_assigned_task_list").val("");
                data = JSON.parse(data);
                var len = data.length;
                for(var i= 0; i<len;i++) {
                    var taskId = data[i].TaskId;
                    var taskDetails = data[i].TaskDetails;
                    var taskType = data[i].TaskType;
                    var AssignStatus = data[i].AssignStatus;
                    var isChecked = "";
                    if(AssignStatus =='1') {
                        isChecked = "checked";
                        $("#already_assigned_task_list").val(function () {
                            return (this.value==='') ? taskId : this.value+','+taskId;
                        });
                    }
                    $("#task_list_container").append("<tr>" +
                        "<td style='vertical-align: middle;horiz-align: center' class='bold text-center'>"+taskType+"</td>" +
                        "<td><input type='checkbox' "+isChecked+"  name='task_list[]' value='"+taskId+"'><label class='margin-left-3'>"+taskDetails+"</label></td>" +
                        "</tr>");
                }
                fixit($("table"));
            },
            error: function (textStatus, errorThrown) {
                console.log(errorThrown);
            }
        });

    });
    function fixit(selector) {
        selector.each(function () {
            var values = $(selector).find("tr>td:first-of-type");
            var run = 1;
            for (var i=values.length-1;i>-1;i--){
                if ( values.eq(i).text()=== values.eq(i-1).text()){
                    values.eq(i).remove();
                    run++;
                }else{
                    values.eq(i).attr("rowspan",run);
                    run = 1;
                }
            }
        });
    }
});