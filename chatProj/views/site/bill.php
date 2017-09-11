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
        border: 1px solid black;
        margin-top: 20px;
    }

    .bill_info {
        width: 100%;
        border: 1px solid black;
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

    .token {
        border-bottom: 1px solid black;
        text-align: right;
    }
</style>
<div class="container bill">
    <table class="bill_info">
        <tr>
            <td colspan="2" rowspan="2">
                ТОЧКА ПАО БАНКА "ФК ОТКРЫТИЕ" Г. МОСКВА<br/><br/>
                Банк получателя
            </td>
            <td>БИК</td>
            <td>044525999</td>
        </tr>
        <tr>
            <td>Сч. №</td>
            <td>30101810845250000999</td>
        </tr>
        <tr>
            <td>ИНН 1660280444</td>
            <td>КПП 166001001</td>
            <td rowspan="2">Сч. №</td>
            <td rowspan="2">40702810007500000120</td>
        </tr>
        <tr>
            <td colspan="2">
                ООО "ЛУК ИТ"<br/><br/>
                Получатель
            </td>
        </tr>
    </table>
    <h3><b>Счет на оплату № BILL NUMBER HERE от BILL DATE HERE г.</b></h3>
    <hr class="HR-2x"/>
    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class="left-column">
                Поставщик</br>
                (Исполнитель):
            </div>
        </div>
        <div class="col-xs-10 no-padding">
            <div class="bill_address"><b> ООО "ЛУК ИТ", ИНН 1660280444, КПП 166001001, 420088, Татарстан Респ, Казань г, Азинская 2-Я ул, дом № 1В, квартира 7</b></div>
        </div>
    </div>

    <div class="col-xs-12 no-padding">
        <div class="col-xs-2 no-padding">
            <div class=" left-column">
                Покупатель</br>
                (Заказчик):
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
            <div class="bill_address"><b> Договор</b></div>
        </div>
    </div>

    <table class="bill_info" style="border: 2px solid black">
        <tr class="center">
            <th>№</th>
            <th>Товары (работы, услуги) </th>
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
                <b>В том числе НДС (18%):</b>
            </div>
            <div class="col-xs-3" style="padding-left: 10px">
                SUM WITH NDS
            </div>
            <div class="col-xs-9" style="text-align: right; padding-right: 0">
                <b>Всего к оплате: </b>
            </div>
            <div class="col-xs-3" style="padding-left: 10px">
                FINAL SUM
            </div>
        </div>
    </div>
    <div class="bill_payer">
        Всего наименований NUM , на сумму SUM руб.<br>
        <b>PUT NUM HERE FOR => <?= num2str("PUT NUM HERE"); ?></b><br/><br/>
        Оплатить не позднее 3 дней с момента выставления счета.<br/>
        Оплата данного счета означает согласие с условиями поставки товара.<br/>
        Уведомление об оплате обязательно, в противном случае не гарантируется наличие товара на складе.<br/>
        Товар отпускается по фатку прихода денег на р/с Поставщика, самовывозом, при наличии доверенности и паспорта.<br/>
        <hr class="HR-2x" />
    </div>
    <div class="col-xs-12 no-padding" style="margin-top: 20px;">
        <div class="col-xs-6 no-padding">
            <div class="col-xs-3 no-padding"><b>Руководитель</b></div>
            <div class="col-xs-9 no-padding token">Якупов В.Б.</div>
            <div class="col-xs-offset-5 col-xs-2">М.П.</div>
        </div>
        <div class="col-xs-offset-1 col-xs-5 no-padding">
            <div class="col-xs-3 no-padding"><b>Бухгалтер</b></div>
            <div class="col-xs-9 no-padding token">Якупов В.Б.</div>
            <div class="col-xs-offset-5 col-xs-2">М.П.</div>
        </div>
    </div>
</div>
