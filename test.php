<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>My First Grid</title>

    <link rel="stylesheet" type="text/css" media="screen" href="css/jquery-ui-1.10.2.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="css/ui.jqgrid.css" />

    <script src="js/jquery-1.9.1.js" type="text/javascript"></script>
    <script src="js/i18n/grid.locale-en.js" type="text/javascript"></script>
    <script src="js/jquery.jqGrid.min.js" type="text/javascript"></script>

    <script type="text/javascript">
        $(function(){
            $("#list").jqGrid({
                url:'example.php',
                datatype: 'xml',
                mtype: 'GET',
                colNames:['Inv No','Date', 'Amount','Tax','Total','Notes'],
                colModel :[
                    {name:'invid', index:'invid', width:55},
                    {name:'invdate', index:'invdate', width:90},
                    {name:'amount', index:'amount', width:80, align:'right'},
                    {name:'tax', index:'tax', width:80, align:'right'},
                    {name:'total', index:'total', width:80, align:'right'},
                    {name:'note', index:'note', width:150, sortable:false}
                ],
                pager: '#pager',
                rowNum:10,
                rowList:[10,20,30],
                sortname: 'invid',
                sortorder: 'desc',
                viewrecords: true,
                gridview: true,
                caption: 'My first grid'
            });
        });
    </script>

</head>
<body>

<table id="list"><tr><td/></tr></table>
<div id="pager"></div>


</body>
</html>