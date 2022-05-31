$(document).on('click', '.follow', function(){
    var userId = $(this).data("userid");
    var action = 'followUser';
    $.ajax({
        url:'user_action.php',
        method:"POST",
        data:{userId:userId, action:action},
        dataType:"json",
        success:function(response){
            if(response.success == 1) {
                $("#follow_"+userId).text("Following");
                $("#following").text(parseInt($("#following").text()) + 1);
            }
        }
    });
});

$("#postSection").on('submit','#postForm', function(event){
    event.preventDefault();
    $('#save').attr('disabled','disabled');
    $('#action').val('addPost');
    var formData = $(this).serialize();
    $.ajax({
        url:"user_action.php",
        method:"POST",
        data:formData,
        success:function(data){
            $('#postForm')[0].reset();
            $('#postShareButton').attr('disabled', false);
            location.reload();
        }
    });
});

$(document).on('click', '.likePost', function(){
    var postId = $(this).data("post-id");
    var action = 'likePost';
    $.ajax({
        url:'user_action.php',
        method:"POST",
        data:{postId:postId, action:action},
        dataType:"json",
        success:function(response){
            if(response.success == 1) {
                $("#like_"+postId).removeClass('likePost').addClass('dislikePost');
                $("#likeIcon_"+postId).removeClass('fa fa-thumbs-up').addClass('fa fa-thumbs-down').attr("title", "Liked");
            }
        }
    });
});