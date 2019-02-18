<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 23.01.2019
 * Time: 14:57
 */

class FollowsUser
{
    private $follows;
//	private $count;

    function __construct()
    {
        $this->follows = array();
    }

    public function getListId($id, $offset = null)
    {
        $request_params1 = array (
            'user_id' => $id,
            'count' =>  1000,/*количество подписчиков, информацию о которых нужно получить. положительное число, по умолчанию 100, максимальное значение 1000*/
            'offset' => $offset,//смещение, необходимое для выборки определенного подмножества друзей. положительное число
            'fields' => 'photo_50, bdate, id, contacts,	has_mobile, city, country, education, universities, last_seen',/*список дополнительных полей профилей, которые необходимо вернуть. См. подробное описание.
Доступные значения: photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200, photo_400_orig, photo_max, photo_max_orig, online, lists, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen, followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, wall_comments, activities, interests, music, movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message, can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me.
список слов, разделенных через запятую*/

            'name_case' => '',//падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – nom, родительный – gen, дательный – dat, винительный – acc, творительный – ins, предложный – abl. По умолчанию nom. строка
            'access_token' => $_SESSION['access_token'],
            'v' => '5.80'
        );

        $get_params1 = http_build_query($request_params1);
        $result1 = json_decode(file_get_contents('https://api.vk.com/method/users.getFollowers?'. $get_params1));

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
            $offset +=1000;

        }
        return $res;
    }

}