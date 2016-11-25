<html>
    <head>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                background-color: #00AAFF;
                color: white;
            }
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