<?php
	require_once('./admin_header.php');
	if(!isset($_GET['donorid']))
	{
		$typeid=1;
		$newsid=1;
		if(isset($_GET['typeid'])&&isset($_GET['newsid']))
		{
			$typeid=intval($_GET['typeid']);
			$newsid=intval($_GET['newsid']);
			if($typeid<1||$typeid>$NEWS_TYPE_NUM)
				$typeid=1;
		}
		$sql = "SELECT `title` FROM `News_type` WHERE `type_id`='$typeid'";
		$result = mysql_query($sql) or die(mysql_error());
		$row = mysql_fetch_object($result);
		$title = $row->title;
		$title = $title."条目详细信息";
		mysql_free_result($result);
	}
	else
	{
		$donorid=intval($_GET['donorid']);
		if($donorid<1)
			$donorid=1;
		$title="捐赠详细信息";
	}
?>
<div class="content">
		<hr>
			<div class="newsbar">
				<div class="pull-left title"><?php echo $title?></div>
			</div>
			<div style="clear:both"></div>
		<hr>
		<?php
			if(!isset($_GET['donorid']))
			{
				$query = "SELECT `title`,`content`,`addtime`,`seecount` FROM `News_main` WHERE `type_id`='$typeid' AND `news_id`='$newsid'";
				$result = mysql_query($query) or die(mysql_error());
				$row_cnt = mysql_num_rows($result);
				if($row_cnt==0)
					echo "No Such Information";
				else{
					$row = mysql_fetch_object($result);
					$newstitle = $row->title;
					$content = $row->content;
					$addtime = $row->addtime;
					$seecount = $row->seecount;
					echo "<h2>$newstitle</h2>";
					echo "发布时间:$addtime 浏览次数:$seecount";
					echo "<table class='table infocontent'>";
					echo "<tr><td>$content</td></tr>";
					echo "</table>";
				}
				mysql_free_result($result);
			}
			else
			{
				$query="SELECT * FROM `donor` WHERE `donor_id`='$donorid'";
				$result = mysql_query($query) or die(mysql_error());
				$row_cnt=mysql_num_rows($result);
				if($row_cnt==0)
				{
					echo "No Such Information";
				}
				else
				{
					$row = mysql_fetch_object($result);
					echo "<table class='infocontent table'>";
					echo "<tr><td>捐款单位或个人:$row->name</td></tr>";
					echo "<tr><td>捐赠金额:$row->money 元</td></tr>";
					if($row->project_id==0)
						echo "<tr><td>捐赠项目名称:无指定项目</td></tr>";
					else
					{
						$sql = "SELECT `title` FROM `News_main` WHERE `type_id`='3' AND `news_id`='$row->project_id'";
						$tmpresult = mysql_query($sql) or die(mysql_error());
						$tmprow = mysql_fetch_object($tmpresult);
						echo "<tr><td>捐赠项目名称:$tmprow->title</td></tr>";
						mysql_free_result($tmpresult);
					}
					echo "<tr><td>E-mail:$row->email</td></tr>";
					echo "<tr><td>联系电话:$row->phone</td></tr>";
					echo "<tr><td>地址:$row->address</td></tr>";
					echo "<tr><td>邮编:$row->postcode</td></tr>";
					if($row->ourschool==1)
						echo "<tr><td>是否校友:校友</td></tr>";
					else
						echo "<tr><td>是否校友:非校友</td></tr>";
					echo "<tr><td>入学时间及院部:$row->schoolname</td></tr>";
					echo "<tr><td>留言:$row->message</td></tr>";
					echo "</table>";
				}
				mysql_free_result($result);
			}
		?>
		<input type="button" value="返回" onclick="javascript:history.go(-1);" class="mybutton">
</div>
<?php
	require_once('./admin_footer.php');
?>