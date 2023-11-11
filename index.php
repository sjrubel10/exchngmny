<?php
require  "main/init.php";
$conn = Db_connect();

$filename = 'managesite/siteInfo.json';
$siteInfoData = getDataFromJsonFile( $filename );
// var_test_die( $siteInfoData );
$buysale_rate = array(
        0=>array('method'=>'Skrill', 'buy_rate'=>$siteInfoData['todayDollerBuyRateskrill'], 'sale_rate'=> $siteInfoData['todayDollerSellRateskrill']),
        1=>array('method'=>'Neteller', 'buy_rate'=>$siteInfoData['todayDollerBuyRateneteller'], 'sale_rate'=> $siteInfoData['todayDollerSellRateneteller']),
        2=>array('method'=>'Perfect money', 'buy_rate'=>$siteInfoData['todayDollerBuyRateperfectMoney'], 'sale_rate'=> $siteInfoData['todayDollerSellRateperfectMoney']),
);

$today_buySell_Rate = array(
    "todayDollerBuyRateskrill" => $siteInfoData['todayDollerBuyRateskrill'],
    "todayDollerBuyRateneteller" => $siteInfoData['todayDollerBuyRateneteller'],
    "todayDollerBuyRateperfectMoney" => $siteInfoData['todayDollerBuyRateperfectMoney'],
    "todayDollerSellRateskrill" => $siteInfoData['todayDollerSellRateskrill'],
    "todayDollerSellRateneteller" => $siteInfoData['todayDollerSellRateneteller'],
    "todayDollerSellRateperfectMoney" =>  $siteInfoData['todayDollerSellRateperfectMoney']
);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteInfoData['siteTitle']?></title>
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="stylesheet" href="assets/css/header.css">
    <link rel="stylesheet" href="assets/css/buysellstyles.css">
    <link rel="stylesheet" href="assets/css/common.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    
</head>
<body>
    <?php include_once "views/header.php"?>

    <div class="indexContentHolder">
        <div class="banner-text">
            <h1><?php echo $siteInfoData['siteTitle']?></h1>
            <p><?php echo $siteInfoData['siteDescription']?></p>
        </div>

        <div class="buySellButtonHolder" id="buySellButtonHolder">
            <div class="buysellBtnContainer">
                <div class="buyButton getBtnTypeBacground getBtnType" id="buyButton">Buy Dollar</div>
                <div class="sellButton getBtnTypeBacground getBtnType" id="sellButton">Sell Dollar</div>
            </div>
            <div class="buySellCardHolder" id="buySellCardHolder"></div>
        </div>

        <div class="dollerRateHolder">
            <h2 class="dollerRateTitleText">Todays Dollar Rate</h2>
            <div class="buySellRate">
                <table class="buyRatetable">
                    <tbody class="buyrateBody">
                        <tr class="ratetableColumnHolder">
                            <th class="ratetableColumn">Number</th>
                            <th class="ratetableColumn">Method</th>
                            <th class="ratetableColumn">Buy Rate</th>
                        </tr>
                        <?php foreach ( $buysale_rate as $key => $rate){
                            $number = $key+1;
                            ?>
                        <tr class="ratetableColumnHolder">
                            <td class="ratetableColumn"><?php echo $number;?></td>
                            <td class="ratetableColumn"><?php echo $rate['method'];?></td>
                            <td class="ratetableColumn"><?php echo $rate['buy_rate'];?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
                <table class="saleRatetable">
                    <tbody class="salerateBody">
                        <tr>
                            <th>Number</th>
                            <th>Method</th>
                            <th>Sale Rate</th>
                        </tr>
                        <?php foreach ( $buysale_rate as $key => $rate){
                            $number = $key+1;
                            ?>
                        <tr>
                            <td class=""><?php echo $number;?></td>
                            <td class=""><?php echo $rate['method'];?></td>
                            <td class=""><?php echo $rate['sale_rate'];?></td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</body>
</html>

<script src="assets/js/common.js"></script>
<script src="assets/js/index.js"></script>
<script>
    $(document).ready(function(){

        var todatBuySellRate = <?php echo json_encode( $today_buySell_Rate )?>;
        // console.log( todatBuySellRate );
       
        
        var butSellType = '';
        let is_logged_in = <?php echo json_encode( $is_logged_in )?>;
        $("#buySellButtonHolder").on("click", ".getBtnType", function () {

            if( is_logged_in || 1 ){
                let clickedId = $(this).attr('id');
                $("#"+clickedId).addClass("selectedBuySell");
                $("#"+clickedId).removeClass("getBtnTypeBacground");
                $("#"+clickedId).siblings().removeClass("selectedBuySell");
                $("#"+clickedId).siblings().addClass("getBtnTypeBacground");
                 butSellType = $("#"+clickedId).text().trim();
                let buySellForm = get_money_exchange_form( butSellType );
                $("#buySellCardHolder").html( buySellForm );
            }else{
                alert( "For Buy Or Sale Any Type Of Transaction Please Logged IN First ");
            }
            
        });
        $("body").on("click", ".submitBuySell", function () {
            event.preventDefault();
            var formData = $("#transaction-form").serialize();
            $.ajax({
                type: "POST",
                // url: 'main/jsvalidation/buysellvalidate.php',
                data: formData,
                success: function(response) {
                    console.log( response );
                    alert(response['success']);
                    $("#buySellCardHolder").fadeOut();
                    // $("#response").html(response);
                }
            });
        });

        $("body").on("click", ".cancelBuySell", function () {
            $("#buySellCardHolder").fadeOut();
            // $("#buyButton").removeClass("selectedBuySell");
            // $("#sellButton").removeClass("selectedBuySell");
        });

        // $("#myInput").keypress(function(event) { receive_amount
        $("body").on("keyup", "#send_amount", function () {
            let receive_method_val = $("#receive_method").val();
            
            if( butSellType.trim() === 'Buy Dollar' ){
                var getMethodRate = 'todayDollerBuyRate'+receive_method_val;
            }else{
                getMethodRate = 'todayDollerSellRate'+receive_method_val;
            }       
            let todaysExchangeRate = todatBuySellRate[getMethodRate];

            let currentValue = $(this).val();
            let sendValue = currentValue*todaysExchangeRate;
            $("#receive_amount").val( sendValue );
        });

});
</script>