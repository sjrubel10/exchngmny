$(document).ready(function() {
    var is_post_loaded = 0;
    $("#adminContainer").on("click", ".adminTabChange", function () {
        let adminNavId = $(this).attr('id');
        let adminNavHolderId = adminNavId + '_holder';

        $("#" + adminNavId).addClass('adminNavSelect');
        $("#" + adminNavId).siblings().removeClass('adminNavSelect');

        $("#" + adminNavHolderId).show();
        $("#" + adminNavHolderId).siblings().hide();

    });

    $("#adminContainer").on("click", ".makeActiveSubmit", function () {
        let clickedId = $(this).attr('id');
        let clickedIdary = clickedId.split('_');
        let userkey = clickedIdary[1];
        let makeAdminCheckName = 'isActive_'+userkey;
        const findChecked = $("#"+makeAdminCheckName).is(":checked");
        const isChecked = findChecked ? 1 : 0;
        const body_data ={
            active : isChecked,
            userkey : userkey,
            deleteOrAdd:'makeActive'
        };
        const display_type = 'make_admin';
        const end_point = '../main/jsvalidation/make_active_user.php';
        const appendedId = '';
        get_data_from_api( end_point, body_data, appendedId, display_type );

    });

});



