jQuery(document).ready(function($){
    $('.msr-like').on('click', function(){
        var post_id = $(this).data('post-id');
        var user_id = $(this).data('user-id');
        if(!user_id){
            alert('You must login into vote');
        }else{
            // alert("Success");
            $.ajax({
                url: msr_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'msr_post_voting',
                    pid: post_id,
                    uid: user_id,
                    type: 'like'
                },
                success: function(response){
                    alert(response.data.message);
                    // alert(response.data.message + "" + response.last_query);
                }
            });
        }
    });
    $('.msr-dislike').on('click', function(){
        var post_id = $(this).data('post-id');
        var user_id = $(this).data('user-id');
        if(!user_id){
            alert('You must login into vote');
        }else{
            // alert("Success");
            $.ajax({
                url: msr_ajax.ajax_url,
                type: 'POST',
                data: {
                    action: 'msr_post_voting',
                    pid: post_id,
                    uid: user_id,
                    type: 'dislike'
                },
                success: function(response){
                    alert(response.data.message);
                    // alert(response.data.message + "" + response.last_query);
                }
            });
        }
    });
});