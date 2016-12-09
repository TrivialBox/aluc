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
                echo '<td>';
                if (is_array($value)) {
                    echo '<dl>';
                    foreach ($value as $name => $val) {
                        echo <<<TAG
                        <strong>{$name}:</strong>
                        <span>{$val}</span>
                        <br>
TAG;
                    }
                    echo '</dl>';
                } else {
                    echo $value;
                }
                echo '</td>';
            }
            echo '</tr>';
        }
    ?>
    </tbody>
</table>

