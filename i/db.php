<?php
	class dbsql extends SQLite3 {
		function __construct(){
			$this->open("./love.db");
		}

		function sql_replace($str){  //防止注入
            $str = str_replace("\\","",$str);
            $str = str_replace("%20","",$str);
            $str = str_replace("'","",$str);
            $str = str_replace("\"","",$str);
            $str = str_replace("=","",$str);
            $str = str_replace(" ","",$str);
            $str = str_replace("/","",$str);
            $str = preg_replace("/!\d+(\.\d*)?|\.\d+/",'',$str);
            return $str;
        }

		function read($id){  //返回str数组
            $db = new dbsql;
            $sql_select = "select * from love where love_id={$id};";
            $arr = $db->query($sql_select);   //执行查询
            $arr_fetch = $arr->fetchArray();
            if($arr_fetch){
                $db->close();
                return $arr_fetch;
            }
            
            else{
				$sql_select = "select * from love order by love_id DESC LIMIT 1;"; //通过降序查找
				$arr = $db->query($sql_select);   //执行查询
				$arr_fetch = $arr->fetchArray();
                //$arr_fetch["id"].$arr_fetch["love_text"].$arr_fetch["love_date"]
                $db->close();
				return $arr_fetch; //返回查询结果
			}
        }
        
        function save($json_message){  
            $db = new dbsql;
            $sql_insert = "insert into love(love_text) values('{$json_message}');";
            $db->exec($sql_insert);
            $db->close();
        }
	}
	
?>
