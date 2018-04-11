<?php /* Smarty version 2.6.26, created on 2011-05-10 18:26:43
         compiled from common_js.js */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'common_js.js', 10, false),)), $this); ?>
/*
 *  Function List:
 * showActivity(activityId)
 * showSendMsgDialog(target,title)
 * showDialog(url,width,height)
 *
 * 
 */
function showActivity(activityId){
  new showDialog("http://"+location.host+"/activity.php?action=viewDetail&type=iframe&activityid="+activityId,undefined,undefined,"<?php echo ((is_array($_tmp='Activity')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #"+activityId);
}
function showTeam(teamId){
  new showDialog("http://"+location.host+"/team.php?action=viewDetail&type=iframe&teamId="+teamId,undefined,undefined,"<?php echo ((is_array($_tmp='Team')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #"+teamId);
}
function showOrg(OrgId){
  new showDialog("http://"+location.host+"/organization.php?action=viewDetail&type=iframe&orgId="+OrgId,undefined,undefined,"<?php echo ((is_array($_tmp='Organization')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 #"+OrgId);
}
function showAccount(loginname){
  new showDialog("http://"+location.host+"/account.php?action=viewDetail&type=iframe&loginName="+loginname,undefined,undefined,"<?php echo ((is_array($_tmp='User Info of')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
 "+loginname);
}
function showAttendeeList(itId){
  new showDialog("http://"+location.host+"/activity.php?action=ITdetail&type=iframe&itId="+itId,undefined,undefined,"<?php echo ((is_array($_tmp='Attendee List')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
");
}
function showDialog(url,width,height,title)
{
  if(self!=top){
    new parent.showDialog(url,width,height,title);
    return;
  }
  width=width==undefined?800:width;
  height=height==undefined?600:height;

  this.div=document.createElement("div");
  this.div.className="dialog-form";
  this.div.title=title==undefined?"Info":title;
  this.div.style.textAlign="center"
  var table=document.createElement("table");
  table.setAttribute("width", "100%");
  table.setAttribute("height", "100%");
  if(document.all){
      table.setAttribute("width", "99%");
      table.setAttribute("height", "90%");
  }
  table.setAttribute("cellspacing", 0);
  table.setAttribute("cellpadding", 0);
  table.setAttribute("border", 0);

  this.div.appendChild(table);
  var r1=table.insertRow(0)
  var c1=r1.insertCell(0)
  var r2=table.insertRow(1)
  var c2=r2.insertCell(0)
  c2.style.height="100%"
  //table.style.height="100%"

  var urlbar=document.createElement("input");
  urlbar.className="text ui-widget-content ui-corner-all";
  urlbar.style.width="100%"
  if(document.all){
      urlbar.style.width="99%"
  }
  $(urlbar).attr("readonly","readonly");
  $(urlbar).click(function(){$(this).select()});
  //$(urlbar).blur(function(){}})
  c1.appendChild(urlbar);
  this.iframe=document.createElement("iframe");
  this.iframe.style.width="100%";
  this.iframe.style.height="100%";
  this.iframe.style.border="solid 1px #aaa"
  this.iframe.allowtransparency=true;
  c2.appendChild(this.iframe);
  this.iframe.src=url;
  urlbar.value=url;

  var _this=this;
  this.dialog=$(this.div).dialog({
      autoOpen: true,
      height: height,
      width: width,
      modal: false,
      //show:'Drop',
      hide:"Blind",
      position:[$("body").width()/2-width/2+Math.random()*200-100,$("body").height()/2-height/2+Math.random()*200-100],

      close: function(){
          $(this).dialog( "destroy");
      },
      buttons:{
          "<?php echo ((is_array($_tmp='Close')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){$(this).dialog("close")},
          "<?php echo ((is_array($_tmp='Open in new window')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
":function(){window.open(url);}
      }
  });
}
function showSendMsgDialog(target,title)
{
  if(self!=top){
    //new parent.showSendMsgDialog(target,title);
    return parent.showSendMsgDialog(target,title);
    //return;
  }
  target=target==undefined?"":target;
  title=title==undefined?"":title;
  this.div=$('<div></div>').attr({title:"<?php echo ((is_array($_tmp='New Message')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
"});
  var form=$('<form></form>').attr({name:"test"});
  form.html('<table width="100%"><tr><td width="60" valign="middle"><label for="receiver"><b><?php echo ((is_array($_tmp='Receiver')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></label></td><td valign="middle"><input type="text" name="receiver" class="text ui-widget-content ui-corner-all" style="width:\'100%\'"/></td></tr><tr><td valign="middle" ><label for="title"><b><?php echo ((is_array($_tmp='Subject')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</b></label></td><td valign="middle" ><input type="text" name="title" value="" class="text ui-widget-content ui-corner-all" style="width:\'100%\'"/></td></tr></table>');
  var textarea=$('<textarea></textarea>').attr({cols:"120",rows:"50",name:"bodyeditor"});
  form.append(textarea);
  this.div.append(form);

  this.div.dialog({
    autoOpen: true,
    position: 'center',
    width:950,
    height:550,
    buttons: {
      "<?php echo ((is_array($_tmp='Send')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
        if(form.find('input[name="receiver"]').val()==""||form.find('input[name="title"]').val()=="")
        {
          jqAlert("Please fill in title and receiver.");
        }else{
          $.post("message.php?q=addMessage",$(form).serialize(),function(){jQuery("#folderView").jqGrid().trigger("reloadGrid");jqAlert("Mail Sent");},'html');
          $(this).dialog("close");
        }
      },
      "<?php echo ((is_array($_tmp='Cancel')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
": function() {
        $(this).dialog("close");
      }
    },
    open:function(){
      var config={toolbar:[
          ['Cut','Copy','Paste','PasteText','-'],
          ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
          //'/',
          ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
          ['NumberedList','BulletedList'],
          ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
          ['Link','Unlink'],
          ['Image','Table','Smiley','SpecialChar'],
          '/',
          ['Styles','Format','Font','FontSize'],
          ['TextColor','BGColor'],
          ['-','About']],
        language: '<?php echo $_SESSION['lang']; ?>
'};
      textarea.ckeditor(function(){},config);
    },
    close:function(){
      textarea.ckeditorGet().destroy();
      $(this).dialog('destroy');
    }
  });
  form.find('input[name="receiver"]').val(target);
  form.find('input[name="title"]').val(title);
  return this.div;
}
function jqAlert(msg,title,modal){
  return $("<div></div>").html(msg).dialog({title:(title?title:'Alert'),modal:!!modal,dialogClass:'alert',minHeight:100,minWidth:0});
}