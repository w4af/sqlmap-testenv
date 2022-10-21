<?php
    function dbQuery($query, $show_errors=true, $all_results=true, $show_output=true) {
        if ($show_errors)
            error_reporting(E_ALL);
        else
            error_reporting(E_PARSE);

        // Connect to the MySQL database management system
        $link = mysqli_connect("localhost", "testuser", "testpass");
        if (!$link) {
            die(mysqli_error());
        }

        // Make 'testdb' the current database
        $db_selected = mysqli_select_db($link, "testdb");
        if (!$db_selected) {
            die (mysqli_error($link));
        }

        // Print results in HTML
        print "<html><body>\n";

        // Print SQL query to test sqlmap '--string' command line option
        //print "<b>SQL query:</b> " . $query . "<br>\n";

        // Perform SQL injection affected query
        $result = mysqli_query($link, $query);

        if (!$result) {
            if ($show_errors)
                print "<b>SQL error:</b> ". mysqli_error($link) . "<br>\n";
            exit(1);
        }

        if (!$show_output)
            exit(1);

        print "<b>SQL results:</b>\n";
        print "<table border=\"1\">\n";

        while ($line = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            print "<tr>";
            foreach ($line as $col_value) {
                print "<td>" . $col_value . "</td>";
            }
            print "</tr>\n";
            if (!$all_results)
                break;
        }

        print "</table>\n";
        print "</body></html>";
    }
?>
