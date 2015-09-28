<?php
/****
* Purpose: paginate a result set
* Precondition: current page, total records, extra variables to pass in the page string
* Postcondition: pagination is displayed
****/
function pagination($current_page_number, $total_records_found, $query_string = null)
{
    $page = 1;

    echo "<br />Halaman: ";

    for ($total_pages = ($total_records_found/NUMBER_PER_PAGE); $total_pages > 0; $total_pages--)
    {
        if ($page != $current_page_number)
            echo "<a href=\"?page=$page" . (($query_string) ? "&$query_string" : "") . "\">";

        echo "$page ";

        if ($page != $current_page_number)
            echo "</a>";

        $page++;
    }
}
?>