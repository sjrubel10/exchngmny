<style>
    .tabs {
        display: flex;
        justify-content: space-around;
        background-color: #f2f2f2;
        padding: 10px 0;
    }

    .tab {
        flex: 1;
        text-align: center;
        padding: 10px;
        cursor: pointer;
        border-bottom: 2px solid transparent;
        transition: border-bottom 0.3s ease;
    }

    .tab:hover {
        border-bottom: 2px solid #3498db;
    }

    .tab.active {
        border-bottom: 2px solid #3498db;
    }
</style>

<?php
function table_head_html( $forDollerBuy, $type ){
    if( $type === 'all' ){
        if (($dellkey = array_search('Action', $forDollerBuy)) !== false) {
            unset($forDollerBuy[$dellkey]);
        }
    }

    if( $type === 'sell' ){
        if (($dellkey = array_search('bKash Transaction ID', $forDollerBuy)) !== false) {
            unset($forDollerBuy[$dellkey]);
        }
    }

    $usersDataHtml = '<thead><tr>';
    foreach ( $forDollerBuy as $key => $userData) {

        //    $usersDataHtml .= '<div class=""> <span class="">'.$userData['username'].'</span> </div>';
        $usersDataHtml .= '<th>'.$userData.'</th>';
    }
    $usersDataHtml .= '</tr></thead>';
    return $usersDataHtml;
}
function table_body_html( $dataforDollerBuy, $type ){
    $i =1;
    $usersDataHtml1 = '<tbody>';
    foreach ( $dataforDollerBuy as $key => $getData) {

        if( $type === 'all' ){
            $need_action = '';
        }else{
            $need_action = '<td class="makeConfirm"> <span id="confirm_'.$key.'" class="makeConfirmText">Confirm</span> </td>';
        }

        if( $type === 'sell' ){
            $bksTrID = '';
        }else{
            $bksTrID = '<td>' . $getData['bKash_tRX_ID'] . '</td>';
        }

        $usersDataHtml1 .= '<tr id="'.$key.'">
                                <td>' . $i. '</td>
                                <td>' . $getData['full_name'] . '</td>
                                <td>' . $getData['mail'] . '</td>
                                <td> 0175362025 </td>
                                <td>' . $getData['bKash_number'] . '</td>
                                '.$bksTrID.'
                                <td>' . $getData['send_amount'] . '</td>
                                <td>' . $getData['receive_amount'] . '</td>
                                <td>' . $getData['receive_method'] . '</td>
                                <td>' . $getData['send_method'] . '</td>
                                <td>' . $getData['transaction_date'] . '</td>
                                '.$need_action.'
                            </tr>';
        $i++;
    }
    $usersDataHtml1 .= '</tbody>';

    return $usersDataHtml1;
}

?>

<div class="post-card_holde">
    <div class="tabs">
        <div id="buyDollar" class="tab controlPost adminNavSelect">Buy Dollar</div>
        <div id="sellDollar" class="tab controlPost">Sell Dollar</div>
        <div id="allbuySellDollar" class="tab controlPost">All Done</div>
    </div>
    <div class="tabsContentHolder">
        <div id="buyDollar_holder" class="tabContentHolder" style="display: block;">
            <h3>Buy Dollar request</h3>
            <div class="buyRequestHolder">
                <?php if( count( $buy_data )> 0 ){?>
                    <table class="requestTable" id="buyrequestTable">
                        <?php
                            echo table_head_html( $forDollerBuy, 'buy' );
                            echo table_body_html( $buy_data,'buy' );
                        ?>
                    </table>
                <?php } else {?>
                    <div class="emptyResultHolder"><div class="emptyResultText">No Buy request Available</div></div>
                <?php }?>
            </div>
        </div>
        <div id="sellDollar_holder" class="tabContentHolder" style="display: none;">
            <h3> Sell Dollar request</h3>
            <div class="buyRequestHolder">
                <?php if( count( $sell_data )> 0 ){?>
                    <table class="requestTable" id="sellrequestTable">
                        <?php
                            echo table_head_html( $forDollerBuy, 'sell' );
                            echo table_body_html( $sell_data, 'sell' );
                        ?>
                    </table>
                <?php } else {?>
                    <div class="emptyResultHolder"><div class="emptyResultText">No Sell request Available</div></div>
                <?php }?>
            </div>
        </div>
        <div id="allbuySellDollar_holder" class="tabContentHolder" style="display: none;">
            <h3> All Done</h3>
            <div class="buyRequestHolder">
                <?php if( count( $all_data )> 0 ){?>
                    <table class="requestTable" id="sellrequestTable">
                        <?php
                            echo table_head_html( $forDollerBuy, 'all' );
                            echo table_body_html( $all_data, 'all' );
                        ?>
                    </table>
                <?php } else {?>
                    <div class="emptyResultHolder"><div class="emptyResultText">No Confirmation Available</div></div>
                <?php }?>
            </div>
        </div>
    </div>
</div>
<?php
$clcikedClass = 'controlPost';
$selected_class = 'adminNavSelect';
?>
<script>
    $(document).ready(function(){
        let isAdmin = <?php echo json_encode( $is_admin )?>;
        let addSelectedClass = <?php echo json_encode( $selected_class )?>;
        let clickClassName = <?php echo json_encode( $clcikedClass )?>;
        let clickClassHolderIdName = 'adminContainer';
        let display_limit = 20;
        const display_type = 'display_news_control';
        navigate_tabs( clickClassHolderIdName, clickClassName, addSelectedClass, display_type, display_limit );

        $("#adminContainer").on("click", ".makeConfirmText", function () {
            if( isAdmin ) {
                let clickedId = $(this).attr('id');
                let clickedIdary = clickedId.split('_');
                let buySellKey = clickedIdary[1];
                const body_data = {
                    buySellKey: buySellKey
                };
                const end_point = '../main/jsvalidation/confirmTransaction.php';
                $.post(
                    end_point,
                    body_data,
                    function (data) {
                        try {
                            let result_data = JSON.parse(data);
                            if (result_data['success']) {
                                $("#"+buySellKey).hide();
                                alert(result_data.message);
                            } else {
                                console.log(result_data['error_code']);
                                console.log(result_data['data']);
                            }
                        } catch (error) {
                            console.log(error);
                        }
                    });
            }
        });


    });


</script>
