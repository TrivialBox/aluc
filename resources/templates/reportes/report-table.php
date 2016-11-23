<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
    <thead>
    <tr>
        <?php
            foreach ($get('headers') as $header) {
                echo "<th>{$header}</th>";
            }
        ?>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach ($get('rows') as $row) {
            echo '<tr>';
            foreach ($row as $value) {
                echo "<td>{$value}</td>";
            }
            echo '</tr>';
        }
    ?>
    </tbody>
</table>
