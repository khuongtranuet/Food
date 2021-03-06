<?php

if ( ! function_exists('paginate_ajax')) {
    function paginate_ajax($total_record, $page_index = 1, $page_size = 2, $onclick = 'changePage')
    {
        $link = '';
        $index = 1;
        $btn_next = '>';
        $btn_last = '>|';
        $btn_previous = '<';
        $btn_first = '|<';

        if ($total_record > 0 && $page_index >= 1 && $page_size >= 1) {
            $pages = ceil($total_record / $page_size);

            // Previous page
            if ($page_index > 1) {
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">' . $btn_first . '</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index - 1).')">' . $btn_previous . '</a>';
            }

            if ($pages <= 10) {
                for ($index = 1; $index <= $pages; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                    }
                }
            } else {
                if ($page_index <= 5) {
                    for ($index = 1; $index <= 5; $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }

                    $link .= '...';

                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

                } else if ($page_index > 5 && $page_index < ($pages - 4)) {
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                    $link .= '...';

                    for ($index = ($page_index - 2); $index <= ($page_index + 2); $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }

                    $link .= '...';

                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

                } else {
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                    $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                    $link .= '...';

                    for ($index = ($pages - 4); $index <= $pages; $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }
                }
            }

            // Next page
            if ($page_index < $pages) {
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index + 1).')">' . $btn_next . '</a>';
                $link .= '<a class="pms-page" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $btn_last . '</a>';
            }

        }

        return $link;
    }
}

if ( ! function_exists('paginate_ajax2')) {
    function paginate_ajax2($total_record, $page_index = 1, $page_size = 2, $onclick = 'changePage')
    {
        $link = '';
        $index = 1;
        $btn_next = '>';
        $btn_last = '>|';
        $btn_previous = '<';
        $btn_first = '|<';

        if ($total_record > 0 && $page_index >= 1 && $page_size >= 1) {
            $pages = ceil($total_record / $page_size);

            // Previous page
            if ($page_index > 1) {
                $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'(1)">' . $btn_first . '</a>';
                $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index - 1).')">' . $btn_previous . '</a>';
            }

            if ($pages <= 10) {
                for ($index = 1; $index <= $pages; $index++) {
                    if ($index == $page_index) {
                        $link .= '<span class="pms-page-current2">' . $index . '</span>';
                    } else {
                        $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                    }
                }
            } else {
                if ($page_index <= 5) {
                    for ($index = 1; $index <= 5; $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current2">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }

                    $link .= '...';

                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

                } else if ($page_index > 5 && $page_index < ($pages - 4)) {
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                    $link .= '...';

                    for ($index = ($page_index - 2); $index <= ($page_index + 2); $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current2">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }

                    $link .= '...';

                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.($pages - 1).')">' . ($pages - 1) . '</a>';
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $pages . '</a>';

                } else {
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'(1)">1</a>';
                    $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'(2)">2</a>';
                    $link .= '...';

                    for ($index = ($pages - 4); $index <= $pages; $index++) {
                        if ($index == $page_index) {
                            $link .= '<span class="pms-page-current2">' . $index . '</span>';
                        } else {
                            $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$index.')">' . $index . '</a>';
                        }
                    }
                }
            }

            // Next page
            if ($page_index < $pages) {
                $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.($page_index + 1).')">' . $btn_next . '</a>';
                $link .= '<a class="pms-page2" href="javascript:void(0)" onclick="'.$onclick.'('.$pages.')">' . $btn_last . '</a>';
            }

        }

        return $link;
    }
}
function echo_pre($data, $die = false)
{
    echo '<pre>';
    print_r($data);
    echo '</pre>';
    if ($die) {
        die();
    }
}

function qrCode($data) {
    $qrCode = new QrCode();
    $start_intend = date("H:m d/m/Y", strtotime($data['start_intend']));
    $end_intend = date("H:m d/m/Y", strtotime($data['end_intend']));
    $text = "Chi ti???t: ".$data['name']."\n";
    $text .= "Ph??ng: ".$data['room_name']."\n";
    $text .= "Th???i gian: ".$start_intend." ?????n ".$end_intend."";
    $qrCode
        ->setText($text)
        ->setSize(500)
        ->setPadding(2)
        ->setErrorCorrection('high')
        ->setForegroundColor(array('r' => 0, 'g' => 0, 'b' => 0, 'a' => 0))
        ->setBackgroundColor(array('r' => 255, 'g' => 255, 'b' => 255, 'a' => 0))
        ->setLabel('')
        ->setLabelFontSize(16)
        ->setImageType(QrCode::IMAGE_TYPE_PNG)
    ;
    return '<img id="qrcode" class="qrcode" src="data:'.$qrCode->getContentType().';base64,'.$qrCode->generate().'" width="50" height="50"/>';
}

function getImageFromBase64Encode($str_base64) {
    return 'data:image/png;base64,'.$str_base64;
}

function checkRoles($page = null, $act = null) {
//	echo $page;
//	echo $act;
//	echo_pre($_SESSION['array']);

    if (isset($_SESSION['array'])) {
        $page = isset($page) ? $page : null;
        $act = isset($act) ? $act : null;

        if (isset($page) && $page == 'account') {
            return true;
        }
        if (isset($page) && $page == 'login') {
            return true;
        }
        if (isset($page) && $page != null && isset($act) && $act != null) {
            $check_role = in_array($page, $_SESSION['array']);
            if ($check_role == true) {
                if ($page == 'home') {
                    return true;
                }
                $check_permission = in_array($act, $_SESSION['user_roles'][$page]);
//				echo_pre($_SESSION['user_roles'][$page]);
                if ($check_permission == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } elseif (isset($page) && $page != null) {
            return in_array($page, $_SESSION['array']);
        }
    }
}

function isEmail($str) {
    if (!filter_var($str, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
        return false;
    }else{
        return true;
    }
}

function randomString($length) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $size = strlen($chars);
    $str = '';
    for( $i = 0; $i < $length; $i++ ) {
        $str .= $chars[rand(0,$size - 1)];
    }
    return $str;
}

function isFormValidated($errors)
{
    if(count($errors) > 0) {
        return false;
    } else {
        return true;
    }
}

function ramdomOrderNumber() {
    $str = date('md').substr(implode(NULL, array_map('ord', str_split(substr(uniqid(), 7, 13), 1))), 0, 8);
    return $str;
}

function convertPrice($str) {
    $str_reverse = strrev($str);
    $total_trim = ceil(strlen($str) / 3);
    $str_final = '';
    for ($i = 0; $i < $total_trim; $i++) {
        $str_trim = substr($str_reverse, ($i) * 3, 3);
        if ($i < $total_trim - 1) {
            $str_final .= $str_trim . '.';
        } else {
            $str_final .= $str_trim;
        }
    }
    return strrev($str_final);
}

function dataTree($data, $parent_id = null, $level = 0) {
    $result = array();
    foreach ($data as $item) {
        if ($item['parent_id'] == $parent_id) {
            $item['level'] = $level;
//			$result[] = $item;
            $child = dataTree($data, $item['id'], $level + 1);
            $item['child'] = $child;
            $result[] = $item;
//			$result = array_merge($result, $child);
        }
    }
    return $result;
}

function unique_img($fileName) {
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));
    $allowed = array('jpg', 'jpeg', 'png');
    return $img = uniqid('img-', true) . "." . $fileActualExt;
}

function statusOrder($status) {
    switch ($status) {
        case 0: return 'Ch??? ti???p nh???n';
        case -1: return 'H???y ????n h??ng';
        case 1: return 'Ch??a ti???p nh???n';
        case 2: return '???? ti???p nh???n';
        case 3: return '???? l???y h??ng/???? nh???p kho';
        case 4: return '???? ??i???u ph???i giao h??ng/??ang giao h??ng';
        case 5: return '???? giao h??ng/Ch??a ?????i so??t';
        case 6: return '???? ?????i so??t';
        case 7: return 'Kh??ng l???y ???????c h??ng';
        case 8: return 'Ho??n l???y h??ng';
        case 9: return 'Kh??ng giao ???????c h??ng';
        case 10: return 'Delay giao h??ng';
        case 11: return '???? ?????i so??t c??ng n??? tr??? h??ng';
        case 12: return '???? ??i???u ph???i l???y h??ng/??ang l???y h??ng';
        case 13: return '????n ha??ng b????i hoa??n';
        case 20: return '??ang tr??? h??ng (COD c???m h??ng ??i tr???)';
        case 21: return '???? tr??? h??ng (COD ???? tr??? xong h??ng)';
        case 123: return 'Shipper b??o ???? l???y h??ng';
        case 127: return 'Shipper (nh??n vi??n l???y/giao h??ng) b??o kh??ng l???y ???????c h??ng';
        case 128: return 'Shipper b??o delay l???y h??ng';
        case 45: return 'Shipper b??o ???? giao h??ng';
        case 49: return 'Shipper b??o kh??ng giao ???????c giao h??ng';
        case 410: return 'Shipper b??o delay giao h??ng';
    }
    return 0;
}

if ( ! function_exists('constants'))
{
    function constants($key)
    {
        return config('constants.' . $key);
    }
}

if (!function_exists('translateKeyWord')) {
    function translateKeyWord($keyWord)
    {
        if (empty($keyWord)) {
            return $keyWord;
        } else {
            return str_replace(['%'], ['\%'], $keyWord);
        }
    }
}

if (!function_exists('productStatusName')) {
    function productStatusName($status)
    {
        $name = 'H???t h??ng';
        switch($status){
            case 1:
                $name = 'C??n h??ng';
                break;
        }
        return $name;
    }
}
