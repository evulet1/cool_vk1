<?php

class Friends{

	private $friends;
//	private $count;
	
	function __construct()
	{
		$this->friends = array();
	}
	
	public function getListId($id, $offset = null)
	{
		$request_params1 = array (
			'user_id' => $id,
			'order' => '',/*порядок, в котором нужно вернуть список друзей. Допустимые значения:
							hints — сортировать по рейтингу, аналогично тому, как друзья сортируются в разделе Мои друзья (Это значение доступно только для Standalone-приложений с ключом доступа, полученным по схеме Implicit Flow.).
							random — возвращает друзей в случайном порядке.
							mobile — возвращает выше тех друзей, у которых установлены мобильные приложения.
							name — сортировать по имени. Данный тип сортировки работает медленно, так как сервер будет получать всех друзей а не только указанное количество count. (работает только при переданном параметре fields).

							По умолчанию список сортируется в порядке возрастания идентификаторов пользователей целое число*/
			'list_id' =>  '',/*идентификатор списка друзей, полученный методом friends.getLists, друзей из которого необходимо получить. Данный параметр учитывается, только когда параметр user_id равен идентификатору текущего пользователя.Этот параметр доступен только для Standalone-приложений с ключом доступа, полученным по схеме Implicit Flow. положительное число*/
			'count' => 5000,//5000
			'offset' => $offset,//смещение, необходимое для выборки определенного подмножества друзей. положительное число
			'fields' => 'photo_50, bdate, id, contacts,	has_mobile, city, country, education, universities, last_seen',/*список дополнительных полей, которые необходимо вернуть. Доступные значения: nickname, domain, sex, bdate, city, country, timezone, photo_50, photo_100, photo_200_orig, has_mobile, contacts, education, online, relation, last_seen, status, can_write_private_message, can_see_all_posts, can_post, universities список слов, разделенных через запятую
			*/
			
			'name_case' => '',//падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – nom, родительный – gen, дательный – dat, винительный – acc, творительный – ins, предложный – abl. По умолчанию nom. строка
			'access_token' => $_SESSION['access_token'],
			'v' => '5.80'
		);

		$get_params1 = http_build_query($request_params1);
		$result1 = json_decode(file_get_contents('https://api.vk.com/method/friends.get?'. $get_params1));

		//echo '<pre>';
		//print_r($result1);

        if(isset($result1->error->error_code) && $result1->error->error_code == 5) {
            return 5;
        } elseif (isset($result1->error->error_code)) {
            return 100;
        }
		return($result1->response->items);
	}

	public function getAllList($id)
	{
		$offset = 0;
		$res = array();
		while (1)
		{
			$arr = $this->getListId($id, $offset);

            if($arr == 5) {
                return 5;
            } elseif ($arr == 100) {
                return 100;
            }

            $res = array_merge($arr,$res);

			$count = count($arr);

			if($count == 0) {
				break;
			} 
			$offset +=5000;
			
		}
		return $res;
	}
}
?>