<html>
    <head>
        <style>
            h1 { text-align: center; font-size: 20mm}
            h3 { text-align: center; font-size: 14mm}
        </style>
    </head>
    <body>
        <div>
            <h1>Reporte</h1>
            <table class="table">
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
        </div>
    </body>
</html>