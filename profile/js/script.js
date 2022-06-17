$(document).ready(function () {
    $(".exercise_circle").click(function (e) {
        if (e.target?.id) {
            document.cookie = `exercise_id=${e.target.id}`
            $("#open_box").hide();
            $("#close_box").show();
            $.ajax({url:`../scripts/new_workout_header.php?exercise_id=${e.target.id}`, success:function(result){
                    $("#add-workout-header").html(result);
                }
            });
        }
    });
    $("#return_icon").click(function () {
        $("#close_box").hide();
        $("#open_box").show();
    });
})