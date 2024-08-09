<?php

class paginate
{
	private $db;
	
	public function __construct()
	{
		global $host, $user, $password;
		$database = new Database();
		$db = $database->dbConnection($host, "player", $user, $password);
		$this->db = $db;
    }
	
	public function dataview($query, $search=NULL)
	{
		global $site_url;
		
		$stmt = $this->db->prepare($query);
		if($search)
			$stmt->bindValue(':search', $search.'%');
		$stmt->execute();

		$rowCount = count($stmt->fetchAll());
		
		$stmt = $this->db->prepare($query);
		if($search)
			$stmt->bindValue(':search', $search.'%');
		$stmt->execute();
		
		$number=0;
		if(isset($_GET["page_no"]))
		{
			if(is_numeric($_GET["page_no"]))
			{
				if($_GET["page_no"]>1)
					$number = ($_GET["page_no"]-1)*20;
			}
		}
		
		$b = array(0, 2, 5, 7, 8);
		
		if($rowCount>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{	$number++;
				
				?>
			<tr>
				<th scope="row"><?php print ($number<=5) ? '<img src="https://rodnia.net/images/pos'.$number.'.png">' : $number; ?></th>
				<td><div class="clasament-ava"><img src="<?php print $site_url.'images/chrs/'.$row['job']; ?>.jpg" alt=""></div></td>
				<td><b><?php print $row['name']; ?></b><?php if(in_array($row['job'], $b)) print ' ♂'; else print ' ♀'; ?><br><small>(HP: <b><?php print $row['hp']; ?></b>, MP: <b><?php print $row['mp']; ?></b>)</small></td>
				<td class="level-table"><center><?php print $row['level']; ?></center></td>
				<td class="exp-table"><?php print get_player_guild($row['id']); ?></td>
				<td><center><img src="<?php print $site_url; ?>images/empire/<?php print $empire=get_player_empire($row['account_id']); ?>.jpg" alt="<?php print emire_name($empire); ?>" title="<?php print emire_name($empire); ?>"></center></td>
			</tr>
                <?php
			}
		}
		else
		{
			?>
            <tr>
            <td>Nothing here...</td>
            </tr>
            <?php
		}
		
	}
	
	public function paging($query,$records_per_page)
	{
		$starting_position=0;
		if(isset($_GET["page_no"]))
		{
			if(is_numeric($_GET["page_no"]))
				if($_GET["page_no"]>1)
					$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page,$first,$last,$self,$search=NULL)
	{		
		$self = $self.'ranking/vip/';
		
		$sql = "SELECT count(*) ".strstr($query, 'FROM');
		
		$stmt = $this->db->prepare($sql);
		if($search)
			$stmt->bindValue(':search', $search.'%');
		$stmt->execute(); 
		
		$total_no_of_records = $stmt->fetchColumn();
		
		if($total_no_of_records > 0)
		{
			?><center><ul class="pagination pagination-sm"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				if(is_numeric($_GET["page_no"]))
				{
					$current_page=$_GET["page_no"];
					
					if($_GET["page_no"]<1)
						print "<script>top.location='".$self."'</script>";
					else if($_GET["page_no"]>$total_no_of_pages)
						print "<script>top.location='".$self."'</script>";
				}
			}
			
			if($current_page!=1)
			{
				$previous = $current_page-1;
				if($search)
				{
					print "<li><a href='".$self."1/".$search."'>".$first."</a></li>";
					print "<li><a href='".$self.$previous."/".$search."'>&laquo;</a></li>";
				}
				else
				{
					print "<li><a href='".$self."1'>".$first."</a></li>";
					print "<li><a href='".$self.$previous."'>&laquo;</a></li>";
				}
			}
			
			$x=$current_page;

			if($current_page+3>$total_no_of_pages)
				if($total_no_of_pages-3>0)
					$x=$total_no_of_pages-3;
				else if($total_no_of_pages-2>0)
					$x=$total_no_of_pages-2;
				else if($total_no_of_pages-1>0)
					$x=$total_no_of_pages-1;
			
			for($i=$x;$i<=$x+3;$i++)
				if($i==$current_page)
				{
					if($search)
						print "<li class='active'><a href='".$self.$i."/".$search."'>".$i."</a></li>";
					else
						print "<li class='active'><a href='".$self.$i."'>".$i."</a></li>";
				}
				else if($i>$total_no_of_pages)
					break;
				else
				{
					if($search)
						print "<li><a href='".$self.$i."/".$search."'>".$i."</a></li>";
					else
						print "<li><a href='".$self.$i."'>".$i."</a></li>";
				}
			
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				if($search)
					print "<li><a href='".$self.$next."/".$search."'>&raquo;</a></li>";
				else
					print "<li><a href='".$self.$next."'>&raquo;</a></li>";
			}
			?></ul></center><?php
		}
	}
}