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
            <a class="logotextlink" href="/<?php echo HOSTNAME?>index.php"><span class="logotext"><h3><?php echo $siteInfoData['siteName']?></h3></span></a>
        </div>

        <div class="cta">
            <?php
            if( isset( $_SESSION['logged_in'] ) && $_SESSION['logged_in'] ){?>
                <!--<div class="loggedInProfile" style="display: block">
                    <div class="profileTextAndLink">
                        <a href="/<?php /*echo HOSTNAME*/?>?profilekey=<?php /*echo$_SESSION['logged_in_user_data']['userkey']*/?>"><span class="btn">Profile</span></a>
                    </div>
                    <div class="LoggedOutTextAndLink">
                        <a href="/<?php /*echo HOSTNAME*/?>logout.php"><span class="btn">Logout</span></a>
                    </div>
                </div>-->

<!--               <button class="btn">Logout</button>-->

                <div class="profileMenuHolder">
                    <span onclick="toggleDropdown()" class="dropbtn">You</span>
                    <div id="myDropdown" class="dropdown-content">
                        <a href="/<?php echo HOSTNAME?>profile.php?profilekey=<?php echo$_SESSION['logged_in_user_data']['userkey']?>"><span class="profileBtn">Profile</span></a>
                        <a href="/<?php echo HOSTNAME?>logout.php"><span class="logoutBtn">Logout</span></a>
                    </div>
                </div>

                <?php if( $_SESSION['logged_in_user_data']['admin'] ===1 &&  $_SESSION['logged_in_user_data']['recorded'] ===1){?>
                    <div class="profileMenuHolder">
                        <a class="adminBtnHolder" href="/<?php echo HOSTNAME?>managesite/admin.php"><span class="adminBtn">Admin</span></a>
                    </div>
                <?php }?>
            <?php } else {?>
                <a href="/<?php echo HOSTNAME?>login.php"><button class="btn">Login</button></a>
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

    function toggleDropdown() {
        var dropdown = document.getElementById("myDropdown");
        dropdown.classList.toggle("show");
    }
    window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
    }

</script>


