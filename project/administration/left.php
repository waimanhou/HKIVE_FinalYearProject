<?
require_once 'common.inc.php';
?>
<head>
	<title></title>

        <link rel="stylesheet" type="text/css" href="../css/cupertino/jquery-ui-1.8.9.custom.css" />
        <link rel="stylesheet" type="text/css" href="../css/ui.jqgrid.css" />
        <link rel="stylesheet" type="text/css" href="../css/common.css" />

        <script language="JavaScript" src="../js/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery-ui-1.8.9.custom.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/i18n/grid.locale-zh.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.jqGrid.min.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/jquery.togglePanel.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/ckeditor.js" type="text/javascript"></script>
        <script language="JavaScript" src="../ckeditor/adapters/jquery.js" type="text/javascript"></script>
        <script language="JavaScript" src="../js/ckeditor_patch.js" type="text/javascript"></script>
      <script>
	$(function() {
		$( "#accordion" ).togglePanel(/*{
                      changestart: function(event, ui) {
                            if(ui.newContent.html()==""){
                                top.location="./login.php?q=logout"
                            }
                      }
                }*/);
	});
	</script>

</head>
<body style="font-size: 62.5%;">


<div id="accordion" style="height:100%">

        <h3 onclick="parent.mainFrame.location='./right.php'"><a href="#" id="logout">Home</a></h3>
        <div>
            <a href="./right.php"  target="mainFrame">Home</a>
        </div>
	<h3><a href="#">Account</a></h3>
	<div>
            <a href="account.php" target="mainFrame">Account</a><br>
            <a href="organization.php" target="mainFrame">Organization</a><br>
	</div>
        <h3><a href="#">Team</a></h3>
	<div>
            <a href="team.php" target="mainFrame">Team</a><br>
            <a href="about:blank" target="mainFrame">Team Member</a><br>
            <a href="about:blank" target="mainFrame">Organization</a><br>
            <a href="about:blank" target="mainFrame">Org Team</a><br>
	</div>
        <h3><a href="#">Friend</a></h3>
	<div>
            <a href="about:blank" target="mainFrame">Friend</a><br>
            <a href="about:blank" target="mainFrame">FriendList</a><br>
	</div>
        <h3><a href="#">Activity</a></h3>
	<div>
            <a href="activity.php" target="mainFrame">Activity</a><br>
            <a href="about:blank" target="mainFrame">Q &amp; A</a><br>
            <a href="venue.php" target="mainFrame">Venue</a><br>
            <a href="about:blank" target="mainFrame">Type</a><br>
            <a href="about:blank" target="mainFrame">Involve account</a><br>
	</div>
        <h3><a href="#">Gift</a></h3>
	<div>
            <a href="gift.php" target="mainFrame">Gift</a><br>
            <a href="about:blank" target="mainFrame">Gift redemption</a><br>
	</div>
        <h3><a href="#">Messaging</a></h3>
	<div>
            <a href="about:blank" target="mainFrame">Message</a><br>
            <a href="about:blank" target="mainFrame">Msg Folder</a><br>
            <a href="about:blank" target="mainFrame">Msg Map</a><br>
	</div>
        <h3><a href="#">Translate</a></h3>
	<div>
            <a href="translate.php?lang=zh" target="mainFrame">Chinese</a><br>
            <a href="translate.php?lang=en" target="mainFrame">English</a><br>
	</div>

        <h3><a href="#">Miscellaneous</a></h3>
	<div>
            <a href="about:blank" target="mainFrame">Email Activation</a><br>
            <a href="adv.php" target="mainFrame">Advertisement</a><br>
            <a href="news.php" target="mainFrame">News</a><br>
	</div>
        <h3><a href="#">Report</a></h3>
	<div>
            <a href="about:blank" target="mainFrame">Activities</a><br>
            <a href="about:blank" target="mainFrame">Teams/Orgs</a><br>
            <a href="about:blank" target="mainFrame">Venues</a><br>
	</div>
        <h3 onclick="if(confirm('logout?')){top.location='./login.php?q=logout'}"><a href="#" id="logout">Logout</a></h3>
        <div>
            <a href="javascript:if(confirm('logout?')){top.location='./login.php?q=logout'}">Logout</a>
        </div>

</div>

</html>
