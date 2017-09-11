<?php

/* @var $this yii\web\View */

use yii\helpers\Url;

$this->title = Yii::t("app", "Helping retain customers");

//$this->params['breadcrumbs'][] = "";

/**
 * Возвращает сумму прописью
 * @author runcore
 * @uses morph(...)
 */
function num2str($num) {
    $nul='ноль';
    $ten=array(
        array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),
        array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять'),
    );
    $a20=array('десять','одиннадцать','двенадцать','тринадцать','четырнадцать' ,'пятнадцать','шестнадцать','семнадцать','восемнадцать','девятнадцать');
    $tens=array(2=>'двадцать','тридцать','сорок','пятьдесят','шестьдесят','семьдесят' ,'восемьдесят','девяносто');
    $hundred=array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот','восемьсот','девятьсот');
    $unit=array( // Units
        array('копейка' ,'копейки' ,'копеек',	 1),
        array('рубль'   ,'рубля'   ,'рублей'    ,0),
        array('тысяча'  ,'тысячи'  ,'тысяч'     ,1),
        array('миллион' ,'миллиона','миллионов' ,0),
        array('миллиард','милиарда','миллиардов',0),
    );
    //
    list($rub,$kop) = explode('.',sprintf("%015.2f", floatval($num)));
    $out = array();
    if (intval($rub)>0) {
        foreach(str_split($rub,3) as $uk=>$v) { // by 3 symbols
            if (!intval($v)) continue;
            $uk = sizeof($unit)-$uk-1; // unit key
            $gender = $unit[$uk][3];
            list($i1,$i2,$i3) = array_map('intval',str_split($v,1));
            // mega-logic
            $out[] = $hundred[$i1]; # 1xx-9xx
            if ($i2>1) $out[]= $tens[$i2].' '.$ten[$gender][$i3]; # 20-99
            else $out[]= $i2>0 ? $a20[$i3] : $ten[$gender][$i3]; # 10-19 | 1-9
            // units without rub & kop
            if ($uk>1) $out[]= morph($v,$unit[$uk][0],$unit[$uk][1],$unit[$uk][2]);
        } //foreach
    }
    else $out[] = $nul;
    $out[] = morph(intval($rub), $unit[1][0],$unit[1][1],$unit[1][2]); // rub
    $out[] = $kop.' '.morph($kop,$unit[0][0],$unit[0][1],$unit[0][2]); // kop
    return trim(preg_replace('/ {2,}/', ' ', join(' ',$out)));
}

/**
 * Склоняем словоформу
 * @ author runcore
 */
function morph($n, $f1, $f2, $f5) {
    $n = abs(intval($n)) % 100;
    if ($n>10 && $n<20) return $f5;
    $n = $n % 10;
    if ($n>1 && $n<5) return $f2;
    if ($n==1) return $f1;
    return $f5;
}

function html_to_pdf($html , $page = 'A4')
{
    require_once 'D:/xampp/htdocs/presentation/vendor/autoload.php';

    $mpdf = new Mpdf();
    $mpdf->SetDisplayMode('fullpage');
    $mpdf->list_indent_first_level = 0;  // 1 or 0 - whether to indent the first level of a list

    $mpdf->WriteHTML($html);
    $mpdf->Output();
}

?>
<style>

    body {
        margin-top: 30px;
    }

    .left {
        float: left;
    }
    .right {
        float: right;
    }

    hr {
        background: black;
        margin-bottom: 0px;
    }

    .HR-2x {
        height: 2px;
        margin-bottom: 20px;
    }

    .bill {
        width: 80%;
    }
    .bill_info {
        width: 100%;
        border: 2px solid black;
        margin-top: 20px;
    }

    .bill_info td{
        border: 1px solid black;
    }

    .bill_info th{
        border: 1px solid black;
    }

    .bill_account{
        font-size: 16px;
    }

    .buh_mark{
        text-align:center;
        padding-right: 5%;
    }

    .bill_token{
        margin-right: 15%;
    }

    .bill_summ{
        margin-top: 10px;
        font-size: 14px;
    }

    .center th{
        text-align: center;
    }

    .no-padding {
        padding:0;
        margin-bottom: 10px;
    }

    .act_token {
        border-bottom: 1px solid black;
        text-align: right;
        margin-top: 40px;
    }
</style>
<div class="container bill">
    <h3><b>Акт № ACT NUMBER HERE от ACT DATE HERE г.</b></h3>
    <hr class="HR-2x"/>
    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class="left-column">
                Исполнитель:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b> ООО "ЛУК ИТ", ИНН 1660280444, 420088, Татарстан Респ, Казань г, Азинская 2-Я ул, дом № 1В, квартира 7, р/с 40702810007500000120, в банке ТОЧКА
                ПАО БАНКА "ФК ОТКРЫТИЕ", БИК 044525999, к/с 30101810845250000999</b></div>
        </div>
    </div>

    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class=" left-column">
                Заказчик:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b> PUT YOUR PAYER CODE HERE</b></div>
        </div>
    </div>

    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class=" left-column">
                Основание:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b>Без договора</b></div>
        </div>
    </div>

    <table class="bill_info">
        <tr class="center">
            <th>№</th>
            <th>Наименование работ, услуг </th>
            <th>Кол-во</th>
            <th>Ед.</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        <!--{$k = 1}
        {$sum = 0}
        {foreach $bill_products item="one_product"}-->
        <tr>
            <td align="center">Number</td>
            <td>Product name</td>
            <td>Quantity</td>
            <td>Unit</td>
            <td>Price</td>
            <td>Product summ</td>
            <!--{$sum = $sum + $one_product.price*$one_product.quantity}
            {/foreach}-->
        </tr>
    </table>
    <div class="col-xs-12">
        <div class="bill_summ">
            <div class="col-xs-9" style="text-align: right; padding-right: 0">
                <b>Итого: </b>
            </div>
            <div class="col-xs-3" style="padding-left: 10px">
                SUM
            </div>
            <div class="col-xs-9" style="text-align: right; padding-right: 0">
                <b>Без налога (НДС)</b>
            </div>
        </div>
    </div>
    <div class="bill_payer">
        Всего оказано услуг NUM, на сумму SUM руб.<br>
        <b>PUT NUM HERE FOR => <?= num2str("PUT NUM HERE"); ?></b><br/><br/>
        Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет.<br/>
        <hr class="HR-2x" />
    </div>
    <div class="col-xs-12 no-padding" style="margin-top: 20px;">
        <div class="col-xs-6 no-padding">
            <div class="col-xs-12 no-padding">
                <b>ИСПОЛНИТЕЛЬ</b><br/>
                Генеральный директор, ООО "ЛУК ИТ"<br/>
            </div>
            <div class="col-xs-12 no-padding act_token"></div>
            <div class="col-xs-offset-4 col-xs-5">Якупов В. Б.</div>
            <div class="col-xs-offset-4 col-xs-2" style="margin-top: 10px;">М.П.</div>
        </div>
        <div class="col-xs-offset-1 col-xs-5 no-padding">
            <div class="col-xs-12 no-padding">
                <b>ЗАКАЗЧИК</b><br/>
                PUT COMPANY NAME HERE
            </div>
            <div class="col-xs-12 no-padding act_token"></div>
            <div class="col-xs-offset-4 col-xs-5">PUT FIO HERE</div>
            <div class="col-xs-offset-4 col-xs-2" style="margin-top: 10px;">М.П.</div>
        </div>
    </div>
</div>


<?php html_to_pdf('<style>

    body {
    margin-top: 30px;
    }

    .left {
    float: left;
}
    .right {
    float: right;
}

    hr {
    background: black;
    margin-bottom: 0px;
    }

    .HR-2x {
    height: 2px;
        margin-bottom: 20px;
    }

    .bill {
    width: 80%;
}
    .bill_info {
    width: 100%;
    border: 2px solid black;
        margin-top: 20px;
    }

    .bill_info td{
    border: 1px solid black;
    }

    .bill_info th{
    border: 1px solid black;
    }

    .bill_account{
    font-size: 16px;
    }

    .buh_mark{
    text-align:center;
        padding-right: 5%;
    }

    .bill_token{
    margin-right: 15%;
    }

    .bill_summ{
    margin-top: 10px;
        font-size: 14px;
    }

    .center th{
    text-align: center;
    }

    .no-padding {
    padding:0;
    margin-bottom: 10px;
    }

    .act_token {
    border-bottom: 1px solid black;
        text-align: right;
        margin-top: 40px;
    }
</style>
<div class="container bill">
    <h3><b>Акт № ACT NUMBER HERE от ACT DATE HERE г.</b></h3>
    <hr class="HR-2x"/>
    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class="left-column">
Исполнитель:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b> ООО "ЛУК ИТ", ИНН 1660280444, 420088, Татарстан Респ, Казань г, Азинская 2-Я ул, дом № 1В, квартира 7, р/с 40702810007500000120, в банке ТОЧКА
                ПАО БАНКА "ФК ОТКРЫТИЕ", БИК 044525999, к/с 30101810845250000999</b></div>
        </div>
    </div>

    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class=" left-column">
Заказчик:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b> PUT YOUR PAYER CODE HERE</b></div>
        </div>
    </div>

    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class=" left-column">
Основание:
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b>Без договора</b></div>
        </div>
    </div>

    <table class="bill_info">
        <tr class="center">
            <th>№</th>
            <th>Наименование работ, услуг </th>
            <th>Кол-во</th>
            <th>Ед.</th>
            <th>Цена</th>
            <th>Сумма</th>
        </tr>
        <!--{$k = 1}
        {$sum = 0}
        {foreach $bill_products item="one_product"}-->
        <tr>
            <td align="center">Number</td>
            <td>Product name</td>
            <td>Quantity</td>
            <td>Unit</td>
            <td>Price</td>
            <td>Product summ</td>
            <!--{$sum = $sum + $one_product.price*$one_product.quantity}
            {/foreach}-->
        </tr>
    </table>
    <div class="col-xs-12">
        <div class="bill_summ">
            <div class="col-xs-9" style="text-align: right; padding-right: 0">
                <b>Итого: </b>
            </div>
            <div class="col-xs-3" style="padding-left: 10px">
    SUM
            </div>
            <div class="col-xs-9" style="text-align: right; padding-right: 0">
                <b>Без налога (НДС)</b>
            </div>
        </div>
    </div>
    <div class="bill_payer">
Всего оказано услуг NUM, на сумму SUM руб.<br>
        <b>PUT NUM HERE FOR => <?= num2str("PUT NUM HERE"); ?></b><br/><br/>
Вышеперечисленные услуги выполнены полностью и в срок. Заказчик претензий по объему, качеству и срокам оказания услуг не имеет.<br/>
<hr class="HR-2x" />
</div>
<div class="col-xs-12 no-padding" style="margin-top: 20px;">
    <div class="col-xs-6 no-padding">
        <div class="col-xs-12 no-padding">
            <b>ИСПОЛНИТЕЛЬ</b><br/>
            Генеральный директор, ООО "ЛУК ИТ"<br/>
        </div>
        <div class="col-xs-12 no-padding act_token"></div>
        <div class="col-xs-offset-4 col-xs-5">Якупов В. Б.</div>
        <div class="col-xs-offset-4 col-xs-2" style="margin-top: 10px;">М.П.</div>
    </div>
    <div class="col-xs-offset-1 col-xs-5 no-padding">
        <div class="col-xs-12 no-padding">
            <b>ЗАКАЗЧИК</b><br/>
            PUT COMPANY NAME HERE
        </div>
        <div class="col-xs-12 no-padding act_token"></div>
        <div class="col-xs-offset-4 col-xs-5">PUT FIO HERE</div>
        <div class="col-xs-offset-4 col-xs-2" style="margin-top: 10px;">М.П.</div>
    </div>
</div>
</div>');