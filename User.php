<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 05.01.2019
 * Time: 10:03
 */

class User
{
    public function getData($id) {
        $request_params1 = array (
            'user_ids' => $id,
          //  'user_ids' => '157569248,157574602,157584695,157609252',
            'fields' => 'photo_50, bdate, id, contacts,	has_mobile, city, country, home_town, education, site, schools, universities, career, last_seen',
                            /*photo_id, verified, sex, bdate, city, country, home_town, has_photo, photo_50, photo_100, photo_200_orig, photo_200,
                             photo_400_orig, photo_max, photo_max_orig, online, domain, has_mobile, contacts, site, education, universities, schools, status, last_seen,
                             followers_count, common_count, occupation, nickname, relatives, relation, personal, connections, exports, activities, interests, music,
                             movies, tv, books, games, about, quotes, can_post, can_see_all_posts, can_see_audio, can_write_private_message,
                              can_send_friend_request, is_favorite, is_hidden_from_feed, timezone, screen_name, maiden_name, crop_photo, is_friend, friend_status, career, military, blacklisted, blacklisted_by_me.*/

            'name_case' => '',//падеж для склонения имени и фамилии пользователя. Возможные значения: именительный – nom, родительный – gen, дательный – dat, винительный – acc, творительный – ins, предложный – abl. По умолчанию nom. строка
            'access_token' => $_SESSION['access_token'],
            'v' => '5.80'
        );

        $get_params1 = http_build_query($request_params1);
        $result1 = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params1));

        //echo '<pre>';
       // print_r($result1);

        if(isset($result1->error->error_code) && $result1->error->error_code == 5) {
            return 5;
        }

        return($result1->response);
    }

    public function getIDs($res) {

        $z = 0;
        $y = 0;
        $ids = array();

        foreach ($res as $re) {
            if ($z < 100) {
                $ids[$y][] = $re->id;
                $z++;
            } else {
                $y++;
                $z = 0;
                $ids[$y][] = $re->id;
            }
        }

        return $ids;
    }

}