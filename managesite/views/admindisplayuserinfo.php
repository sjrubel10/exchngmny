<?php
//var_test( $usersData );

$usersDataHtml = '';
$totaluser = count( $usersData );
if( $totaluser > 0 ) {
    $usersDataHtml = '<table>  
                        <thead> 
                            <tr> 
                                <th>Name</th>
                                <th>Username</th>
                                <th>Mail</th>
                                <th>Make Active</th>
                                <th>Action</th>
                            </tr>
                        </thead>';
    foreach ($usersData as $key => $userData) {
        if( $userData['active'] == 1 ){
            $is_checked = 'checked';
        }else{
            $is_checked = '';
        }
        //    $usersDataHtml .= '<div class=""> <span class="">'.$userData['username'].'</span> </div>';
        $usersDataHtml .= '<tr id="user_' . $userData['userkey'] . '">
                                <td><a class="userLinkAmin" href="/'.HOSTNAME.'profile.php?profilekey='.$userData['userkey'].'">' . $userData['full_name']. '</a></td>
                                <td>' . $userData['username'] . '</td>
                                <td>' . $userData['mail'] . '</td>
                                <td><input id="isActive_'.$userData['userkey'].'" type="checkbox" '.$is_checked.' ></td>
                                <td><div id="make_'.$userData['userkey'].'" class="makeActiveSubmit">Submit</div></td>
                            </tr>';
    }

    $usersDataHtml .= '</tbody></table> ';
    if( $totaluser>= 20 ){
        $usersDataHtml .= '<div class="loadMoreButtonHolder"><div class="loadMoreButtonText loadMoreuserdata">Load More Users</div></div>';
    }
//    $usersDataHtml .= display_button( 'Load More Users', 'loadMoreButtonText', 'loadMoreButtonHolder', 'loadMoreUser');
}else{
    $usersDataHtml .= '<div class="emptyUserList">No User Found</div>';
}

echo $usersDataHtml;
?>

<style>
    table {
        font-family: Arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    th, td {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    th {
        background-color: #f2f2f2;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2;
    }
    .makeActiveSubmit{
        display: block;
        float: left;
        position: relative;
        text-align: center;
        padding: 5px 10px;
        background-color: #3aa2d1;
        cursor: pointer;
        border-radius: 3px;
        color: #F3f3f3;
    }
    .makeActiveSubmit:hover{
        background-color: #084e6d;
    }
</style>



