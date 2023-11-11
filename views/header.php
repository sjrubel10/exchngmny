<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<!--    <link rel="stylesheet" href="../assets/css/header.css">-->
    <title>Your Website</title>
</head>
<body>
<header class="header">
    <div class="headerContainer" id="headerContainer">

        <div class="menuIconHolder">
            <a class="logotextlink" href="/dlrtotk/index.php"><span class="logotext"><h3><?php echo $siteInfoData['siteName']?></h3></span></a>
        </div>

        <div class="cta">
            <?php
            if( isset( $_SESSION['logged_in'] ) && $_SESSION['logged_in'] ){?>
                <a href="/dlrtotk/logout.php"><button class="btn">Logout</button></a>
                <?php if( $_SESSION['logged_in_user_data']['admin'] ===1 &&  $_SESSION['logged_in_user_data']['recorded'] ===1){?>
                    <a href="/dlrtotk/managesite/admin.php"><button class="btn">Admin</button></a>
                <?php }?>
            <?php } else {?>
                <a href="/dlrtotk/login.php"><button class="btn">Login</button></a>
            <?php }?>
        </div>
    </div>
</header>
<!-- Rest of your website content goes here -->
</body>
</html>

<script>
    function divFunction(){
        let originalString = $("#search-input").val();

        if( originalString ){
            var modifiedString = originalString.replace(/ /g, '+').trim();
            window.location.href = "search.php?searchkey="+modifiedString+"";
        }else{
            alert("Input Something In Search Box");
        }

    }

    $(".menushowHide").click(function(){
        // let id = $(this).attr('id');
        if($('#leftnavbarHolder').css('display') === 'none') {
            $("#leftnavbarHolder").show();
        }else {
            $("#leftnavbarHolder").hide();
        }
    });

</script>


