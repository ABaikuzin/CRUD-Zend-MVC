jQuery(function($) {
    $("#create").on('click', function(event){
        event.preventDefault();
        var $cd = $(this);
        $.post("CdManager/add", null,
            function(data){
                if(data.response == true){
                    $cid=data.new_cd_id;
                    $cd.before("<div id='cd_label'><b>CD #"+$cid+"</b><table><tr><td>Name:</td><td><input class='text' id='cd-name-"+$cid+"' type='text' name='name' value=''></td></tr><tr><td>Year:</td><td><input class='text' id='cd-year-"+$cid+"' type='text' name='year' maxlength='4' value=''></td></tr><tr><td style='color: gray;'>Created:</td><td><input class='text' id='cd-created-"+$cid+"' type='text' name='name' disabled value='2014-12-23 10:02:59'></td></tr><tr><td style='color: gray;'>Updated:</td><td><input class='text' id='cd-updated-"+$cid+"' type='text' name='name' disabled value='2014-12-23 05:03:00'></td></tr></table><textarea class='text' style='resize: none; overflow: hidden;' rows='2' cols='28' id='cd-note-"+$cid+"'></textarea></div><a href='#' id='remove-<?php echo $cd->getId(); ?>'class='delete-cd'>X</a></div>");
                    
                // print success message
                } else {
                    // print error message
                    console.log('could not add');
                }
            }, 'json');
    });

    $('#cd-manager').on('click', 'a.delete-cd',function(event){
        event.preventDefault();
        var $cd = $(this);
        var remove_id = $(this).attr('id');
        remove_id = remove_id.replace("remove-","");

        $.post("CdManager/remove", {
            id: remove_id
        },
        function(data){
            if(data.response == true)
                $cd.parent().remove();
            else{
                // print error message
                console.log('could not remove ');
            }
        }, 'json');
    });

    $('.text').on('keyup', function(event){
        var $cd = $(this);
        var update_id = $cd.attr('id'),
        update_content = $cd.val();
        update_id = update_id.replace("cd-","");

        $.post("CdManager/update", {
            id: update_id,
            content: update_content
        },function(data){
            if(data.response == false){
                // print error message
                console.log('could not update');
            }
        }, 'json');

    });
});
