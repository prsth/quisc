<?php


class EChtml extends CHtml {

    public static function bgLinkButton($label, $bgclass, $textclass, $htmlOptions=array())
    {
        $htmlOptions['class'] = $bgclass;

        $text = '<span class="'.$textclass.'">'.$label.'</span>';

        if(!isset($htmlOptions['submit']))
            $htmlOptions['submit']=isset($htmlOptions['href']) ? $htmlOptions['href'] : '';
        return self::link($text,'#',$htmlOptions);
    }
}