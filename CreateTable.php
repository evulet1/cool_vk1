<?php
/**
 * Created by PhpStorm.
 * User: A229
 * Date: 05.01.2019
 * Time: 9:43
 */

class CreateTable
{

    // not used
    public function User($arr) {
      //  $this->user_data = $arr;

        $tbl = '<table class="table">';
        $i = 0;
        foreach ($arr as $key=>$val) {

            $bdate = '';
            $country = '';
            $city = '';
            $mobile = '';
            $home_phone = '';
            $site = '';

            if ($val->bdate)
                $bdate = $val->bdate;
            if(isset($val->mobile_phone) && $val->mobile_phone!='')
                $mobile=$val->mobile_phone;
            if(isset($val->home_phone) && $val->home_phone!='')
                $mobile=$val->home_phone;
            if(isset($val->site) && $val->site!='')
                $site=$val->site;
            if($val->country->title)
                $country = $val->country->title;
            if($val->city->title)
                $country = $val->city->title;
            if($val->schools > 0 ){
                $school = '';
            }
            if($val->universities > 0 ){
                $university = '';
            }
            $last_seen = date('Y-m-d H:i:s',$val->last_seen->time);


            $tbl .= "<tr>
                <td>$i</td>
                <td>$val->photo_50</td>
                <td>$val->last_name</td>
                <td>$val->first_name</td>
                <td>$bdate</td>
                <td>$val->id</td>
                <td>мобильный: $mobile <br>
                    домашний: $home_phone <br>
                    сайт: $site <br>
                </td>
                <td>$country</td>
                <td>$city</td>
                <td>$school</td>
                <td>$university</td>
                <td>$last_seen</td>
            
            </tr>";
            $i++;
        }
        $tbl .= '</table>';

        echo $tbl;
    }

    public function isInIhead($val, $thead = array())
    {
        if (!in_array($val, $thead)) {
            $thead[] = $val;
        }
        return $thead;
    }

    public function openArr($array, $thead, $keys = '', $mass = array(), $flag = false)
    {
        foreach ($array as $key=>$value) {

            if (is_object($value) || is_array($value)) {

                if($flag == false) {

                    $thead = $this->isInIhead($key, $thead);
                }

                $res = $this->openArr($value, $thead, $key, $mass, true);

                $mass = $mass + $res['mass'];

            } else {

                if ($flag == false) {

                    $thead = $this->isInIhead($key, $thead);

                    $mass[$key] = $value;

                }  else {

                    if (!empty($mass[$keys])) {

                        if($key == 'title'){
                            $mass[$keys] = $value;
                        } elseif ($key == 'platform'){
                            $mass[$keys] = $mass[$keys];
                        } else {
                            $mass[$keys] = $mass[$keys].", $key: ".$value;
                        }
                    } else {
                        if ($keys == 'last_seen') {
                            if (!empty($value) && is_numeric($value))
                                $mass[$keys] = date('Y-m-d H:i:s', ($value));
                            else
                                $mass[$keys] = $value;
                        } else
                            $mass[$keys] =  $value;
                    }

                }
            }
        }

        return array('thead'=>$thead, 'mass'=>$mass);
    }

    public function writeToBrowser($arr, $thead){

        $res = '
			<div class="wrap-table100">
				<div class="table100 ver2"><table class="table table-striped" data-vertable="ver2"><thead><th class="nn">NN</th>';
        $y = 0;

        foreach ($thead as $item) {
            $res .= '<th class="'.$item.'  row100 head">'.$item.'</th>';
        }

        $res .= "</thead>";

        foreach ($arr as $key=>$val) {

            $res .= "<tr class=\"row100\">";
            $res .='<td class="nn column100 column1" data-column="column1">'.$y.'</td>';

            for($i = 0; $i < count($thead); $i++) {
                    $class = 'column100 column'.($i+2).'" data-column="column'.($i+2).'"';
                if(!empty($val[$thead[$i]])) {

                    if ($thead[$i] == 'id') {

                        $res .= '<td class="id  '.$class .'><a href="https://vk.com/id'.$val[$thead[$i]].'">'.$val[$thead[$i]].'</a></td>';
                    } elseif ($thead[$i] == 'photo_50') {

                        $res .= '<td class="'.$thead[$i].' '.$class .'><img src="'.$val[$thead[$i]].'" /></td>';
                    } else {

                        $res .= '<td class="'.$thead[$i].' '.$class .'> '. $val[$thead[$i]] . '</td>';
                    }
                } else {
                        $res .= '<td class="'.$thead[$i].' '.$class .'></td>';
                }
            }

            $res .= "</tr>";
            $y++;
        }

        $res .= "</table></div></div>";

        $ch = $this->createChecBox($thead);

        return $ch.$res;
    }

    public function createChecBox($thead){

        $res = '<form>
                <div class="multiselect">
                    <div class="selectBox" onclick="showCheckboxes()">
                        <select>
                            <option>Select an option</option>
                        </select>
                        <div class="overSelect"></div>
                    </div>
                    <div id="checkboxes">  ';
		$res1 = '<select class="selectpicker" multiple>';

		$i =0;
        foreach ($thead as $item) {

          /*  if ($i%3 >0) {
                $res .= '<br>';
            }*/

         //  $res .= "$item :<input id=\"$item\" type=\"checkbox\" name=\"$item\" value=\"$item\" onclick=\"hideColumn('$item')\">    ";
          $res .= '<label for="one">
                           <input type="checkbox" id="one" onclick="hideColumn(\''.$item.'\')" />'.$item.'</label>';
			//	$res .= "<option onclick=\"hideColumn('$item')\">$item</option>";
            $i++;
        }

        $res .= ' </div>
                </div>
            </form>';
			//$res .= '</select>';
        return $res;
    }

    public function superTbl($arr) {

        $i = 0;
        $thead = array();
        $mass = array();

        foreach ($arr as $val) {

            $result = $this->openArr($val, $thead);

            $thead = $result['thead'];

            $mass[] = $result['mass'];

            $i++;
        }

        $res = $this->writeToBrowser($mass, $thead);

        return $res;
    }

}