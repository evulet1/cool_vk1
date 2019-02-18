<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 22.01.2019
 * Time: 10:52
 */
session_start();
?>

<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="style.css"/>


    <script type="text/javascript" src="jquery/external/jquery/jquery.js"></script>
    <script type="text/javascript" src="jquery/jquery-ui.js"></script>

    <title>Friends by User</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="logo">
            <img src="./img/vk_white.png"/>
        </div>
        <div id="results" ></div>

    </div>
    <div class="row ">
        <div class="col-2">
            <div class="list-group" id="list-tab" role="tablist">
                <a class="list-group-item list-group-item-action active" id="list-user-list" data-toggle="list" href="#list-user" role="tab" aria-controls="user">Работа со страницей пользователя</a>
                <a class="list-group-item list-group-item-action" id="list-group-list" data-toggle="list" href="#list-group" role="tab" aria-controls="group">Работа с группами*</a>
                <a class="list-group-item list-group-item-action" id="list-userm-list" data-toggle="list" href="#list-userm" role="tab" aria-controls="userm">Мониторинг и анализ отдельных пользователей*</a>
                <a class="list-group-item list-group-item-action" id="list-groupm-list" data-toggle="list" href="#list-groupm" role="tab" aria-controls="groupm">Мониторинг изменений в группах*</a>
            </div>
        </div>
        <div class="col-6">
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="list-user" role="tabpanel" aria-labelledby="list-user-list">
                    <div class="row">
                        <div class="col-4">
                            <div class="list-group" id="list-tab" role="tablist">
                                <a class="list-group-item list-group-item-action active" id="list-ufriends-list" data-toggle="list" href="#list-ufriends" role="tab" aria-controls="ufriends">Выгрузка друзей пользователя</a>
                                <a class="list-group-item list-group-item-action" id="list-ufollows-list" data-toggle="list" href="#list-ufollows" role="tab" aria-controls="ufollows">Выгрузка подписчиков пользователя</a>
                                <a class="list-group-item list-group-item-action" id="list-ugroups-list" data-toggle="list" href="#list-ugroups" role="tab" aria-controls="ugroups">Выгрузка групп пользователя*</a>
                                <a class="list-group-item list-group-item-action" id="list-upage-list" data-toggle="list" href="#list-upage" role="tab" aria-controls="upage">Выгрузка содержимого страницы пользователя*</a>
                                <a class="list-group-item list-group-item-action" id="list-ucompare-list" data-toggle="list" href="#list-ucompare" role="tab" aria-controls="ucompare">Сравнение списка друзей пользователя*</a>
                            </div>
                        </div>
                        <div class="col-7">
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="list-ufriends" role="tabpanel" aria-labelledby="list-ufriends-list">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <div class="row">
                                                    <form id="user_1" action ="show_user_info.php" method="post">
                                                        <!--       <form id="user_1" method="post">-->
                                                        <label class="sid" for="male"><input  id="user_friend_id" name="user_friend_id" value="" placeholder="ID(только цифры)" /></label>
                                                        <button type="submit" name="exl" class="btn btn-vk">Загрузить Excel</button>
                                                        <!--       <button type="submit" name="cvsbut" class="btn btn-vk">Загрузить CSV</button>-->
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-ufollows" role="tabpanel" aria-labelledby="list-ufollows-list">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="list-group" id="list-tab" role="tablist">
                                                <div class="row">
                                                    <form id="user_1" action ="show_user_info.php" method="post">
                                                        <label class="sid" for="male"><input  id="user_follow_id" name="user_follow_id" value="" placeholder="ID(только цифры)"/></label>
                                                        <button type="submit" name="exl" class="btn btn-vk">Загрузить Excel</button>
                                                        <!--      <button type="submit" class="btn btn-vk">Загрузить CSV</button> -->
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="list-messages" role="tabpanel" aria-labelledby="list-upage-list">...</div>
                                <div class="tab-pane fade" id="list-settings" role="tabpanel" aria-labelledby="list-ucompare-list">...</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-group" role="tabpanel" aria-labelledby="list-group-list">
                    <div class="row">
                        <div class="col-12">
                            Wait...
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-userm" role="tabpanel" aria-labelledby="list-messages-list">
                    <div class="row">
                        <div class="col-12">
                            Wait...
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="list-groupm" role="tabpanel" aria-labelledby="list-settings-list">
                    <div class="row">
                        <div class="col-12">
                            Wait...
                        </div>
                    </div>
                </div>
            </div>



        </div>

    </div>
</div>
</body>
<script src="./bootstrap/js/bootstrap.js"></script>

<script>
    $('#list-ufriends a').on('click', function (e) {
        e.preventDefault()
        $('#list-ufriends').tab('show')
    });
    $('#list-ufollows-list a').on('click', function (e) {
        e.preventDefault()
        $('#list-ufollows').tab('show')
    });

</script>
</html>