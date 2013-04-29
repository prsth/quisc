

<div id="mainmenu">
    <? for($i=0; $i < count($items); $i++) {
        if ($items[$i]['active']) { ?>
            <div id="mainmenuitem<?=$i?>" class="mainmenuitem active" style="z-index: <?echo count($items)-$i?>">
                <img id="mainenuitem_vk_left<?=$i?>" src="images/page_white_left.png" alt="" class="active">
                <div id="mainmenutext<?=$i?>" class="mainmenutext active">
                    <a href="<?echo $items[$i]['url']?>" class="active"><?=$items[$i]['label']?></a>
                </div>
                <img id="mainmenuitem_vk_right<?=$i?>" src="images/page_white_right.png" alt="">
            </div>
        <?} else {?>
            <div id="mainmenuitem<?=$i?>" class="mainmenuitem" style="z-index: <?echo count($items)-$i?>">
                <img id="mainenuitem_vk_left<?=$i?>" src="images/page_white_left.png" alt="">
                <div id="mainmenutext<?=$i?>" class="mainmenutext">
                    <a href="<?echo $items[$i]['url']?>"><?=$items[$i]['label']?></a>
                </div>
                <img id="mainmenuitem_vk_right<?=$i?>" src="images/page_white_right.png" alt="">
            </div>
      <?}
     }?>

    <div class="clear"></div>
</div>

