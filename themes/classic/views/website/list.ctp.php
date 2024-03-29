<form name="listform" id="listform">
	<!-- Website Manager -->
<?php echo showSectionHead($spTextPanel['Website Manager']); ?>
<?php $submitLink = "scriptDoLoadPost('websites.php', 'listform', 'content')";?>
<table border="0" cellspacing="0" cellpadding="0" id="custom-dashboard-heading-rr" class="search" style="margin-bottom:50px;">
	<tr>
		<td style="flex:1;">
			<input type="text" name="search_name" placeholder="Name" value="<?php echo htmlentities($info['search_name'], ENT_QUOTES)?>" onblur="<?php echo $submitLink?>">
		</td>
		<?php if(!empty($isAdmin)){ ?>
			<td style="flex:1;">
				<select name="userid" id="userid" onchange="<?php echo $submitLink?>">
					<option value="">-- <?php echo $spText['common']['Select']?> --</option>
					<?php foreach($userList as $userInfo){?>
						<?php if($userInfo['id'] === $userId){?>
							<option value="<?php echo $userInfo['id']?>" selected><?php echo $userInfo['username']?></option>
						<?php }else{?>
							<option value="<?php echo $userInfo['id']?>"><?php echo $userInfo['username']?></option>
						<?php }?>
					<?php }?>
				</select>
			</td>
		<?php }?>
		<td style="flex:1;">
			<select name="stscheck" onchange="<?php echo $submitLink?>">
				<option value="select">-- <?php echo $spText['common']['Select']?> --</option>
				<?php foreach($statusList as $key => $val){?>
					<?php if(isset($info['stscheck']) && $info['stscheck'] === $val){?>
						<option value="<?php echo $val?>" selected><?php echo $key?></option>
					<?php }else{?>
						<option value="<?php echo $val?>"><?php echo $key?></option>
					<?php }?>
				<?php }?>
			</select>
		</td>
		<td style="text-align: center;">
			<a href="javascript:void(0);" onclick="<?php echo $submitLink; ?>" class="actionbut">
				<?php echo $spText['button']['Search']?>
			</a>
		</td>
	</tr>
</table>
<?php echo $pagingDiv?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="list auditor-Page-RR" style="margin-bottom:50px;">
	<tr class="listHead">
		<td class="leftid"><input type="checkbox" id="checkall" onclick="checkList('checkall')"></td>
		<td><?php echo $spText['common']['Id']?></td>		
		<td><?php echo $spText['common']['Website']?></td>
		<?php if(!empty($isAdmin)){ ?>		
			<td><?php echo $spText['common']['User']?></td>
		<?php } ?>
		<td><?php echo $spText['common']['Url']?></td>
		<td><?php echo $spText['common']['Status']?></td>
		<td class="right"><?php echo $spText['common']['Action']?></td>
	</tr>
	<?php
	$colCount = empty($isAdmin) ? 6 : 7; 
	if(count($list) > 0){
		$catCount = count($list);
		foreach($list as $i => $listInfo){
			$class = ($i % 2) ? "blue_row" : "white_row";
            if($catCount == ($i + 1)){
                $leftBotClass = "tab_left_bot";
                $rightBotClass = "tab_right_bot";
            }else{
                $leftBotClass = "td_left_border td_br_right";
                $rightBotClass = "td_br_right";
            }
            $websiteLink = scriptAJAXLinkHref('websites.php', 'content', "sec=edit&websiteId={$listInfo['id']}", "{$listInfo['name']}")
			?>
			<tr class="<?php echo $class?>">
				<td class="<?php echo $leftBotClass?>"><input type="checkbox" name="ids[]" value="<?php echo $listInfo['id']?>"></td>
				<td class="td_br_right"><?php echo $listInfo['id']?></td>				
				<td class="td_br_right left" style="color:#0033A0; font-weight:bold;fontsize:14px;padding-left:20px;text-align:left;"><?php echo $websiteLink?></td>
				<?php if(!empty($isAdmin)){ ?>
					<td class="td_br_right left"><?php echo $listInfo['username']?></td>
				<?php } ?>
				<td class="td_br_right left" style="text-align : left;padding-left:20px;"><?php echo wordwrap($listInfo['url'], 70, "<br>", true); ?></td>
				<td class="td_br_right"><?php echo $listInfo['status'] ? $spText['common']["Active"] : $spText['common']["Inactive"];	?></td>
				<td class="<?php echo $rightBotClass?>">
					<?php
						if($listInfo['status']){
							$statVal = "Inactivate";
							$statLabel = $spText['common']["Inactivate"];
						}else{
							$statVal = "Activate";
							$statLabel = $spText['common']["Activate"];
						} 
					?>
					<select name="action" id="action<?php echo $listInfo['id']?>" onchange="doAction('websites.php', 'content', 'websiteId=<?php echo $listInfo['id']?>&pageno=<?php echo $pageNo?>&userid=<?php echo $userId?>', 'action<?php echo $listInfo['id']?>')">
						<option value="select">-- <?php echo $spText['common']['Select']?> --</option>
						<option value="addToWebmasterTools"><?php echo $spTextWeb['Add to Webmaster Tools']?></option>
						<option value="<?php echo $statVal?>"><?php echo $statLabel?></option>
						<option value="edit"><?php echo $spText['common']['Edit']?></option>
						<option value="delete"><?php echo $spText['common']['Delete']?></option>
					</select>
				</td>
			</tr>
			<?php
		}
	}else{	 
		echo showNoRecordsList($colCount-2);		
	} 
	?>
	<tr class="listBot">
		<td class="left" colspan="<?php echo ($colCount-1)?>"></td>
		<td class="right"></td>
	</tr>
</table>
<?php
if (SP_DEMO) {
    $actFun = $inactFun = $delFun = "alertDemoMsg()";
} else {
    $actFun = "confirmSubmit('websites.php', 'listform', 'content', '&sec=activateall&pageno=$pageNo')";
    $inactFun = "confirmSubmit('websites.php', 'listform', 'content', '&sec=inactivateall&pageno=$pageNo')";
    $delFun = "confirmSubmit('websites.php', 'listform', 'content', '&sec=deleteall&pageno=$pageNo')";
}   
?>
<table width="100%" cellspacing="0" cellpadding="0" border="0" class="actionSec">
	<tr>
    	<td style="padding-top: 6px;">
         	<a onclick="scriptDoLoad('websites.php', 'content', 'sec=new')" href="javascript:void(0);" class="actionbut">
         		<?php echo $spTextPanel['New Website']?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?php echo $actFun?>" href="javascript:void(0);" class="actionbut">
         		<?php echo $spText['common']["Activate"]?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?php echo $inactFun?>" href="javascript:void(0);" class="actionbut">
         		<?php echo $spText['common']["Inactivate"]?>
         	</a>&nbsp;&nbsp;
         	<a onclick="<?php echo $delFun?>" href="javascript:void(0);" class="actionbut">
         		<?php echo $spText['common']['Delete']?>
         	</a>
    	</td>
	</tr>
</table>
</form>