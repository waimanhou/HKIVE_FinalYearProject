<?
require_once '../inc/common.inc.php';
session_destroy();
$_SESSION["adminLogined"] = false;
?><html>
    <head>
        <title>Find Sport System Administration</title>

        <link rel="stylesheet" type="text/css" href="../css/cupertino/jquery-ui-1.8.9.custom.css" />
        <link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="../css/common.css" />

        <script language="JavaScript" src="../js/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/i18n/grid.locale-zh.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/ckeditor_patch.js" type="text/javascript"></script>
        <script language="JavaScript" src="http://maps.google.com/maps/api/js?v=3&amp;sensor=false&language=zh-tw" type="text/javascript"></script>
        <style>
            label, input { display:block; }
            input.text { margin-bottom:12px; width:95%; padding: .4em; }
            fieldset { padding:0; border:0; margin-top:25px; }
            h1 { font-size: 1.2em; margin: .6em 0; }
            div#users-contain { width: 350px; margin: 20px 0; }
            div#users-contain table { margin: 1em 0; border-collapse: collapse; width: 100%; }
            div#users-contain table td, div#users-contain table th { border: 1px solid #eee; padding: .6em 10px; text-align: left; }
            .ui-dialog .ui-state-error { padding: .3em; }
            .validateTips { border: 1px solid transparent; padding: 0.3em; }
        </style>
        <script>
            $(function() {


                $( "#dialog-wrong" ).dialog({
                    autoOpen: false,
                    modal: true,
                    width: 400,
                    close: function() {
                        $( "#dialog-form" ).dialog("open");
                    }
                });


                $( "#dialog-form" ).dialog({
                    autoOpen: false,
                    height: 500,
                    width: 600,
                    modal: true,
                    buttons: {
                        "Login": function() {
                            $("#loginForm").submit();
                        },
                        "Cancel": function() {
                            $( this ).dialog( "close" );
                        }
                    },
                    close: function() {
                        location="../"
                    }
                });

<? if ($_GET["wrongpw"]) { ?>
            $( "#dialog-wrong" ).dialog("open");
<? } else { ?>
            $( "#dialog-form" ).dialog("open");
<? } ?>

    });
        </script> <script type="text/javascript">
            var RecaptchaOptions = {

                custom_translations : {
                    visual_challenge : "取得圖形驗證碼",
                    audio_challenge : "取得音效驗證碼",
                    refresh_btn : "重新整理圖形",
                    instructions_visual : "輸入兩個英文單字:",
                    instructions_audio : "輸入您聽到的聲音:",
                    help_btn : "獲得協助",
                    play_again : "重新播放音效",
                    cant_hear_this : "將音效下載為 MP3",
                    incorrect_try_again : "錯誤！ 請再試一次"
                },
                theme : 'clean'
            };
        </script>

    </head>
    <body>
        <div id="dialog-wrong" title="FindSport System Administration">
            <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>Wrong username/password.</p>
        </div>

        <div id="dialog-form" title="FindSport System Administration">
            <form id="loginForm" action="login.php" method="POST">
                <fieldset>
                    <label for="loginName">Login Name:</label>
                    <input type="text" name="loginName" id="loginName" class="text ui-widget-content ui-corner-all" />
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="" class="text ui-widget-content ui-corner-all" />
                    <label for="adminpassword">Administration Password:</label>
                    <input type="password" name="adminpassword" id="adminpassword" value="" class="text ui-widget-content ui-corner-all" />
                    <?
                    require_once(ROOT . '/inc/recaptcha.lib.php');
                    echo recaptcha_get_html(RECAPTCHA_PUBLIC_KEY);
                    ?>
                    <input type="hidden" name="ticket" value="<?= newTicket("administratorlogin") ?>">
                </fieldset>
            </form>
        </div>





    </body>
</html> 