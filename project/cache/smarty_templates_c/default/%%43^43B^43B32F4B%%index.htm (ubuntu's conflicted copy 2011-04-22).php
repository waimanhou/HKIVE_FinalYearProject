<?php /* Smarty version 2.6.26, created on 2011-04-13 02:54:40
         compiled from index.htm */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'lang', 'index.htm', 118, false),)), $this); ?>
<?php ob_start(); ?>
<style type="text/css">
.table1 {
  border-collapse: collapse;
  border: 1px solid #666666;
  font: normal verdana, arial, helvetica, sans-serif;
  color: #363636;
  background: #f6f6f6;
  text-align:left;
  width:90%;
  margin-top:4px;
  margin-left:auto;
  margin-right:auto;
  }
.table1 caption {
  text-align: center;
  font: bold 16px arial, helvetica, sans-serif;
  background: transparent;
  padding:6px 4px 8px 0px;
  color: #CC00FF;
  text-transform: uppercase;
}
.table1 thead, .table1 tfoot {
background:url(bg1.png) repeat-x;
text-align:left;
height:30px;
}
.table1 thead th, .table1 tfoot th {
padding:5px;
}
.table1 a {
color: #333333;
text-decoration:none;
}
.table1 a:hover {
text-decoration:underline;
}
.table1 tr.odd {
background: url(./images/bg1.png);
}
.table1 tbody th, .table1 tbody td {
padding:5px;
}
.table1 .time{
width:200px;
}
#ticker { width:100%; height:500px; overflow:auto; text-align: left; }
#ticker dt {  padding:0 10px 5px 10px; padding-top:1px; border-bottom:none; border-right:none; position:relative; }
#ticker dd { margin-left:0;  padding:0 1px 1px 1px; position:relative; }
#ticker dd.last {}
#ticker div { margin-top:0; }
#tickerContainer{
margin: 0 auto;        /*—這樣firefox區塊就可以置中了，因為上下方高度0，左右方長度他會”auto”自動調整— */
text-align:left;          /*—這邊就可以讓c1區域內的文字靠左對齊— */
}
</style>
<script type="text/javascript">
	  $(function() {
	  
		//cache the ticker
		var ticker = $("#ticker");
		  
		//wrap dt:dd pairs in divs
		ticker.children().filter("dt").each(function() {
		  
		  var dt = $(this),
		    container = $("<div>");
		  
		  dt.next().appendTo(container);
		  dt.prependTo(container);
		  
		  container.appendTo(ticker);
		});
				
		//hide the scrollbar
		ticker.css("overflow", "hidden");
		
		//animator function
		function animator(currentItem) {
		    
		  //work out new anim duration
		  var distance = currentItem.height();
			duration = (distance + parseInt(currentItem.css("marginTop"))) / 0.025;

		  //animate the first child of the ticker
		  currentItem.animate({ marginTop: -distance }, duration, "linear", function() {
		    
			//move current item to the bottom
			currentItem.appendTo(currentItem.parent()).css("marginTop", 0);

			//recurse
			animator(currentItem.parent().children(":first"));
		  }); 
		};
		
		//start the ticker
		animator(ticker.children(":first"));
				
		//set mouseenter
		ticker.mouseenter(function() {
		  
		  //stop current animation
		  ticker.children().stop();
		  
		});
		
		//set mouseleave
		ticker.mouseleave(function() {
		          
          //resume animation
		  animator(ticker.children(":first"));
		  
		});
	  });
    </script>
<?php $this->_smarty_vars['capture']['default'] = ob_get_contents();  $this->assign('otherCode', ob_get_contents());ob_end_clean(); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "header.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<h1><?php echo ((is_array($_tmp='NEWS')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</h1>  <span style="float:right">[<a href="news.php"><?php echo ((is_array($_tmp='All News')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
</a>]</span>
<br>
<div id="tickerContainer">
      <dl id="ticker">
	  <?php unset($this->_sections['i']);
$this->_sections['i']['name'] = 'i';
$this->_sections['i']['loop'] = is_array($_loop=$this->_tpl_vars['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['i']['show'] = true;
$this->_sections['i']['max'] = $this->_sections['i']['loop'];
$this->_sections['i']['step'] = 1;
$this->_sections['i']['start'] = $this->_sections['i']['step'] > 0 ? 0 : $this->_sections['i']['loop']-1;
if ($this->_sections['i']['show']) {
    $this->_sections['i']['total'] = $this->_sections['i']['loop'];
    if ($this->_sections['i']['total'] == 0)
        $this->_sections['i']['show'] = false;
} else
    $this->_sections['i']['total'] = 0;
if ($this->_sections['i']['show']):

            for ($this->_sections['i']['index'] = $this->_sections['i']['start'], $this->_sections['i']['iteration'] = 1;
                 $this->_sections['i']['iteration'] <= $this->_sections['i']['total'];
                 $this->_sections['i']['index'] += $this->_sections['i']['step'], $this->_sections['i']['iteration']++):
$this->_sections['i']['rownum'] = $this->_sections['i']['iteration'];
$this->_sections['i']['index_prev'] = $this->_sections['i']['index'] - $this->_sections['i']['step'];
$this->_sections['i']['index_next'] = $this->_sections['i']['index'] + $this->_sections['i']['step'];
$this->_sections['i']['first']      = ($this->_sections['i']['iteration'] == 1);
$this->_sections['i']['last']       = ($this->_sections['i']['iteration'] == $this->_sections['i']['total']);
?>
        <dt class="heading"></dt>
		<dd class="text">        
			<table border="1" class="table1">
				<tr class='odd'>
					<td>
						<b><?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTitle(); ?>
</b>
					</td>
					<td class="time" align="right">    <?php echo ((is_array($_tmp='Time')) ? $this->_run_mod_handler('lang', true, $_tmp) : smarty_modifier_lang($_tmp)); ?>
: <?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getTime(); ?>
</td>
				</tr>
				<tr>
					<td colspan="2">
						<?php echo $this->_tpl_vars['list'][$this->_sections['i']['index']]->getBody(); ?>

					</td>
				</tr>
			</table>
		</dd>
      <?php endfor; endif; ?>
	  </dl>
</div>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "footer.htm", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>