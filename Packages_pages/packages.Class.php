<?php

class package
{
	private $db;
	
	function __construct($DB_con)
	{
		$this->db = $DB_con;
	}
	
	public function create($Package_Name,$Billing_Code,$SC,$SOB,$Package_Or_Service_Lookup,$Eligible_Packages_Lookup,$Market_Lookup)
	{
		try
		{
			$stmt = $this->db->prepare("INSERT INTO packages(Package_Name,Billing_Code,SC,SOB,Package_Or_Service_Lookup,Eligible_Packages_Lookup,Market_Lookup) VALUES(:Package_Name,:Billing_Code,:SC,:SOB,:Package_Or_Service_Lookup,:Eligible_Packages_Lookup,:Market_Lookup)");
                        $stmt->bindparam(":Package_Name",$Package_Name);
                        $stmt->bindparam(":Billing_Code",$Billing_Code);
                        $stmt->bindparam(":SC",$SC);
                        $stmt->bindparam(":SOB",$SOB);
                        $stmt->bindparam(":Package_Or_Service_Lookup",$Package_Or_Service_Lookup);
                        $stmt->bindparam(":Eligible_Packages_Lookup",$Eligible_Packages_Lookup);
                        $stmt->bindparam(":Market_Lookup",$Market_Lookup);
			$stmt->execute();
			return true;
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
		
	}
	
	public function getID($id)
	{
		$stmt = $this->db->prepare("SELECT * FROM packages WHERE Package_ID=:id");
		$stmt->execute(array(":id"=>$id));
		$editRow=$stmt->fetch(PDO::FETCH_ASSOC);
		return $editRow;
	}
	
	public function update($Package_ID,$Package_Name,$Billing_Code,$SC,$SOB,$Package_Or_Service_Lookup,$Eligible_Packages_Lookup,$Market_Lookup)
	{
		try
		{
			$stmt=$this->db->prepare("UPDATE `packages` SET "
                                . "`Package_Name`=:Package_Name,"
                                . "`Billing_Code`=:Billing_Code,"
                                . "`SC`=:SC,"
                                . "`SOB`=:SOB,"
                                . "`Package_or_service_Lookup`=:Package_or_service_Lookup,"
                                . "`Eligible_Packages_Lookup`=:Eligible_Packages_Lookup,"
                                . "`Market_Lookup`=:Market_Lookup "
                                . "WHERE Package_ID=:Package_ID");
                        $stmt->bindparam(":Package_Name",$Package_Name);
                        $stmt->bindparam(":Billing_Code",$Billing_Code);
                        $stmt->bindparam(":SC",$SC);
                        $stmt->bindparam(":SOB",$SOB);
                        $stmt->bindparam(":Package_or_service_Lookup",$Package_Or_Service_Lookup);
                        $stmt->bindparam(":Eligible_Packages_Lookup",$Eligible_Packages_Lookup);
                        $stmt->bindparam(":Market_Lookup",$Market_Lookup);
                        $stmt->bindparam(":Package_ID",$Package_ID);
			$stmt->execute();
			
			return true;	
		}
		catch(PDOException $e)
		{
			echo $e->getMessage();	
			return false;
		}
	}
	
	public function delete($id)
	{
		$stmt = $this->db->prepare("DELETE FROM packages WHERE Package_ID=:id");
		$stmt->bindparam(":id",$id);
		$stmt->execute();
		return true;
	}
	
	/* paging */
	
	public function dataview($query)
	{
		$stmt = $this->db->prepare($query);
		$stmt->execute();
	
		if($stmt->rowCount()>0)
		{
			while($row=$stmt->fetch(PDO::FETCH_ASSOC))
			{
				?>
                <tr>
                <td class = "modal-name-label"><?php print($row['Package_Name']); ?></td>
                <td><?php print($row['Billing_Code']); ?></td>
                <td><?php print($row['SC']); ?></td>
                <td><?php print($row['SOB']); ?></td>
                <td>
                    <?php 
                        $lookup=$this->db->prepare('select * from Package_or_Service where id=:id');
                        $lookup->bindparam(":id",$row['Package_or_service_Lookup']);
                        $lookup->execute();
                        $value = $lookup->fetch(PDO::FETCH_ASSOC);
                        print($value['service_or_offer']); ?>
                          
                </td>
                <td>
                    <?php 
                        $lookup=$this->db->prepare('select * from Eligible_Packages_Lookup where Eligible_Packages_id=:id');
                        $lookup->bindparam(":id",$row['Eligible_Packages_Lookup']);
                        $lookup->execute();
                        $value = $lookup->fetch(PDO::FETCH_ASSOC);
                        print($value['Eligible_Packages_Name']); ?>
                          
                </td>
                <td>
                    <?php 
                        $lookup=$this->db->prepare('select * from market_type where Market_id=:id');
                        $lookup->bindparam(":id",$row['Market_Lookup']);
                        $lookup->execute();
                        $value = $lookup->fetch(PDO::FETCH_ASSOC);
                        print($value['Market_Name']); ?>
                </td>
            
                <td><a class="modalAlert" data-toggle="modal" data-target="#exampleModal" value="<?php print($row['Package_ID']); ?>"><i class="glyphicon glyphicon-edit"></i></a>            
                
                <td align="center">
                <a href="edit-packages-data.php?edit_id=<?php print($row['Package_ID']); ?>"><i class="glyphicon glyphicon-edit"></i></a>   </td>
                
                </td>
             
                <td align="center">
                    <a href="delete-packages.php?delete_id=<?php print($row['Package_ID']); ?>"><i class="glyphicon glyphicon-remove-circle"></i></a>
                </td>
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
			$starting_position=($_GET["page_no"]-1)*$records_per_page;
		}
		$query2=$query." limit $starting_position,$records_per_page";
		return $query2;
	}
	
	public function paginglink($query,$records_per_page)
	{
		
		$self = $_SERVER['PHP_SELF'];
		
		$stmt = $this->db->prepare($query);
		$stmt->execute();
		
		$total_no_of_records = $stmt->rowCount();
		
		if($total_no_of_records > 0)
		{
			?><ul class="pagination"><?php
			$total_no_of_pages=ceil($total_no_of_records/$records_per_page);
			$current_page=1;
			if(isset($_GET["page_no"]))
			{
				$current_page=$_GET["page_no"];
			}
			if($current_page!=1)
			{
				$previous =$current_page-1;
				echo "<li><a href='".$self."?page_no=1'>First</a></li>";
				echo "<li><a href='".$self."?page_no=".$previous."'>Previous</a></li>";
			}
			for($i=1;$i<=$total_no_of_pages;$i++)
			{
				if($i==$current_page)
				{
					echo "<li><a href='".$self."?page_no=".$i."' style='color:red;'>".$i."</a></li>";
				}
				else
				{
					echo "<li><a href='".$self."?page_no=".$i."'>".$i."</a></li>";
				}
			}
			if($current_page!=$total_no_of_pages)
			{
				$next=$current_page+1;
				echo "<li><a href='".$self."?page_no=".$next."'>Next</a></li>";
				echo "<li><a href='".$self."?page_no=".$total_no_of_pages."'>Last</a></li>";
			}
			?></ul><?php
		}
	}
	
	/* paging */
	
        public function unites_modal_dataview($Package_ID)
	{
            	$query = "SELECT * FROM total_units where Package_ID = :Package_ID";         
		$stmt = $this->db->prepare($query);
                $stmt->bindparam(":Package_ID",$Package_ID);
		$stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
	}
        
        
}

