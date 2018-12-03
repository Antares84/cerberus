<?php
	class ShaiyaCharItems{

		private $cid;
		private $sql;
		private $res;
		private $fet;
		private $itemArray;
		private $ItemCount;
		public $Lapis_Array;

		public function __construct($db,$cid){
			$this->db	=	$db;
			$this->cid	=	$cid;
		}
		public function getLapis($debug){
			$this->sql	=	("
								SELECT [ItemName],[TypeID]
								FROM ".$this->db->get_TABLE("SH_ITEMS")."
								WHERE [Type]=30
			");
			$this->res = odbc_exec($this->db->conn,$this->sql);

			$this->Lapis_Array		=	array();
			$this->Lapis_Array[0]	=	"-";
			$this->ItemCount=0;

			while($this->fet = odbc_fetch_array($this->res)){
				if($debug == 1){
					echo '<pre>';
						var_dump($this->fet);
					echo '</pre>';
					die();
				}

				$this->Lapis_Array[$this->fet["TypeID"]]			=	$this->fet["ItemName"];

				$this->ItemCount++;
			}

			if($debug == 2){
				echo '<pre>';
					var_dump($this->Lapis_Array);
				echo '</pre>';
				die();
			}

			return $this->Lapis_Array;
		}
		public function readItems($debug){
			$this->sql = ("
							SELECT [CI].[ItemID],[CI].[ItemUID],[CI].[Slot],[CI].[Quality],[CI].[Gem1],[CI].[Gem2],[CI].[Gem3],[CI].[Gem4],[CI].[Gem5],[CI].[Gem6],[CI].[Craftname],[CI].[Count],[CI].[MakeTime],[I].[ItemName],[I].[ReqLevel],[I].[Quality] AS [MaxQuality],[I].[Slot] AS [MaxSlot],[CI].[Bag]
							FROM [PS_WEB].[SDM_GameData].[dbo].[CharItems] AS [CI]
							INNER JOIN [PS_WEB].[SDM_GameDefs].[dbo].[Items] AS [I] ON [I].[ItemID] = [CI].[ItemID]
							WHERE [CI].[CharID] = ".$this->cid."
							ORDER BY [CI].[Bag] ASC, [CI].[Slot] ASC
			");
			$this->res = odbc_exec($this->db->conn,$this->sql);

			$this->itemArray = array();
			$this->ItemCount=0;

			if($this->res){
				while($this->fet = odbc_fetch_array($this->res)){
					if($debug == 1){
						echo '<pre>';
							var_dump($this->fet);
						echo '</pre>';
						die();
					}

					$this->itemArray[$this->ItemCount]['ItemID']		=	$this->fet['ItemID'];
					$this->itemArray[$this->ItemCount]['ItemName']		=	preg_replace('/??/', '?', $this->fet['ItemName']);
					$this->itemArray[$this->ItemCount]['Bag']			=	$this->fet['Bag'];
					$this->itemArray[$this->ItemCount]['ReqLevel']		=	$this->fet['ReqLevel'];
					$this->itemArray[$this->ItemCount]['Quality']		=	$this->fet['Quality'];
					$this->itemArray[$this->ItemCount]['MaxQuality']	=	$this->fet['MaxQuality'];
					$this->itemArray[$this->ItemCount]['MaxSlot']		=	$this->fet['MaxSlot'];
					$this->itemArray[$this->ItemCount]['ItemUID']		=	$this->fet['ItemUID'];
					$this->itemArray[$this->ItemCount]['Slot']			=	$this->fet['Slot'];
					$this->itemArray[$this->ItemCount]['Count']			=	$this->fet['Count'];
					$this->itemArray[$this->ItemCount]['Craftname']		=	$this->fet['Craftname'];
					$this->itemArray[$this->ItemCount]['MakeTime']		=	strtotime($this->fet['MakeTime']);
					$this->itemArray[$this->ItemCount]['Lapis1']		=	$this->fet['Gem1'];
					$this->itemArray[$this->ItemCount]['Lapis2']		=	$this->fet['Gem2'];
					$this->itemArray[$this->ItemCount]['Lapis3']		=	$this->fet['Gem3'];
					$this->itemArray[$this->ItemCount]['Lapis4']		=	$this->fet['Gem4'];
					$this->itemArray[$this->ItemCount]['Lapis5']		=	$this->fet['Gem5'];
					$this->itemArray[$this->ItemCount]['Lapis6']		=	$this->fet['Gem6'];
					$this->itemArray[$this->ItemCount]['Slot']			=	$this->fet['Slot'];

					$this->ItemCount++;
				}

				if($debug == 2){
					echo '<pre>';
						var_dump($this->itemArray);
					echo '</pre>';
					die();
				}

				return $this->itemArray;
			}
			else{
				return false;
			}
			
		}
		public function getItemOnSlot($slot){
			if(!preg_match('#^[0-9]*$#', $slot)){
				throw new SystemException('Slot must be an integer.', 0, 0, __FILE__, __LINE__);
			}
			$this->sql = ("
							SELECT [CI].[ItemID],[CI].[ItemUID],[CI].[Slot],[CI].[Quality],[CI].[Gem1],[CI].[Gem2],[CI].[Gem3],[CI].[Gem4],[CI].[Gem5],[CI].[Gem6],[CI].[Craftname],[CI].[ItemCount],[CI].[MakeTime],[I].[ItemName],[I].[ReqLevel],[I].[Quality] AS [MaxQuality],[I].[Slot] AS [MaxSlot],[CI].[Bag]
							FROM [PS_GameData].[dbo].[CharItems] AS [CI]
							INNER JOIN [PS_GameDefs].[dbo].[Items] AS [I] ON [I].[ItemID] = [CI].[ItemID]
							WHERE [CI].[CharID]=? AND [CI].[Slot]=?
			");
			$stmt		=	odbc_prepare($this->db->conn,$this->sql);
			$args		=	array($this->cid,$slot);
			$this->res	=	odbc_execute($stmt,$args);

			$this->itemArray = NULL;
			$this->itemArray = array();

			if(odbc_num_rows($stmt)!=1){
				return false;
			}

			$this->fet = mssql_fetch_array($this->res);

			$this->itemArray['ItemID']		= $this->fet[0];
			$this->itemArray['ItemName']	= preg_replace('/??/', '?', $this->fet[13]);
			$this->itemArray['Bag']			= $this->fet[17];
			$this->itemArray['ReqLevel']	= $this->fet[14];
			$this->itemArray['Quality']		= $this->fet[3];
			$this->itemArray['MaxQuality']	= $this->fet[15];
			$this->itemArray['MaxSlot']		= $this->fet[16];
			$this->itemArray['ItemUID']		= $this->fet[1];
			$this->itemArray['Slot']		= $this->fet[2];
			$this->itemArray['ItemCount']		= $this->fet[11];
			$this->itemArray['CraftName']	= $this->fet[10];
			$this->itemArray['MakeTime']	= strtotime($this->fet[12]);
			$this->itemArray['Lapis1']		= $this->fet[4];
			$this->itemArray['Lapis2']		= $this->fet[5];
			$this->itemArray['Lapis3']		= $this->fet[6];
			$this->itemArray['Lapis4']		= $this->fet[7];
			$this->itemArray['Lapis5']		= $this->fet[8];
			$this->itemArray['Lapis6']		= $this->fet[9];

			return $this->itemArray;
		}
		public function deleteItemOnSlot($slot){
			if(!preg_match('#^[0-9]*$#',$slot)){
				throw new SystemException('Slot must be an integer.',0,0,__FILE__,__LINE__);
			}
			$this->sql = "SELECT [ItemUID] FROM [PS_GameData].[dbo].[CharItems] WHERE [CharID] = '".$this->cid."' AND [Slot] = '$slot'";
			$this->res = mssql_query($this->sql);

			if(mssql_num_rows($this->res)!=1){
				return false;
			}
			$this->sql = "DELETE FROM [PS_GameData].[dbo].[CharItems] WHERE [CharID] = '".$this->cid."' AND [Slot] = '$slot'";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return true;
			}
			else{
				return false;
			}
		}
		public function deleteAll(){
			$this->sql = "DELETE FROM [PS_GameData].[dbo].[CharItems] WHERE [CharID] = '".$this->cid."'";
			$this->res = mssql_query($this->sql);

			if($this->res){
				return true;
			}
			else{
				return false;
			}
		}
	}
?>