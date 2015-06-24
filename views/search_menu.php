<body>
<div class="container">
    <img src="static/img/htw_logo_text.gif" width="260" class="pull-left">
</div>
<div class="container">
    <div class="starter-template">
        <div class="btn-group menu_elem">
            <button id="tresk_button" type="button" class="btn btn-default">Treskowallee</button>
            <button id="wilh_button" type="button" class="btn btn-default">Wilheminenhof</button>
        </div>
        <br>
        <div id="tresk_dropdown" class="btn-group">
            <button id="tresk_dropdown_btn" type="button" class="btn btn-default dropdown-toggle menu_elem" data-toggle="dropdown" aria-expanded="true">
                <span id="tresk_dropdown_label">Gebäude</span>
                <br>
                <span class="caret pull-right"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php
                    foreach($data['tresk'] as $building) {
                        echo '<li class="tresk_dropdown_elem"> <a class="tresk_building_link" href="#">' . $building . '</a></li>';
                    }
                ?>
            </ul>
        </div>
        <div id="wilh_dropdown" class="btn-group">
            <button id="wilh_dropdown_btn" type="button" class="btn btn-default dropdown-toggle menu_elem" data-toggle="dropdown" aria-expanded="true">
                <span id="wilh_dropdown_label">Gebäude</span>
                <br>
                <span class="caret pull-right"></span>
            </button>
            <ul class="dropdown-menu" role="menu">
                <?php
                foreach($data['wilh'] as $building) {
                    echo '<li class="wilh_dropdown_elem"> <a href="#">' . $building . '</a></li>';
                }
                ?>
            </ul>
        </div>
        <br>
        <input id="datetimepicker" class="menu_elem" type="datetime-local">
        <br>
        <button id="search_btn" type="button" class="btn btn-default search_button">Suche</button>
    </div>
</div>