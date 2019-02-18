<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 22.01.2019
 * Time: 17:30
 */
include_once ('config.php');

if(isset($_POST)) {

 /*   function myAutoloader($className)
    {
        include $className . '.php';
    }
    spl_autoload_register('myAutoloader');
*/
    session_start();

    function Auth($main_link)
    {
        include_once ('Auth.php');
        $conn = new Auth($main_link);
        $conn->VK('show_user_info.php');
    }

    if (!empty($_GET['access_token'])) {
        $_SESSION['access_token'] = $_GET['access_token'];
    }

    if (!isset($_SESSION['access_token']) || $_SESSION['access_token'] == 0) {
        include_once ('Auth.php');
        Auth($main_link);
        if (!empty($_GET['access_token'])) {
            $_SESSION['access_token'] = $_GET['access_token'];
        }
    }

    if (isset($_POST['user_friend_id']) && $_POST['user_friend_id'] != null && $_SESSION['access_token'] != 0) {

        include_once ('Friends.php');
        $fr = new Friends();//13321413
        $res = $fr->getAllList($_POST['user_friend_id']);

        if ($res === 5) {

            include_once ('Auth.php');
            Auth($main_link);
            if (!empty($_GET['access_token'])) {
                $_SESSION['access_token'] = $_GET['access_token'];
            }

        } elseif ($res == 100){
            echo "Ошибка обработки запроса в сервисе ВКонтакте";

        } else {

            include_once ('User.php');
            $users = new User();
            $ids = $users->getIDs($res);
            $all = array();

            $i = 0;
            foreach ($ids as $idd) {
                if ($i % 3 == 0) {
                    sleep(1);
                } else {
                    //	sleep(3);
                }
                $arr = implode(",", $idd);
                $all_user = $users->getData($arr);
                $all = array_merge($all_user, $all);
                $i++;
            }

            if ($all  && isset($_POST['brow'])) {

                /*$rr = new CreateTable();
                echo $rr->superTbl($all);*/

            } elseif ($all  && isset($_POST['exl'])) {

                require 'vendor/autoload.php';
                include_once ('CreateTable.php');
                include_once ('CreateExl.php');

                $rr = new CreateExl();
                $res1 = $rr->superTblExl($all, 'friends', $_POST['user_friend_id']);

                if ($res1 != 1 ) {

                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$res1".'.xlsx');
                    //   header("Content-Type: application/zip");
                    header("Content-Transfer-Encoding: binary");
                    readfile($file = 'files/'.$res1.'.xlsx');

                    unlink($file = 'files/'.$res1.'.xlsx');
                }

            } elseif ($all  && isset($_POST['csvbut'])) {

            /*    $rr = new CreateExl();
                $res1 = $rr->superTblCsv($all);

                if ($res1 != 1 ) {
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$res1");
                    //   header("Content-Type: application/zip");
                    header("Content-Transfer-Encoding: binary");
                    readfile($res1);

                    unlink('files/hello_world.xlsx');

                }*/
            } else {
                echo 'Такого ID похоже не существует';
            }
        }
    } elseif (isset($_POST['user_follow_id']) && $_POST['user_follow_id'] != null && $_SESSION['access_token'] != 0) {

        include_once ('FollowsUser.php');
        $fl = new FollowsUser();
        $res = $fl->getAllList($_POST['user_follow_id']);

        if ($res === 5) {

            include_once ('Auth.php');
            Auth();
            if (!empty($_GET['access_token'])) {
                $_SESSION['access_token'] = $_GET['access_token'];
            }

        } elseif ($res == 100){
            echo "Ошибка обработки запроса в сервисе ВКонтакте";

        } else {

            include_once ('User.php');
            $users = new User();
            $ids = $users->getIDs($res);
            $all = array();

            $i = 0;
            foreach ($ids as $idd) {
                if ($i % 3 == 0) {
                    sleep(1);
                } else {
                    //	sleep(3);
                }
                $arr = implode(",", $idd);
                $all_user = $users->getData($arr);
                $all = array_merge($all_user, $all);
                $i++;
            }

            if ($all  && isset($_POST['brow'])) {

             /*   $rr = new CreateTable();
                echo $rr->superTbl($all);*/

            } elseif ($all  && isset($_POST['exl'])) {

                require 'vendor/autoload.php';
                include_once ('CreateTable.php');
                include_once ('CreateExl.php');
                $rr = new CreateExl();
                $res1 = $rr->superTblExl($all, 'followers', $_POST['user_follow_id']);

                if ($res1 != 1 ) {

                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$res1".'.xlsx');
                    //   header("Content-Type: application/zip");
                    header("Content-Transfer-Encoding: binary");
                    readfile($file = 'files/'.$res1.'.xlsx');

                    unlink($file = 'files/'.$res1.'.xlsx');
                }

            } elseif ($all  && isset($_POST['csvbut'])) {

               /* $rr = new CreateExl();
                $res1 = $rr->superTblCsv($all);

                if ($res1 != 1 ) {
                    header("Cache-Control: public");
                    header("Content-Description: File Transfer");
                    header("Content-Disposition: attachment; filename=$res1");
                    //   header("Content-Type: application/zip");
                    header("Content-Transfer-Encoding: binary");
                    readfile($res1);

                    unlink('files/hello_world.xlsx');

                }*/
            }
        }

    }    else {
        echo 'Не введен ID <br> <a href="'.$main_link.'/index.php">Вернуться на главную</a>';
    }
} else {
    echo 'Не введен ID <br> <a href="'.$main_link.'/index.php">Вернуться на главную</a>';
}
?>